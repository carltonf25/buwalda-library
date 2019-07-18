<?php

class Books extends Controller
{
  public function __construct()
  {
    if (!isLoggedIn()) {
      redirect('users/login');
    }
    $this->testVal = 'test';
    $this->bookModel = $this->model('Book');
    $this->authorModel = $this->model('Author');
    $this->userModel = $this->model('User');
    $this->borrowedBookModel = $this->model('BorrowedBook');
  }

  public function index()
  {
    $books = $this->bookModel->getBooks();
    $borrowedBooks = $this->borrowedBookModel->getBorrowedBookIds();
    $borrowedIdList = [];

    foreach ($borrowedBooks as $book) {
      array_push($borrowedIdList, $book->book_id);
    }

    foreach ($books as $book) {
      if (in_array($book->bookId, $borrowedIdList)) {
        $book->borrowed = true;
      } else if (!in_array($book->bookId, $borrowedIdList)) {
        $book->borrowed = false;
      }
    }

    $data = [
      'books' => $books
    ];

    $this->view('books/index', $data);
  }

  public function add()
  {
    $userName = strtolower($_SESSION['user_name']);
    $isAdmin = ($userName == 'carlton' || $userName == 'stephanie') ? true : false;

    if (!$isAdmin) {
      redirect('books');
    }
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
      // Sanitize post array
      $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

      // Check if author exists
      $submittedAuthorName = trim($_POST['author_name']);
      $authorId = $this->getAuthorId($submittedAuthorName);

      // Create author if they do not already exist
      if ($authorId == false) {
        $authorId = $this->authorModel->add([
          'name' => $submittedAuthorName
        ]);
      }

        $data = [
          'title' => trim($_POST['title']),
          'description' => trim($_POST['description']),
          'location' => trim($_POST['location']),
          'author_id' => $authorId,
          'img_url' => trim($_POST['img_url']),
          'user_id' => $_SESSION['user_id'],
          'title_err' => '',
          'description_err' => '',
        ];

        // validate data 
        if (empty($data['title'])) {
          $data['title_err'] = 'Please enter a title';
        }
        if (empty($data['description'])) {
          $data['description_err'] = 'Please enter a description';
        }

        // Make sure there are no errors
        if (empty($data['title_err']) && empty($data['description_err'])) {
          // validated
          if ($this->bookModel->addBook($data)) {
            flash('success_message', 'Book added');
            redirect('books/add');
          } else {
            die('Something went wrong');
          }
        } else {
          // Load view with errors
          $this->view('books/add', $data);
        }
      } else {
        // server request method != 'POST'
        // render view with blanked out data array
        $data = [
          'title' => '',
          'description' => '',
          'location' => '',
          'author_name' => '',
          'img_url' => '',
          'user_id' => '',
          'title_err' => '',
          'description_err' => '',
        ];

        $this->view('books/add', $data);
      }
    }

 public function getAuthorId($name)
  {
    $author = $this->authorModel->getAuthorByName($name);

    if ($author) {
      return $author->id;
    } else {
      // no author found
      return false;
    }
  }

  public function edit($id)
  {
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
      // Sanitize post array
      $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

      $data = [
        'id' => $id,
        'title' => trim($_POST['title']),
        'body' => trim($_POST['body']),
        'user_id' => $_SESSION['user_id'],
        'title_err' => '',
        'body_err' => '',
      ];

      // validate data 
      if (empty($data['title'])) {
        $data['title_err'] = 'Please enter a title';
      }
      if (empty($data['body'])) {
        $data['body_err'] = 'Please enter a body';
      }

      // Make sure there are no errors
      if (empty($data['title_err']) && empty($data['body_err'])) {
        // validated
        if ($this->postModel->updatePost($data)) {
         flash('post_message', 'Post updated');
          redirect('books');
        } else {
          die('Something went wrong');
        }
      } else {
        // Load view with errors
        $this->view('books/edit', $data);
      }
    } else {
      $post = $this->postModel->getPostById($id);
      // check for owner
      if ($post->user_id != $_SESSION['user_id']) {
        redirect('books');
      }
      $data = [
        'id' => $id,
        'title' => $post->title,
        'body' => $post->body
      ];

      $this->view('books/edit', $data);
    }
  }

  public function show($id)
  {
    $post = $this->postModel->getPostById($id);
    $user = $this->userModel->getUserById($post->user_id);

    $data = [
      'post' => $post,
      'user' => $user
    ];

    $this->view('books/show', $data);
  }

  public function delete($id)
  {
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
      $post = $this->postModel->getPostById($id);
      // check for owner
      if ($post->user_id != $_SESSION['user_id']) {
        redirect('books');
      }
      if ($this->postModel->deletePost($id)) {
        flash('post_message', 'Post Removed');
        redirect('books');
      } else {
        die('Something went wrong');
      }
    } else {
      redirect('books');
    }
  }
}

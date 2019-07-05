<?php

class Books extends Controller
{
  public function __construct()
  {
    if(!isLoggedIn()) {
      redirect('users/login');
    }
    $this->bookModel = $this->model('Book');
    $this->userModel = $this->model('User');
  }

  public function index()
  {
    // Get posts
    $books = $this->bookModel->getBooks();
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
    if($_SERVER['REQUEST_METHOD'] == 'POST') {
      // Sanitize post array
      $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

      $data = [
        'title' => trim($_POST['title']),
        'description' => trim($_POST['description']),
        'location' => trim($_POST['location']),
        'author_id' => trim($_POST['author_id']),
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
        if($this->bookModel->addBook($data)) {
          flash('post_message', 'Book added');
          redirect('books');
        } else {
          die('Something went wrong');
        }

      } else {
        // Load view with errors
        $this->view('books/add', $data);
      }

    } else {
    $data = [
      'title' => '',
      'description' => '',
      'location' => '',
      'author_id' => '',
    ];



    $this->view('books/add', $data);
    }
  }

  public function edit($id)
  {
    if($_SERVER['REQUEST_METHOD'] == 'POST') {
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
        if($this->postModel->updatePost($data)) {
          flash('post_message', 'Post updated');
          redirect('books');
        } else {
          die('Something went wrong');
        }

      } else {
        // Load view with errors
        $this->view('posts/edit', $data);
      }

    } else {
      $post = $this->postModel->getPostById($id);
      // check for owner
      if($post->user_id != $_SESSION['user_id']) {
        redirect('books');
      }
      $data = [
        'id' => $id,
        'title' => $post->title,
        'body' => $post->body
      ];

      $this->view('posts/edit', $data);
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

    $this->view('posts/show', $data);
  }

  public function delete($id)
  {
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
      $post = $this->postModel->getPostById($id);
      // check for owner
      if($post->user_id != $_SESSION['user_id']) {
        redirect('books');
      }
      if($this->postModel->deletePost($id)) {
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
<?php

class BorrowedBooks extends Controller
{
  public function __construct()
  {
    if (!isLoggedIn()) {
      redirect('users/login');
    }
    $this->borrowedBookModel = $this->model('BorrowedBook');
    $this->bookModel = $this->model('Book');
    $this->userModel = $this->model('User');
  }

  public function add()
  {
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
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
        if ($this->bookModel->addBook($data)) {
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
        $this->view('borrowedbooks/edit', $data);
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

      $this->view('borrowedbooks/edit', $data);
    }
  }

  public function delete()
  {
    $id = trim($_POST['borrowedBookId']);

    if ($this->borrowedBookModel->delete($id)) {

      flash('admin_message', 'Marked book as returned!');
      redirect('pages/admin');
    } else {
      die('Something went wrong');
    }
  }
}

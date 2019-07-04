<?php

class Users extends Controller
{
    public function __construct()
    {
        $this->userModel = $this->model('User');
        $this->bookModel = $this->model('Book');
        $this->borrowedBookModel = $this->model('BorrowedBook');
    }

    public function register()
    {
        // check for POST
        if($_SERVER['REQUEST_METHOD'] == 'POST') {
            // Process form

            // Sanitize POST data
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

            // init data
            $data = [
                'name' => trim($_POST['name']),
                'email' => trim($_POST['email']),
                'password' => trim($_POST['password']),
                'confirm_password' => trim($_POST['confirm_password']) ,
                'name_err' => '',
                'email_err' => '',
                'password_err' => '',
                'confirm_password_err' => '',
            ];

            // Validate email
            if(empty($data['email'])) {
                $data['email_err'] = 'Please enter email';
            } else {
                // Check email
                if ($this->userModel->findUserByEmail($data['email'])) {
                    $data['email_err'] = 'Email is already registered.';
                }
            }

            // Validate name 
            if(empty($data['name'])) {
                $data['name_err'] = 'Please enter name';
            }

            // Validate password 
            if(empty($data['password'])) {
                $data['password_err'] = 'Please enter password';
            } elseif(strlen($data['password']) < 6) {
                $data['password_err'] = 'Please must be at least six characters';
            }

            // Validate confirm_password 
            if(empty($data['confirm_password'])) {
                $data['confirm_password_err'] = 'Please confirm your password';
            } else {
                if ($data['password'] != $data['confirm_password']) {
                    $data['confirm_password_err'] = 'Passwords do not match.';
                }
            }

            // Make sure errors are empty
            if(empty($data['email_err']) && empty($data['name_err']) && empty($data['password_err']) && empty($data['confirm_password_err'])) {
                // Validated
                // Hash password
                $data['password'] = password_hash($data['password'], PASSWORD_DEFAULT);

                // Register user
                if($this->userModel->register($data)) {
                    flash('register_success', 'You are registered and can log in');
                    redirect('users/login');
                } else {
                    die('Something went wrong');
                }
            } else {
                // Load view with errors
                $this->view('users/register', $data);
            }

        } else {
            // init data
            $data = [
                'name' => '',
                'email' => '',
                'password' => '',
                'confirm_password' => '',
                'name_err' => '',
                'email_err' => '',
                'password_err' => '',
                'confirm_password_err' => '',
            ];
            // Load view
            $this->view('users/register', $data);
        }
    }

    public function login()
    {
        // check for POST
        if($_SERVER['REQUEST_METHOD'] == 'POST') {
            // Process form
            // Sanitize POST data
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

            // init data
            $data = [
                'email' => trim($_POST['email']),
                'password' => trim($_POST['password']),
                'email_err' => '',
                'password_err' => '',
            ];

            // Validate email
            if(empty($data['email'])) {
                $data['email_err'] = 'Please enter email';
            }

            // Validate password 
            if(empty($data['password'])) {
                $data['password_err'] = 'Please enter password';
            }

            // Check for user/email
            if($this->userModel->findUserByEmail($data['email'])) {
              // User found
            } else {
              $data['email_err'] = 'No user found';
            }
            // Make sure errors are empty
            if(empty($data['email_err'])  && empty($data['password_err'])) {
                // Validated
                // Check and set logged in user
                $loggedInUser = $this->userModel->logIn($data['email'], $data['password']);

                if ($loggedInUser) {
                  // Create session
                  $this->createUserSession($loggedInUser);
                } else {
                  $data['password_err'] = 'Password incorrect';
                  
                  $this->view('users/login', $data);
                }
            } else {
                // Load view with errors
                $this->view('users/login', $data);
            }

        } else {
            // init data
            $data = [
                'email' => '',
                'password' => '',
                'email_err' => '',
                'password_err' => '',
            ];
            // Load view
            $this->view('users/login', $data);
        }
    }
    public function createUserSession($user)
    {
      $_SESSION['user_id'] = $user->id; 
      $_SESSION['user_email'] = $user->email; 
      $_SESSION['user_name'] = $user->name; 
      redirect('books');
    }

    public function logOut()
    {
      unset($_SESSION['user_id']);
      unset($_SESSION['user_email']);
      unset($_SESSION['user_name']);
      session_destroy();
      redirect('users/login');
    }

    public function isLoggedIn()
    {
      if(isset($_SESSION['user_id'])) {
        return true;
      } else {
        return false;
      }
    }

    public function borrow()
    {
        // trim post data
        $bookId = trim($_POST['bookId']);

        $user = $this->userModel->getUserById($_SESSION['user_id']);
        $book = $this->bookModel->getBookById($bookId);
        
        $borrowed = $this->borrowedBookModel->addBorrowedBook([
            "userId" => $user->id, 
            "bookId" => $book->id
        ]);
        
        $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
        $bookId = trim($_POST['bookId']); 

        if ($borrowed) {
        flash('register_success', 'Requested to borrow ' . $book->title);
        redirect('books');
        } else {
            flash('alert', 'Something went wrong. Try again.');
            redirect('books');
        }
    }
}
<?php

class Pages extends Controller 
{
    public function __construct()
    {
      $this->borrowedBooksModel = $this->model('BorrowedBook'); 
    }

    public function index() 
    {
      if (isLoggedIn()) {
        redirect('books');
      }
        $data = [
            'title' => 'Buwalda Library',
            'description' => 'Search for a book, or browse by genre'
        ];

        $this->view('pages/index', $data);
    }

    public function about() 
    {
        $data = ['title' => 'About Us', 'description' => 'Our little at-home library'];
        $this->view('pages/about', $data);
    }

    public function admin() 
    {
      $userName = strtolower($_SESSION['user_name']);
      $isAdmin = ($userName == 'carlton' || $userName == 'stephanie') ? true : false;
      if (!$isAdmin) {
        redirect('books');
      } 
        $borrowed = $this->borrowedBooksModel->getBorrowedBooks();

        $data = [
        "borrowedBooks" => $borrowed  
        ];

        $this->view('pages/admin', $data);
    }
}
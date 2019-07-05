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
        $borrowed = $this->borrowedBooksModel->getBorrowedBooks();

        $data = [
        "borrowedBooks" => $borrowed  
        ];

        $this->view('pages/admin', $data);
    }
}
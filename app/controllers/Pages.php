<?php

class Pages extends Controller 
{
    public function __construct()
    {
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
        $data = ['title' => 'About Us', 'description' => 'App to share posts among users'];
        $this->view('pages/about', $data);
    }
}
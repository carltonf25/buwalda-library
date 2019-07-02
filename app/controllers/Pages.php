<?php

class Pages extends Controller 
{
    public function __construct()
    {
    }

    public function index() 
    {
      if (isLoggedIn()) {
        redirect('posts');
      }
        $data = [
            'title' => 'Share-Posts',
            'description' => 'Simple social network built on the PHP-MVC framework'
        ];

        $this->view('pages/index', $data);
    }

    public function about() 
    {
        $data = ['title' => 'About Us', 'description' => 'App to share posts among users'];
        $this->view('pages/about', $data);
    }
}
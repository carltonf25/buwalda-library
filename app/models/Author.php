<?php
  class Author 
  {
    private $db;

    public function __construct()
    {
      $this->db = new Database;
    }

    public function getAuthors()
    {
      $this->db->query('SELECT * FROM authors');

      $results = $this->db->resultSet();
      return $results;
    }
  }
<?php
  class Book
  {
    private $db;

    public function __construct()
    {
      $this->db = new Database;
    }

    public function getAuthors()
    {
      $this->db->query('SELECT *,
                        books.id as bookId,
                        authors.id as authorId
                        FROM books 
                        INNER JOIN authors 
                        ON books.author_id = authors.id
                        ');

      $results = $this->db->resultSet();
      return $results;
    }
  }
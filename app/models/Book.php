<?php
  class Book
  {
    private $db;

    public function __construct()
    {
      $this->db = new Database;
    }

    public function getBooks()
    {
      $this->db->query('SELECT *, 
                        books.id as bookId,
                        authors.id as authorId,
                        authors.name as authorName
                        FROM books
                        INNER JOIN authors
                        ON authors.id = books.author_id
                        ');

      $results = $this->db->resultSet();
      return $results;
    }

    public function addBook($data)
    {
      $this->db->query('INSERT INTO books (title, description, location, author_id) VALUES(:title, :description, :location, :author_id)');

      $this->db->bind(':title', $data['title']);
      $this->db->bind(':description', $data['description']);
      $this->db->bind(':location', $data['location']);
      $this->db->bind(':author_id', $data['author_id']);

      // Execute
      if ($this->db->execute()) {
        return true;
      } else {
        return false;
      }
    }
  }
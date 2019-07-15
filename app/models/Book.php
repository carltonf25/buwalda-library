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
                        JOIN authors
                        ON authors.id = books.author_id
                        ');

      $results = $this->db->resultSet();
      return $results;
    }

    public function getBookById($id)
    {
      $this->db->query('SELECT * FROM books WHERE id = :id');  
      $this->db->bind(':id', $id);

      $row = $this->db->single();

      return $row; 
    }

    public function updateBook($id, $prop, $value)
    {
      $this->db->query('UPDATE books 
                        SET ' . $prop . ' = ' . $value . '
                        WHERE id = ' . $id);
                        
      $this->db->bind(':id', $id);
      $this->db->bind(':prop', $prop);
      $this->db->bind(':value', $value);

      if ($this->db->execute()) {
        return true;
      } else {
        return false;
      }
    }

    public function addBook($data)
    {
      $this->db->query('INSERT INTO books (title, description, location, author_id, img_url) VALUES(:title, :description, :location, :author_id, :img_url)');

      $this->db->bind(':title', $data['title']);
      $this->db->bind(':description', $data['description']);
      $this->db->bind(':location', $data['location']);
      $this->db->bind(':author_id', $data['author_id']);
      $this->db->bind(':img_url', $data['img_url']);

      // Execute
      if ($this->db->execute()) {
        return true;
      } else {
        return false;
      }
    }
  }
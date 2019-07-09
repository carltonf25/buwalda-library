<?php
  class Author 
  {
    private $db;

    public function __construct()
    {
      $this->db = new Database;
    }

    public function getAuthorByName($name)
    {
      $this->db->query('SELECT * FROM authors WHERE name = :name');
      $this->db->bind( ':name', $name);

      $row = $this->db->single();
      return $row;
    }

    public function add($data)
    {
      $this->db->query('INSERT INTO authors (name) VALUES (:name)');

      // bind values to SQL statement from data array
      $this->db->bind(':name', $data['name']);

    if ($this->db->execute()) {
      return true;
    } else {
      return false;
    }
  }
    public function getAuthors()
    {
      $this->db->query('SELECT * FROM authors');

      $results = $this->db->resultSet();
      return $results;
    }
  }
<?php
  class BorrowedBook
  {
      private $db;

      public function __construct()
      {
          $this->db = new Database;
      }

    public function getBorrowedBooks()
    {
        $this->db->query('SELECT 
                            borrowed_books.id as id,
                            books.title as bookTitle,
                            users.name as userName, 
                            authors.name as authorName,
                            borrowed_books.borrowed_at as borrowedDate
                            FROM borrowed_books 
                            INNER JOIN users 
                            ON users.id = borrowed_books.user_id 
                            INNER JOIN books 
                            ON books.id = borrowed_books.book_id
                            INNER JOIN authors
                            ON books.author_id = authors.id
                            ORDER BY borrowed_books.borrowed_at DESC
                            ');
        $results = $this->db->resultSet();
        return $results;
    }

    public function delete($id)
    {
        $this->db->query('DELETE FROM borrowed_books where borrowed_books.id = :id');
        $this->db->bind(':id', $id);
        
        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }


    }
    
    public function addBorrowedBook($data)
    {
        $this->db->query('INSERT INTO borrowed_books (user_id, book_id)
                        VALUES (:user_id, :book_id)
                        ');
        
        $this->db->bind(':user_id', $data['userId']);
        $this->db->bind(':book_id', $data['bookId']);

        // Execute
        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }
  }
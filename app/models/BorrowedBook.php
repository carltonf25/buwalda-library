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
        $this->db->query('SELECT *,
                        borrowed_books.book_id as bookId,
                        borrowed_books.user_id as userId,
                        FROM borrowed_books
                        JOIN users
                        ON user.id = borrowed_books.user_id
                        JOIN books
                        ON book.id = borrowed_books.book_id
                        ');
        $results = $this->db->resultSet();
        return results;
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
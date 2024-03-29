<?php

class Mailers extends Controller
{
  public function __construct()
  {
    $this->bookModel = $this->model('Book');
    $this->userModel = $this->model('User');
    $this->apiKey = API_KEY;
    $this->client = new Mandrill($this->apiKey);
  }

  public function sendBorrowNotification($user, $book)
  {

    try {
      // Mandrill client implementation
      $template_name = 'borrow-notification';
      $template_content = array(
        array(
          'content' => '{{user}} would like to borrow your book, {{book}}'
        )
        );
      $message = array(
        'text' => $user . ' would like to borrow your book, ' . $book . '.',
        'subject' => $user . 'requested to borrow a book.',
        'from_email' => 'hello@buwaldalibrary.com',
        'from_name' => 'Library',
        'to' => array(
          array(
            'email' => 'carltonfreeman24@gmail.com',
            'name' => 'Carlton',
            'type' => 'to'
          )
        ),
        'global_merge_vars' => array(
          array(
            'name' => 'user',
            'content' => $user
          ),
          array(
            'name' => 'book',
            'content' => $book
          )
        )
        ,
        'headers' => array('Reply-To' => 'hello@buwaldalibrary.com'),
        'important' => false,
        'track_opens' => null,
        'track_clicks' => null,
        'auto_text' => null,
        'auto_html' => null,
        'inline_css' => null,
        'url_strip_qs' => null,
        'preserve_recipients' => null,
        'view_content_link' => null,
        'tracking_domain' => null,
        'signing_domain' => null,
        'return_path_domain' => null,
        'merge' => true,
        'merge_language' => 'handlebars'
      );
      $async = false;
      $ip_pool = 'Main Pool';
      $result = $this->client->messages->sendTemplate($template_name, $template_content, $message, $async, $ip_pool);

      if ($result) {
        return true;
      } else {
        return false;
      }
    } catch (Mandrill_Error $e) {
      // Mandrill errors are thrown as exceptions
      echo 'Error sending notification: ' . get_class($e) . ' - ' . $e->getMessage();
      throw $e;
    }
  }
}

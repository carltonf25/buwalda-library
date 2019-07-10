<?php

class Mailers extends Controller
{
  public function __construct()
  {
    $this->bookModel = $this->model('Book');
    $this->userModel = $this->model('User');
    $this->username = urlencode('Fire Island');
    $this->apiKey = API_KEY;
    $this->domain = "sandbox0b65a44345d140a690d3d9f0ea1d720b.mailgun.org";
    $this->baseUrl = "https://api:$this->apiKey@api.mailgun.net/v3/$this->domain";

    # Instantiate the client.
    // $this->mgClient = new Mailgun($this->apiKey);
  }

  public function sendBorrowNotification($user, $book)
  {
    $url = "$this->baseUrl/messages";
    $fields_string = "";
    $fields = array(
     "from" => urlencode("Buwalda Library <library@$this->domain>"),
     "to" => urlencode("carltonfreeman24@gmail.com"),
     "subject" => urlencode("$user would like to borrow a book"),
     "text" => urlencode("$user would like to borrow your book, $book. Log in to library app to view the request.")
    );

    foreach($fields as $key=>$value) { $fields_string .= $key.'='.$value.'&'; }    
    $fields_string = rtrim($fields_string, '&');

    // create curl resource
    $ch = curl_init();

    //set the url, number of POST vars, POST data
    curl_setopt($ch,CURLOPT_URL, $url);
    curl_setopt($ch,CURLOPT_POST, count($fields));
    curl_setopt($ch,CURLOPT_POSTFIELDS, $fields_string);

    //return the transfer as a string
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

    // $output contains the output string
    $result = curl_exec($ch);

    if ($result) {
      return true;
    } else {
      return false;
    }

    // close curl resource to free up system resources
    curl_close($ch);  
  }

}

<?php require APPROOT . '/views/inc/header.php'; ?>
<div class="row">
  <div class="col-md-6">
  <h1>Books</h1>
  </div>
  <div class="col-md-6">
    <a href="<?php echo URLROOT; ?>/books/add" class="btn btn-primary pull-right">
      <i class="fa fa-pencil"></i> Add Book 
    </a>
  </div>
</div>
<div class="row mb-4">
  <div class="col-6 m-auto text-center">
    <h2>Search for a book</h2>
    <input class="col-12" id="bookSearch" type="text" name="search" />
  </div>
</div>
<?php foreach($data['books'] as $book) : ?>
  <div class="card card-body mb-3 book-card">
    <div class="book-info">
    <h4 class="card-title"><?php echo $book->title; ?></h4>
    <span>Written by: <?php echo $book->authorName; ?></span>
    <br />
    <span>In stock: <?php echo $book->in_stock; ?></span>
    </div>
  </div>
<?php endforeach; ?>
<?php require APPROOT . '/views/inc/footer.php'; ?>
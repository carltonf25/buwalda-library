<?php require APPROOT . '/views/inc/header.php'; 
$userId = (isset($_SESSION['user_id']))?$_SESSION['user_id']:'';
$urlRoot = URLROOT;
?>
<?php flash('register_success'); ?>
<?php flash('alert'); ?>
<div class="row">
  <div class="col-md-6">
  <h1>Books</h1>
  </div>
  <div class="col-md-6">
    <a href="<?php echo $urlRoot?>/books/add" class="btn btn-primary pull-right">
      <i class="fa fa-pencil"></i> Add Book 
    </a>
  </div>
</div>
<?php 
var_dump($_SESSION['user_id']);
?>
<div class="row mb-4">
  <div class="col-6 m-auto text-center">
    <h2>Search for a book</h2>
    <input class="col-12" id="bookSearch" onkeyup="generateBookTable(
    <?php echo htmlspecialchars(json_encode($data['books']), ENT_QUOTES, 'UTF-8')?>
    )" 
      type="text" name="search" />
  </div>
</div>
<div id="bookTableContainer">
</div>
<?php require APPROOT . '/views/inc/footer.php'; ?>
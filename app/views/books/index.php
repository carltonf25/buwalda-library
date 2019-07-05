<?php require APPROOT . '/views/inc/header.php'; 
$userId = (isset($_SESSION['user_id']))?$_SESSION['user_id']:'';
$urlRoot = URLROOT;
?>
<?php flash('register_success'); ?>
<?php flash('alert'); ?>
<div class="row">
</div>
<div class="row mb-4">
  <div class="col-10 m-auto text-center">
    <h1>Search for a book</h1>
    <input class="col-12" id="bookSearch" onkeyup="generateBookTable(
    <?php echo htmlspecialchars(json_encode($data['books']), ENT_QUOTES, 'UTF-8')?>
    )" 
      type="text" name="search" />
  </div>
</div>
<div id="bookTableContainer">
</div>
<?php require APPROOT . '/views/inc/footer.php'; ?>
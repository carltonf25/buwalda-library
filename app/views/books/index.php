<?php require APPROOT . '/views/inc/header.php'; 
?>
<?php flash('register_success'); ?>
<?php flash('alert'); ?>
<div class="row">
</div>
<div class="row mb-4">
  <div class="col-10 m-auto text-center">
  <?php
  ?>
    <h1>Search for a book</h1>
    <input class="col-9" id="bookSearch" onkeyup="generateBookTable(
    <?php echo htmlspecialchars(json_encode($data['books']), ENT_QUOTES, 'UTF-8')?>
    )" 
      type="text" name="search" />
  </div>
</div>
<div class="col-12" id="bookTableContainer">
</div>
<?php require APPROOT . '/views/inc/footer.php'; ?>
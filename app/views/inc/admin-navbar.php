
  <nav class="site-header admin-header sticky-top py-1">
    <div class="container d-flex flex-column flex-md-row justify-content-between">
      <h2><a href="<?php echo URLROOT; ?>/pages/admin">Admin Panel</a></h2>
      <?php if(isset($_SESSION['user_id'])) : ?>
      <span>Welcome, <?php echo $_SESSION['user_name']; ?></span>
      <a class="py-2 d-none d-md-inline-block" href="<?php echo URLROOT?>/books/add">Add Book</a>
      <!-- <a class="py-2 d-none d-md-inline-block" href="<?php echo URLROOT?>/books/import">Import Books</a> -->
      <a class="py-2 d-none d-md-inline-block" href="<?php echo URLROOT?>/users/logout">Log Out</a>
      <?php endif; ?>
    </div>
</nav>
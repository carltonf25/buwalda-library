
  <nav class="site-header sticky-top py-1">
    <div class="container d-flex flex-column flex-md-row justify-content-between">
      <h2><a href="<?php echo URLROOT; ?>">Buwalda Library</a></h2>
      <?php if(isset($_SESSION['user_id'])) : ?>
        <div class="header-links">
        <span>Welcome, <?php echo $_SESSION['user_name']; ?></span>
      <?php if ($_SESSION['user_id'] == 1 || $_SESSION['user_id'] == 2) : ?>
        <a class="py-2 d-none d-md-inline-block" href="<?php echo URLROOT?>/pages/admin">Admin Panel</a>
      <?php endif;?>
      <a class="py-2 d-none d-md-inline-block" href="<?php echo URLROOT?>/users/logout">Log Out</a>
      <?php else : ?>
        <a class="py-2 d-none d-md-inline-block" href="<?php echo URLROOT?>/users/register">Register</a>
        <a class="py-2 d-none d-md-inline-block" href="<?php echo URLROOT?>/users/login">Log In</a>
      <?php endif; ?>
      </div>
    </div>
</nav>
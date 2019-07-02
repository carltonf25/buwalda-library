
  <nav class="site-header sticky-top py-1">
    <div class="container d-flex flex-column flex-md-row justify-content-between">
      <h2>Buwalda Library</h2>
      <a class="py-2 d-none d-md-inline-block" href="<?php echo URLROOT; ?>">Home</a>
      <a class="py-2 d-none d-md-inline-block" href="<?php echo URLROOT?>/pages/about">About</a>
      <?php if(isset($_SESSION['user_id'])) : ?>
      <span>Welcome, <?php echo $_SESSION['user_name']; ?></span>
      <a class="py-2 d-none d-md-inline-block" href="<?php echo URLROOT?>/users/logout">Log Out</a>
      <?php else : ?>
        <a class="py-2 d-none d-md-inline-block" href="<?php echo URLROOT?>/users/register">Register</a>
        <a class="py-2 d-none d-md-inline-block" href="<?php echo URLROOT?>/users/login">Log In</a>
      <?php endif; ?>
    </div>
</nav>
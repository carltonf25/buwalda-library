<?php require APPROOT . '/views/inc/header.php'; ?>
    <a href="<?php echo URLROOT;?>/posts" class="btn btn-light"><i class="fa fa-backward mr-auto"></i> Back</a>
      <div class="card bard-body bg-light mt-5">
      <?php flash('register_success'); ?>
      <h2>Edit Post</h2>
      <p>Edit the post</p>
      <form action="<?php echo URLROOT; ?>/posts/edit/<?php echo $data['id']; ?>" method="POST">
          <div class="form-group">
              <label for="Title">Title: <sup>*</sup></label> 
              <input type="text" name="title" class="form-control form-control-lg <?php echo (!empty($data['titie_err'])) ? 'is-invalid' : '';?>" value="<?php echo $data['title']; ?>" />
              <span class="invalid-feedback"><?php echo $data['title_err']; ?></span>
          </div>
          <div class="form-group">
              <label for="body">Body: <sup>*</sup></label> 
              <textarea name="body" class="form-control form-control-lg <?php echo (!empty($data['body_err'])) ? 'is-invalid' : '';?>">
                <?php echo $data['body']; ?>
              </textarea>
              <span class="invalid-feedback"><?php echo $data['password_err']; ?></span>
          </div>
          <input type="submit" value="Submit" class="btn btn-success" />
      </form>
      </div>
<?php require APPROOT . '/views/inc/footer.php'; ?>


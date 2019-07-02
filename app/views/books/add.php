<?php require APPROOT . '/views/inc/header.php'; ?>
    <a href="<?php echo URLROOT;?>/books" class="btn btn-light"><i class="fa fa-backward mr-auto"></i> Back</a>
      <div class="card bard-body bg-light mt-5">
      <?php flash('register_success'); ?>
      <h2>Add Book</h2>
      <p>Create a book</p>
      <form action="<?php echo URLROOT; ?>/books/add" method="POST">
          <div class="form-group">
              <label for="Title">Title: <sup>*</sup></label> 
              <input type="text" name="title" class="form-control form-control-lg <?php echo (!empty($data['title_err'])) ? 'is-invalid' : '';?>" value="<?php echo $data['title']; ?>" />
              <span class="invalid-feedback"><?php echo $data['title_err']; ?></span>
          </div>
          <div class="form-group">
              <label for="Description">Description: <sup>*</sup></label> 
              <textarea name="description" class="form-control form-control-lg <?php echo (!empty($data['description_err'])) ? 'is-invalid' : '';?>">
                <?php echo $data['description']; ?>
              </textarea>
          </div>
          <div class="form-group">
              <label for="Location">Location: <sup>*</sup></label> 
              <input type="text" name="location" class="form-control form-control-lg" value="<?php echo $data['location']; ?>" />
          </div>
          <div class="form-group">
              <label for="Author_ID">Author #: <sup>*</sup></label> 
              <input type="number" name="author_id" class="form-control form-control-lg" value="<?php echo $data['author_id']; ?>" />
          </div>
          <input type="submit" value="Submit" class="btn btn-success" />
      </form>
      </div>
<?php require APPROOT . '/views/inc/footer.php'; ?>


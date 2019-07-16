<?php require APPROOT . '/views/inc/admin-header.php'; ?>
    <a href="<?php echo URLROOT;?>/pages/admin" class="btn btn-dark"><i class="fa fa-backward mr-auto"></i> Back</a>
      <div class="card bard-body bg-light p-4 mt-5">
      <?php flash('register_success'); ?>
      <h3>Add Book</h3>
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
              <label for="author_name">Author Name: <sup>*</sup></label> 
              <input type="text" name="author_name" class="form-control form-control-lg" value="<?php echo $data['author_name']; ?>" />
            </div>
            <div class="form-group">
                <label for="Location">Location: </label> 
                <input type="text" name="location" class="form-control form-control-lg" value="<?php echo $data['location']; ?>" />
            </div>
          <div class="form-group">
              <label for="img_url">Book Image URL:</label> 
              <input type="text" name="img_url" class="form-control form-control-lg" value="<?php echo $data['img_url']; ?>" />
          </div>
          
          <input type="submit" value="Submit" class="btn btn-success" />
      </form>
      </div>
<?php require APPROOT . '/views/inc/footer.php'; ?>


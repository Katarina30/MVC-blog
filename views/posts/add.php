<?php include APPROOT . '/views/inc/header.php'; ?>
    <div class="card card-body bg-light mt-5">
    <h2>Add Post</h2>
    <p>Create a post with this form</p>
    <form action="<?php echo URLROOT; ?>/posts/add" method="post">
      <div class="form-group">
        <label for="title">Title: <sup>*</sup></label>
        <input type="text" name="title" class="form-control form-control-lg" value="<?= Input::get('title'); ?>">
       
      </div>
      <div class="form-group">
        <label for="text">Text: <sup>*</sup></label>
        <textarea name="text" class="form-control form-control-lg"> <?= Input::get('text'); ?></textarea>
        <span class="invalid-feedback"></span>
      </div>
      <input type="submit" class="btn btn-success" value="Submit">
    </form>
  </div>
<?php include APPROOT . '/views/inc/footer.php'; ?>
<?php include APPROOT . '/views/inc/header.php'; ?>
  <a href="<?php echo URLROOT; ?>/posts" class="btn btn-light"><i class="fa fa-backward"></i> Back</a>
  <div class="card card-body bg-light mt-5">
    <h2>Edit Post</h2>
    <p>Create a post with this form</p>
    <form action="<?php echo URLROOT; ?>/posts/edit/<?php echo $post->id;  ?>" method="post">
      <div class="form-group">
        <label for="title">Title: <sup>*</sup></label>
        <input type="text" name="title" class="form-control form-control-lg " value="<?php echo $post->title;  ?>">
      
      </div>
      <div class="form-group">
        <label for="text">Text: <sup>*</sup></label>
        <textarea name="text" class="form-control form-control-lg "><?php echo $post->text;  ?></textarea>
        
      </div>
      <input type="submit" class="btn btn-success" value="Submit">
    </form>
  </div>
<?php include APPROOT . '/views/inc/footer.php'; ?>
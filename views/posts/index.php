<?php include APPROOT . '/views/inc/header.php'; ?>
  <div class="row mb-3">
    <div class="col-md-6">
      <h1>Posts</h1>
    </div>
    <div class="col-md-6">
		<form action="<?php echo URLROOT; ?>/posts" method="post">
      <div class="form-group">
        <input type="text" name="search" class="form-control form-control-lg" placeholder="Search. . . " value="<?= Input::get('search'); ?>">
       
	   <input type="submit" class="btn btn-success" value="Search">
	   </div>
    </form>
      <a href="<?php echo URLROOT; ?>/posts/add" class="btn btn-primary pull-right">
        <i class="fa fa-pencil"></i> Add Post
      </a>
    </div>
  </div>
  <?php foreach($posts as $post) : ?>
    <div class="card card-body mb-3">
      <h4 class="card-title"><?php echo $post->title; ?></h4>
      <div class="bg-light p-2 mb-3">
       Written by  <?= $post->name; ?> on <?= date('d.m.Y H:i',strtotime($post->created_at)); ?>
      </div>
      <p class="card-text"><?php echo $post->text; ?></p>
       <a href="<?php echo URLROOT; ?>/posts/show/<?= $post->idPost; ?>" class="btn btn-dark">More</a>
    </div>
  <?php endforeach; ?>
<?php include APPROOT . '/views/inc/footer.php'; ?>
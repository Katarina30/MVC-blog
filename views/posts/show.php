<?php include APPROOT . '/views/inc/header.php'; ?>
<a href="<?php echo URLROOT; ?>/posts" class="btn btn-light"><i class="fa fa-backward"></i> Back</a>
<br>
<h1><?= $post->title; ?></h1>

<p><?= $post->text; ?></p>
<div class="bg-light p-2 mb-3">
       Written on <?= date('d.m.Y H:i',strtotime($post->created_at)); ?>
      </div>

  <hr>
  <?php if($post->user_id == Session::get('id')) : ?>
  <a href="<?php echo URLROOT; ?>/posts/edit/<?= $post->id; ?>" class="btn btn-dark">Edit</a>


  <form class="pull-right" action="<?php echo URLROOT; ?>/posts/delete/<?= $post->id; ?>" method="post">
    <input type="submit" value="Delete" class="btn btn-danger">
  </form>
<?php endif; ?>

<?php include APPROOT . '/views/inc/footer.php'; ?>
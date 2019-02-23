<?php include APPROOT . '/views/inc/header.php'; ?>
  <div class="row">
    <div class="col-md-6 mx-auto">
      <div class="card card-body bg-light mt-5">
        <h2>Create An Account</h2>
        <form action="<?php echo URLROOT; ?>/users/register" method="post">
          <div class="form-group">
            <label for="name">Name: <sup>*</sup></label>
            <input type="text" name="name" class="form-control form-control-lg " value="<?= Input::get('name'); ?>">
			 <span id="name" class="text-danger text-center"><?= isset($GLOBALS['session']['name']) ? $GLOBALS['session']['name']  : null ; ?></span>

            </div>
            <div class="form-group">
                <label for="password">Password: <sup>*</sup></label>
                <input type="password" name="password" class="form-control form-control-lg "  value="<?= Input::get('password'); ?>">
				 <span id="password" class="text-danger text-center"><?= isset($GLOBALS['session']['password']) ? $GLOBALS['session']['password']  : null ;?></span>
				<a href="<?= URLROOT; ?>/users/login""> Are you registered? Click to login... </a>
			   </div>
           <div class="row">
                <div class="col">
                    <input type="submit" value="Register" class="btn btn-success btn-block">
                </div>
           </div>
		   </form>
<?php include APPROOT . '/views/inc/footer.php'; ?>
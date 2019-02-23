<?php include APPROOT . '/views/inc/header.php'; ?>
  <div class="row">
    <div class="col-md-6 mx-auto">
      <div class="card card-body bg-light mt-5">
        <h2>Log In</h2>
        <form action="<?php echo URLROOT; ?>/users/login" method="post">
          <div class="form-group">
            <label for="name">Name: <sup>*</sup></label>
            <input type="text" name="name" class="form-control form-control-lg " value="<?php echo Input::get('name'); ?>">
           
            </div>
            <div class="form-group">
                <label for="password">Password: <sup>*</sup></label>
                <input type="password" name="password" class="form-control form-control-lg " value="<?php echo Input::get('password'); ?>">
               
           <div class="row">
                <div class="col">
                    <input type="submit" value="Login" class="btn btn-success btn-block">
                </div>
           </div>
		   </form>
<?php include APPROOT . '/views/inc/footer.php'; ?>
<?php
    require_once 'classes/DB.php';

    if ($user->is_logged_in() != "") {
        $user->redirect('index.php');
    }

    if (isset($_POST['btnLogin'])) {
        $umail = trim(htmlentities($_POST['email']));
        $upass = trim(htmlentities($_POST['password']));
        
        if ($user->login($umail, $upass)) {
            $user->redirect('index.php');
        } else {
            $error = "Wrong Details!";
        }
    }

?>

<?php include 'includes/header.php'; ?>
    <div class="container py-5 mt-4">
        <div class="row">
            <div class="col-md-12">
                <div class="row">
                    <div class="col-md-6 mx-auto">
                        <!-- form card login -->
                        <div class="card">
                            <div class="card-header">
                                <h3 class="text-center mb-0">Login</h3>
                            </div>
                            <div class="card-body">
                                <form class="form" role="form" action="login.php" autocomplete="off" id="login-form" method="post">
                                    <?php if(isset($error)) { ?>
                                        <div class="alert alert-danger" role="alert">
                                            <i class="fas fa-exclamation-triangle"></i> &nbsp; <?php echo $error; ?>
                                        </div>
                                    <?php } ?>
                                    <div class="form-group">
                                        <label for="email">Email</label>
                                        <input type="email" class="form-control" name="email" placeholder="Enter your email">
                                    </div>
                                    <div class="form-group">
                                        <label for="password">Password</label>
                                        <input type="password" class="form-control" name="password" placeholder="Enter your password">
                                    </div>
                                    <button type="submit" class="btn btn-success btn-lg btn-block" name="btnLogin">Login</button>
                                </form>
                            </div>
                        </div>
                        <!-- /form card login -->
                    </div>
                </div>
                <!--/row-->
            </div>
            <!--/col-md-12-->
        </div>
        <!--/row-->
    </div>
<?php include 'includes/footer.php'; ?>
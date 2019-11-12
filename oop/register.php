<?php
    require_once 'classes/Connection.php';
    require_once 'classes/User.php';

    $dbInstance = Connection::getInstance();
    //$dbConnection = $dbInstance->getConnection();
    $user = new User($dbInstance);

    if ($user->is_logged_in() != "") {
        $user->redirect('index.php');
    }

    if (isset($_POST['btnRegister'])) {
        $uname = trim(htmlentities($_POST['name']));
        $umail = trim(htmlentities($_POST['email']));
        $upass = trim(htmlentities($_POST['password']));
        $upass_rpt = trim(htmlentities($_POST['password-repeat']));
        
        if ($uname == "") {
            $error[] = "Name field is required!";
        } else if ($umail == "") {
            $error[] = "Email field is required!";
        } else if (!filter_var($umail, FILTER_VALIDATE_EMAIL)) {
            $error[] = 'Please enter a valid email address!';
        } else if ($upass == "") {
            $error[] = "Password field is required!";
        } else if ($upass_rpt == "") {
            $error[] = "Repeat Password field is required!";
        } else if (strlen($upass) < 6) {
            $error[] = "Password must be at least 6 characters";
        } else if ($upass != $upass_rpt) {
            $error[] = "The two passwords do not match!";
        } else {
            try {
                $stmt = $dbInstance->prepare("SELECT name, email FROM users WHERE name = :uname OR email = :umail");
                $stmt->execute(array(':uname'=>$uname, ':umail'=>$umail));
                $row = $stmt->fetch(PDO::FETCH_ASSOC);
                
                if ($row['name'] == $uname) {
                    $error[] = "Name already exists!";
                } else if ($row['email'] == $umail) {
                    $error[] = "Email already exists!";
                } else {
                    if ($user->register($uname, $umail, $upass)) {
                        $user->redirect('register.php?joined');
                    }
                }
            } catch(PDOException $e) {
                echo $e->getMessage();
            }
        }
    }
?>

<?php include 'includes/header.php'; ?>
    <div class="container py-5 mt-4">
        <div class="row">
            <div class="col-md-12">
                <div class="row">
                    <div class="col-md-6 mx-auto">
                        <!-- form card register -->
                        <div class="card">
                            <div class="card-header">
                                <h3 class="text-center mb-0">Register</h3>
                            </div>
                            <div class="card-body">
                                <form class="form" role="form" action="register.php" autocomplete="off" id="register-form" method="post">
                                    <?php 
                                        if (isset($error)) {
                                            foreach($error as $error) {
                                    ?>
                                        <div class="alert alert-danger" role="alert">
                                            <i class="fas fa-exclamation-triangle"></i> &nbsp; <?php echo $error; ?>
                                        </div>
                                    <?php
                                            }
                                        } else if (isset($_GET['joined'])) {
                                    ?>
                                        <div class="alert alert-info" role="alert">
                                            <i class="fas fa-sign-in-alt"></i> &nbsp; Registered successfully. Click <a href="login.php">here </a> to login
                                        </div>
                                    <?php
                                        }
                                    ?>
                                    <div class="form-group">
                                        <label for="email">Email</label>
                                        <input type="email" class="form-control" name="email" placeholder="Enter your email" value="<?php if (isset($error)) { echo $umail; } ?>">
                                    </div>
                                    <div class="form-group">
                                        <label for="name">Name</label>
                                        <input type="text" class="form-control" name="name" placeholder="Enter your name" value="<?php if (isset($error)) { echo $uname; } ?>">
                                    </div>
                                    <div class="form-group">
                                        <label for="password">Password</label>
                                        <input type="password" class="form-control" name="password" placeholder="Enter your password">
                                    </div>
                                    <div class="form-group">
                                        <label for="password">Repeat Password</label>
                                        <input type="password" class="form-control" name="password-repeat" placeholder="Repeat password">
                                    </div>
                                    <button type="submit" class="btn btn-success btn-lg btn-block" name="btnRegister">Register</button>
                                </form>
                            </div>
                        </div>
                        <!-- /form card register -->
                    </div>
                </div>
                <!--/row-->
            </div>
            <!--/col-md-12-->
        </div>
        <!--/row-->
    </div>
<?php include 'includes/footer.php'; ?>
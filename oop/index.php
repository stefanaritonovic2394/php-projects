<?php

include_once 'classes/DB.php';
require_once 'classes/QueryBuilder.php';

/*
interface LoginInterface 
{
    public function loginUser(string $user): string;
}

interface RegisterInterface 
{
    public function registerUser(string $user): string;
}
*/

// require 'classes/Login.php';
// require 'classes/Register.php';
// require 'classes/DB.php';

// if (!$user->is_logged_in()) {
//     $user->redirect('login.php');
// }

// $user_id = $_SESSION['user_session'];
// $stmt = $conn->prepare("SELECT * FROM users WHERE id = :user_id");
// $stmt->execute(array(":user_id" => $user_id));
// $userRow = $stmt->fetch(PDO::FETCH_ASSOC);

$dbInstance = DB::getInstance();
$dbConnection = $dbInstance->getConnection();

$users = QueryBuilder::selectAll();

foreach($users as $user) {
    echo $user['name'];
}

//$query->select('users', array('name, email, password'), 'email', 'dusan@gmail.com');

?>

<!-- <?php include 'includes/header.php'; ?>
    <div class="container">
        <?php if (isset($_SESSION['user_session'])) : ?>
            <h1 class="">Welcome, <?php //echo $userRow['name']; ?></h1>
        <?php endif; ?>
    </div>
<?php include 'includes/footer.php'; ?> -->
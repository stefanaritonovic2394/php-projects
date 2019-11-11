<?php

require_once 'classes/DB.php';
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

// if (!$user->is_logged_in()) {
//     $user->redirect('login.php');
// }

// $user_id = $_SESSION['user_session'];
// $stmt = $conn->prepare("SELECT * FROM users WHERE id = :user_id");
// $stmt->execute(array(":user_id" => $user_id));
// $userRow = $stmt->fetch(PDO::FETCH_ASSOC);

// $dbInstance = DB::getInstance();
// $dbConnection = $dbInstance->getConnection();

$query = new QueryBuilder();
/* Select all users */
$users = QueryBuilder::selectAll();

/* Select user by id */
//$user = QueryBuilder::selectById(1);

/* Insert user */
//$insert = QueryBuilder::insertUser('test', 'test@gmail.com', 'test123');

/* Update user */
//$update = QueryBuilder::updateUser('Marko', 'marko@gmail.com', 'marko', 12);

/* Delete user */
//$delete = QueryBuilder::deleteUser(12);

?>

<?php include 'includes/header.php'; ?>
    <div class="container">
        <?php if (isset($_SESSION['user_session'])) : ?>
            <h1 class="">Welcome, <?php //echo $userRow['name']; ?></h1>
        <?php endif; ?>
        <div class="card mt-3" style="">
            <div class="card-header text-center">
                Users
            </div>
            <ul class="list-group list-group-flush">
                <?php foreach($users as $user) : ?>
                    <li class="list-group-item"><?php echo $user['name']; ?></li>
                <?php endforeach; ?>
            </ul>
        </div>
    </div>
<?php include 'includes/footer.php'; ?>
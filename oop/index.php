<?php

require_once 'classes/Connection.php';
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

// $dbInstance = Connection::getInstance();
// $dbConnection = $dbInstance->getConnection();

/* Select all users */
//$users = QueryBuilder::from('users')->selectAll();
$users = QueryBuilder::table('users')->selectAll();
$posts = QueryBuilder::table('posts')->selectAll();

/* Select user by id */
//$post = QueryBuilder::get()->from('posts')->selectById(2);
//$post = QueryBuilder::table('posts')->selectById(1);

/* Insert user */
//$insert = QueryBuilder::insertUser('Test3', 'test3@gmail.com', 'test123');
//$insertPost = QueryBuilder::insertPost('Treci Post', 'Ovo je treci post', now());
//$insert = QueryBuilder::table('posts')->insertPost('Treci post', 'Ovo je treci post', date('Y-m-d H:i:s'));

/* Update user */
//$update = QueryBuilder::updateUser('Marko', 'marko@gmail.com', 'marko', 8);

/* Delete user */
//$delete = QueryBuilder::deleteUser(7);

?>

<?php include 'includes/header.php'; ?>
    <div class="container">
        <?php if (isset($_SESSION['user_session'])) : ?>
            <h1 class="">Welcome, <?php //echo $userRow['name']; ?></h1>
        <?php endif; ?>
        <div class="card bg-primary mt-3" style="">
            <div class="card-header text-center">
                Users
            </div>
            <ul class="list-group list-group-flush">
                <?php foreach($users as $user) : ?>
                    <li class="list-group-item"><?php echo $user['name']; ?></li>
                <?php endforeach; ?>
            </ul>
        </div>
        <div class="card bg-secondary mt-3" style="">
            <div class="card-header text-center">
                Posts
            </div>
            <ul class="list-group list-group-flush">
                <?php foreach($posts as $post) : ?>
                    <li class="list-group-item"><?php echo $post['title']; ?></li>
                <?php endforeach; ?>
            </ul>
        </div>
        <div>
            <h3><?php //echo $post['content']; ?></h3>
        </div>
    </div>
<?php include 'includes/footer.php'; ?>
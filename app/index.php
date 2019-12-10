<?php

require __DIR__ . '/../vendor/autoload.php';
use App\Classes\QueryBuilder;

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
$users = QueryBuilder::table('users')->selectAll()->get();
//echo '<pre>';
//die(var_dump($users));
//echo '</pre>';
$posts = QueryBuilder::table('posts')->selectAll()->get();

/* Select user by id */
//$post = QueryBuilder::get()->from('posts')->selectById(2);
//$user = QueryBuilder::table('users')->selectById(11);

/* Insert user */
//$insert = QueryBuilder::table('users')->insertUser('Bojan', 'bojan@gmail.com', 'bojan22');
//$insertPost = QueryBuilder::insertPost('Treci Post', 'Ovo je treci post', now());
//$insert = QueryBuilder::table('posts')->insertPost('Treci post', 'Ovo je treci post', date('Y-m-d H:i:s'));
//$insert = QueryBuilder::table('users')->insert([
//    'name' => 'Miljana',
//    'email' => 'miljana@gmail.com',
//    'password' => password_hash('miljana', PASSWORD_BCRYPT)
//]);

/* Update user */
//$update = QueryBuilder::updateUser('Test2', 'test2@gmail.com', 'test2', 9);
//$update = QueryBuilder::table('users')->updateUser('Test2', 'test2@gmail.com', 'test2', 9);
$update = QueryBuilder::table('users')->where(['id', '=', 10])->update([
    'name' => 'Test3',
    'email' => 'test3@gmail.com',
    'password' => password_hash('testtri', PASSWORD_BCRYPT)
]);

/* Delete user */
//$delete = QueryBuilder::deleteUser(7);
//$delete = QueryBuilder::table('users')->deleteUser(12);
//$delete = QueryBuilder::table('users')->where(['id' => 9])->delete();

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
            <h3><?php //echo $user['email']; ?></h3>
        </div>
    </div>
<?php include 'includes/footer.php'; ?>
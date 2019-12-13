<?php require APP_ROOT . '/Views/includes/header.php'; ?>
    <h1><?php //echo $data['title']; ?></h1>
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
<?php require APP_ROOT . '/Views/includes/footer.php'; ?>
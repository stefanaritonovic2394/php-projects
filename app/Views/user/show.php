<?php require VIEW . '/includes/header.php'; ?>
    <div class="container">
        <h1>Show user</h1>
        <ul class="list-group">
            <?php foreach ($data['user'] as $user) : ?>
                <li class="list-group-item"><?php echo $user->name; ?></li>
            <?php endforeach; ?>
        </ul>
    </div>
<?php require VIEW . '/includes/footer.php'; ?>
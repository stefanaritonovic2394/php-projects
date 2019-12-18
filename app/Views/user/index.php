<?php require VIEW . '/includes/header.php'; ?>
    <div class="container">
        <h1>All Users</h1>
        <ul class="list-group list-group-flush">
            <?php foreach ($data['users'] as $user): ?>
                <li class="list-group-item">
                    <strong>Name: </strong><?php echo "{$user->name}" ?><br>
                    <strong>Email: </strong><?php echo "{$user->email}" ?><br>
                </li>
            <?php endforeach; ?>
        </ul>
    </div>
<?php require VIEW . '/includes/footer.php'; ?>
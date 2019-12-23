<?php require VIEW . '/includes/header.php'; ?>
    <div class="container">
        <h3>All Users</h3>
        <a href="<?php echo URL_ROOT; ?>/user/create" class="btn btn-primary">Add new user</a>
        <br>
        <ul class="list-group list-group-flush">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th scope="col">Name</th>
                        <th scope="col">Email</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($data['users'] as $user): ?>
                        <tr>
                            <td><?php echo "{$user->name}" ?></td>
                            <td><?php echo "{$user->email}" ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </ul>
    </div>
<?php require VIEW . '/includes/footer.php'; ?>
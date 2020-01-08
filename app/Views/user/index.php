<?php require VIEW . '/includes/header.php'; ?>
    <div class="container">
        <h3>All Users</h3>
        <a href="<?php echo URL_ROOT; ?>/user/create" class="btn btn-primary mb-3">Add new user</a>
        <br>
        <ul class="list-group list-group-flush">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th scope="col">Name</th>
                        <th scope="col">Email</th>
                        <th scope="col">Edit</th>
                        <th scope="col">Delete</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($data['users'] as $user): ?>
                        <tr>
                            <td><?php echo "{$user['name']}" ?></td>
                            <td><?php echo "{$user['email']}" ?></td>
                            <td><a href="<?php echo URL_ROOT; ?>/user/edit/<?php echo "{$user['user_id']}"; ?>" class="btn btn-warning">Edit</a></td>
                            <td><a href="<?php echo URL_ROOT; ?>/user/delete/<?php echo "{$user['user_id']}"; ?>" class="btn btn-danger" onclick="return confirm('Are you sure?')">Delete</a></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </ul>
    </div>
<?php require VIEW . '/includes/footer.php'; ?>
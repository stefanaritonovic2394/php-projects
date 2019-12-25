<?php require VIEW . '/includes/header.php'; ?>
    <div class="container">
        <h3>All Posts</h3>
        <a href="<?php echo URL_ROOT; ?>/post/create" class="btn btn-primary mb-3">Add new post</a>
        <br>
        <ul class="list-group list-group-flush">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th scope="col">Title</th>
                        <th scope="col">Content</th>
                        <th scope="col">Edit</th>
                        <th scope="col">Delete</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($data['posts'] as $post): ?>
                        <tr>
                            <td><?php echo "{$post->title}" ?></td>
                            <td><?php echo "{$post->content}" ?></td>
                            <td><a href="<?php echo URL_ROOT; ?>/post/edit/<?php echo $post->id; ?>" class="btn btn-warning">Edit</a></td>
                            <td><a href="<?php echo URL_ROOT; ?>/post/delete/<?php echo $post->id; ?>" class="btn btn-danger" onclick="return confirm('Are you sure?')">Delete</a></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </ul>
    </div>
<?php require VIEW . '/includes/footer.php'; ?>
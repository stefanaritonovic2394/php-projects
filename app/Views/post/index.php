<?php require VIEW . '/includes/header.php'; ?>
    <div class="container">
        <h3>All Posts</h3>
        <a href="<?php echo URL_ROOT; ?>/post/create" class="btn btn-primary">Add new post</a>
        <br>
        <ul class="list-group list-group-flush">
            <table class="table table-striped">
                <thead>
                <tr>
                    <th scope="col">Title</th>
                    <th scope="col">Content</th>
                </tr>
                </thead>
                <tbody>
                <?php foreach ($data['posts'] as $post): ?>
                    <tr>
                        <td><?php echo "{$post->title}" ?></td>
                        <td><?php echo "{$post->content}" ?></td>
                    </tr>
                <?php endforeach; ?>
                </tbody>
            </table>
        </ul>
    </div>
<?php require VIEW . '/includes/footer.php'; ?>
<?php require VIEW . '/includes/header.php'; ?>
    <h1>Show post</h1>
    <ul class="list-group">
        <?php foreach ($data['post'] as $post) : ?>
            <li class="list-group-item"><?php echo $post->title; ?></li>
        <?php endforeach; ?>
    </ul>
<?php require VIEW . '/includes/footer.php'; ?>
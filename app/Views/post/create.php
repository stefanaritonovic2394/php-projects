<?php require VIEW . '/includes/header.php'; ?>
    <div class="container">
        <h1>Create Post</h1>
        <form method="POST" action="<?php echo URL_ROOT; ?>/post/store" enctype="multipart/form-data">
            <div class="form-group">
                <label for="title">Title</label>
                <input type="text" class="form-control" name="title" id="title" placeholder="Enter title">
            </div>
            <div class="form-group">
                <label for="content">Content</label>
                <textarea class="form-control" rows="5" name="content" id="content" placeholder="Enter content"></textarea>
            </div>
            <div class="form-group">
                <label for="created_at">Creation date</label>
                <input type="date" class="form-control" name="created_at" id="created_at">
            </div>
            <button type="submit" class="btn btn-primary">Create</button>
        </form>
    </div>
<?php require VIEW . '/includes/footer.php'; ?>
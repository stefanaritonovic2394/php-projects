<?php require VIEW . '/includes/header.php'; ?>
    <div class="container">
        <h1>Edit Post</h1>
        <form method="POST" action="<?php echo URL_ROOT; ?>/post/update" enctype="multipart/form-data">
            <input type="hidden" name="id" value="<?php echo $data['post'][0]->id; ?>">
            <div class="form-group">
                <label for="title">Title</label>
                <input type="text" class="form-control" name="title" id="title" value="<?php echo $data['post'][0]->title; ?>" placeholder="Enter title">
            </div>
            <div class="form-group">
                <label for="content">Content</label>
                <textarea class="form-control" rows="5" name="content" id="content" placeholder="Enter content"><?php echo $data['post'][0]->content; ?></textarea>
            </div>
            <div class="form-group">
                <label for="created_at">Creation date</label>
                <input type="date" class="form-control" name="created_at" id="created_at" value="<?php echo $data['post'][0]->created_at; ?>">
            </div>
            <input type="hidden" name="_method" value="PUT">
            <button type="submit" class="btn btn-primary">Update</button>
        </form>
    </div>
<?php require VIEW . '/includes/footer.php'; ?>
<?php require VIEW . '/includes/header.php'; ?>
    <div class="container">
        <h1>Edit User</h1>
        <form method="POST" action="<?php echo URL_ROOT; ?>/user/update" enctype="multipart/form-data">
            <input type="hidden" name="id" value="<?php echo $data['user'][0]->id; ?>">
            <div class="form-group">
                <label for="name">Name</label>
                <input type="text" class="form-control" name="name" id="name" value="<?php echo $data['user'][0]->name; ?>" placeholder="Enter name">
            </div>
            <div class="form-group">
                <label for="email">Email address</label>
                <input type="email" class="form-control" name="email" id="email" value="<?php echo $data['user'][0]->email; ?>" placeholder="Enter email">
            </div>
            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" class="form-control" name="password" id="password" placeholder="Enter password">
            </div>
            <input type="hidden" name="_method" value="PUT">
            <button type="submit" class="btn btn-primary">Update</button>
        </form>
    </div>
<?php require VIEW . '/includes/footer.php'; ?>
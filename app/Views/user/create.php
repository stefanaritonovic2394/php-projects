<?php require VIEW . '/includes/header.php'; ?>
    <div class="container">
        <h1>Create User</h1>
        <form method="POST" action="<?php echo URL_ROOT; ?>/user/store" enctype="multipart/form-data">
            <div class="form-group">
                <label for="name">Name</label>
                <input type="text" class="form-control" name="name" id="name" placeholder="Enter name">
            </div>
            <div class="form-group">
                <label for="email">Email address</label>
                <input type="email" class="form-control" name="email" id="email" placeholder="Enter email">
            </div>
            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" class="form-control" name="password" id="password" placeholder="Enter password">
            </div>
            <button type="submit" class="btn btn-primary">Create</button>
        </form>
    </div>
<?php require VIEW . '/includes/footer.php'; ?>
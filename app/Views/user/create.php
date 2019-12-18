<?php require VIEW . '/includes/header.php'; ?>
    <div class="container">
        <h1>Create User</h1>
        <form method="post" action="<?php echo CONTROLLER; ?>UserController/store">
            <div class="form-group">
                <label for="name">Name</label>
                <input type="text" class="form-control" id="name" placeholder="Name">
            </div>
            <div class="form-group">
                <label for="email">Email address</label>
                <input type="email" class="form-control" id="email" placeholder="Enter email">
            </div>
            <button type="submit" class="btn btn-primary">Create</button>
        </form>
    </div>
<?php require VIEW . '/includes/footer.php'; ?>
<nav class="navbar navbar-expand-md navbar-dark bg-dark">
    <a class="navbar-brand" href="http://localhost/php-projects/oop/">Navbar</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarsExampleDefault" aria-controls="navbarsExampleDefault" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    
    <div class="collapse navbar-collapse" id="navbarsExampleDefault">
        <ul class="navbar-nav mr-auto">
            <li class="nav-item active">
                <a class="nav-link" href="<?php echo ROOT_URL; ?>">Home <span class="sr-only">(current)</span></a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="<?php echo ROOT_URL; ?>login.php">Login</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="<?php echo ROOT_URL; ?>register.php">Register</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="<?php echo ROOT_URL; ?>logout.php?logout=true">Logout</a>
            </li>
        </ul>
    </div>
</nav>
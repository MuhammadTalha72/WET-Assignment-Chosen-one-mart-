<nav class="navbar navbar-expand-lg navbar-light bg-white sticky-top">
    <div class="container">
        <a class="navbar-brand text-com fw-bold" href="index.php">
            <i class="bi bi-shop"></i> Choosen One Mart
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav me-auto">
                <li class="nav-item">
                    <a class="nav-link" href="index.php">Home</a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown">
                        Categories
                    </a>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="index.php?category=Fruits">Fruits</a></li>
                        <li><a class="dropdown-item" href="index.php?category=Vegetables">Vegetables</a></li>
                        <li><a class="dropdown-item" href="index.php?category=Dairy">Dairy</a></li>
                        <li><a class="dropdown-item" href="index.php?category=Meat">Meat</a></li>
                        <li><a class="dropdown-item" href="index.php?category=Bakery">Bakery</a></li>
                    </ul>
                </li>
            </ul>
            <div class="d-flex">
                <?php if (isLoggedIn()): ?>
                    <a href="cart.php" class="btn btn-outline-com position-relative me-2">
                        <i class="bi bi-cart"></i>
                        <?php if (!empty($_SESSION['cart'])): ?>
                            <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-com">
                                <?php echo array_sum($_SESSION['cart']); ?>
                            </span>
                        <?php endif; ?>
                    </a>
                    <div class="dropdown">
                        <button class="btn btn-outline-com dropdown-toggle" type="button" id="userDropdown" data-bs-toggle="dropdown">
                            <?php echo $_SESSION['username']; ?>
                        </button>
                        <ul class="dropdown-menu dropdown-menu-end">
                            <li><a class="dropdown-item" href="#">My Account</a></li>
                            <li><a class="dropdown-item" href="logout.php">Logout</a></li>
                        </ul>
                    </div>
                <?php else: ?>
                    <a href="login.php" class="btn btn-outline-com me-2">Login</a>
                    <a href="register.php" class="btn btn-com">Register</a>
                <?php endif; ?>
            </div>
        </div>
    </div>
</nav>
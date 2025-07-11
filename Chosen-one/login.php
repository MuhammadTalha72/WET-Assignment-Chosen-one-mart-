<?php include 'config.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login | Choosen One Mart</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css">
    <link rel="icon" type="image/png" sizes="32x32" href="images/favicon-green-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="images/favicon-green-16x16.png">
    <link rel="apple-touch-icon" sizes="180x180" href="images/apple-touch-icon-green.png">
    <link rel="manifest" href="site.webmanifest">
    <?php echo getThemeStyles(); ?>
    <style>
        .login-hero {
            background: linear-gradient(rgba(0,0,0,0.5), rgba(0,0,0,0.5)), url('images/grocery-bg.jpg');
            background-size: cover;
            background-position: center;
            color: white;
            padding: 100px 0;
            margin-bottom: 50px;
        }
    </style>
</head>
<body>
    <?php include 'navbar.php'; ?>
    
    
    <!-- Login Form -->
    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-md-6 col-lg-5">
                <div class="card shadow">
                    <div class="card-header bg-com text-white">
                        <h4 class="mb-0"><i class="bi bi-box-arrow-in-right"></i> Login to Your Account</h4>
                    </div>
                    <div class="card-body">
                        <?php
                        if (isset($_SESSION['success'])) {
                            echo '<div class="alert alert-success">' . $_SESSION['success'] . '</div>';
                            unset($_SESSION['success']);
                        }
                        
                        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                            $username = trim($_POST['username']);
                            $password = trim($_POST['password']);
                            $errors = [];
                            
                            if (empty($username)) $errors[] = "Username is required";
                            if (empty($password)) $errors[] = "Password is required";
                            
                            if (empty($errors)) {
                                $stmt = $pdo->prepare("SELECT * FROM users WHERE username = ?");
                                $stmt->execute([$username]);
                                $user = $stmt->fetch();
                                
                                if ($user && password_verify($password, $user['password'])) {
                                    $_SESSION['user_id'] = $user['id'];
                                    $_SESSION['username'] = $user['username'];
                                    
                                    // Retrieve cart items from database
                                    $stmt = $pdo->prepare("SELECT product_id, quantity FROM cart_items WHERE user_id = ?");
                                    $stmt->execute([$user['id']]);
                                    $cartItems = $stmt->fetchAll(PDO::FETCH_ASSOC);
                                    
                                    // Store cart items in session
                                    $_SESSION['cart'] = [];
                                    foreach ($cartItems as $item) {
                                        $_SESSION['cart'][$item['product_id']] = $item['quantity'];
                                    }
                                    
                                    header("Location: index.php");
                                    exit;
                                } else {
                                    $errors[] = "Invalid username or password";
                                }
                            }
                        }
                        ?>
                        
                        <?php if (!empty($errors)): ?>
                            <div class="alert alert-danger">
                                <?php foreach ($errors as $error): ?>
                                    <p class="mb-1"><?php echo $error; ?></p>
                                <?php endforeach; ?>
                            </div>
                        <?php endif; ?>
                        
                        <form method="post">
                            <div class="mb-3">
                                <label for="username" class="form-label">Username</label>
                                <input type="text" class="form-control" id="username" name="username" required>
                            </div>
                            <div class="mb-3">
                                <label for="password" class="form-label">Password</label>
                                <input type="password" class="form-control" id="password" name="password" required>
                            </div>
                            <div class="mb-3 form-check">
                                <input type="checkbox" class="form-check-input" id="remember">
                                <label class="form-check-label" for="remember">Remember me</label>
                            </div>
                            <button type="submit" class="btn btn-com w-100">
                                <i class="bi bi-box-arrow-in-right"></i> Login
                            </button>
                        </form>
                        
                        <div class="mt-3 text-center">
                            <a href="#" class="text-com">Forgot password?</a>
                            <p class="mt-2">Don't have an account? <a href="register.php" class="text-com">Register here</a></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <?php include 'footer.php'; ?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
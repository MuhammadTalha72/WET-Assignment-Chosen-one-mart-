<?php include 'config.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Checkout | Choosen One Mart</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css">
    <link rel="icon" type="image/png" sizes="32x32" href="images/favicon-green-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="images/favicon-green-16x16.png">
    <link rel="apple-touch-icon" sizes="180x180" href="images/apple-touch-icon-green.png">
    <link rel="manifest" href="site.webmanifest">

    <?php echo getThemeStyles(); ?>
</head>
<body>
    <?php include 'navbar.php'; ?>
    
    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-md-8 col-lg-6">
                <div class="card shadow">
                    <div class="card-header bg-com text-white">
                        <h3 class="mb-0"><i class="bi bi-cart-check me-2"></i> Order Confirmation</h3>
                    </div>
                    <div class="card-body text-center py-4">
                        <?php
                        if (!isLoggedIn()) {
                            header("Location: login.php");
                            exit;
                        }

                        if (empty($_SESSION['cart'])) {
                            header("Location: cart.php");
                            exit;
                        }

                        // Process order here (in a real application)
                        $userId = $_SESSION['user_id'];
                        
                        // Clear the cart
                        unset($_SESSION['cart']);
                        $stmt = $pdo->prepare("DELETE FROM cart_items WHERE user_id = ?");
                        $stmt->execute([$userId]);
                        ?>
                        
                        <div class="mb-4">
                            <i class="bi bi-check-circle-fill text-success" style="font-size: 4rem;"></i>
                        </div>
                        <h2 class="text-com mb-3">Thank You For Your Order!</h2>
                        <p class="lead">Your purchase was successful.</p>
                        <p class="text-muted">Order confirmation has been sent to your email.</p>
                        
                        <div class="d-grid gap-2 d-md-flex justify-content-md-center mt-4">
                            <a href="index.php" class="btn btn-com me-md-2">
                                <i class="bi bi-arrow-left"></i> Continue Shopping
                            </a>
                            <a href="orders.php" class="btn btn-outline-secondary">
                                <i class="bi bi-receipt"></i> View Orders
                            </a>
                        </div>
                    </div>
                    <div class="card-footer bg-light">
                        <div class="row">
                            <div class="col-md-6">
                                <h5><i class="bi bi-truck text-com"></i> Delivery Info</h5>
                                <p class="small text-muted">Items will ship within 2-3 business days.</p>
                            </div>
                            <div class="col-md-6">
                                <h5><i class="bi bi-headset text-com"></i> Support</h5>
                                <p class="small text-muted">Email us at support@choosenonemart.com</p>
                            </div>
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
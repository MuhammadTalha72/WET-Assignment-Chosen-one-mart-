<?php include 'config.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Your Cart | Choosen One Mart</title>
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
        <h2 class="text-center mb-5"><i class="bi bi-cart3"></i> Your Shopping Cart</h2>
        
        <?php if (isLoggedIn() && !empty($_SESSION['cart'])): ?>
            <div class="table-responsive">
                <table class="table">
                    <thead class="table-light">
                        <tr>
                            <th>Product</th>
                            <th>Price</th>
                            <th>Quantity</th>
                            <th>Total</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $total = 0;
                        foreach ($_SESSION['cart'] as $productId => $quantity):
                            $stmt = $pdo->prepare("SELECT * FROM products WHERE id = ?");
                            $stmt->execute([$productId]);
                            $product = $stmt->fetch();
                            $subtotal = $product['price'] * $quantity;
                            $total += $subtotal;
                        ?>
                            <tr>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <img src="images/<?php echo $product['image']; ?>" width="60" class="me-3">
                                        <div>
                                            <h6 class="mb-0"><?php echo htmlspecialchars($product['name']); ?></h6>
                                            <small class="text-muted"><?php echo $product['category']; ?></small>
                                        </div>
                                    </div>
                                </td>
                                <td>$<?php echo number_format($product['price'], 2); ?></td>
                                <td>
                                    <form action="update_cart.php" method="post" class="d-flex">
                                        <input type="hidden" name="product_id" value="<?php echo $productId; ?>">
                                        <input type="number" name="quantity" value="<?php echo $quantity; ?>" min="1" class="form-control" style="width: 70px;">
                                        <button type="submit" class="btn btn-sm btn-outline-com ms-2">
                                            <i class="bi bi-arrow-clockwise"></i>
                                        </button>
                                    </form>
                                </td>
                                <td>$<?php echo number_format($subtotal, 2); ?></td>
                                <td>
                                    <form action="remove_from_cart.php" method="post">
                                        <input type="hidden" name="product_id" value="<?php echo $productId; ?>">
                                        <button type="submit" class="btn btn-sm btn-outline-danger">
                                            <i class="bi bi-trash"></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
            
            <div class="row justify-content-end mt-4">
                <div class="col-md-5">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Order Summary</h5>
                            <hr>
                            <div class="d-flex justify-content-between mb-2">
                                <span>Subtotal:</span>
                                <span>$<?php echo number_format($total, 2); ?></span>
                            </div>
                            <div class="d-flex justify-content-between mb-2">
                                <span>Delivery:</span>
                                <span>$2.99</span>
                            </div>
                            <hr>
                            <div class="d-flex justify-content-between fw-bold">
                                <span>Total:</span>
                                <span>$<?php echo number_format($total + 2.99, 2); ?></span>
                            </div>
                            <a href="checkout.php" class="btn btn-com w-100 mt-3">
                                <i class="bi bi-arrow-right"></i> Proceed to Checkout
                            </a>
                            <a href="index.php" class="btn btn-outline-secondary w-100 mt-2">
                                <i class="bi bi-arrow-left"></i> Continue Shopping
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            
        <?php elseif (isLoggedIn()): ?>
            <div class="text-center py-5">
                <i class="bi bi-cart-x text-muted" style="font-size: 3rem;"></i>
                <h4 class="mt-3">Your cart is empty</h4>
                <p class="text-muted">Start shopping to add groceries to your cart</p>
                <a href="index.php" class="btn btn-com mt-3">Browse Products</a>
            </div>
        <?php else: ?>
            <div class="text-center py-5">
                <i class="bi bi-person-x text-muted" style="font-size: 3rem;"></i>
                <h4 class="mt-3">Please login to view your cart</h4>
                <p class="text-muted">Sign in to see the items you've added</p>
                <a href="login.php" class="btn btn-com mt-3">Login Now</a>
            </div>
        <?php endif; ?>
    </div>

    <?php include 'footer.php'; ?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
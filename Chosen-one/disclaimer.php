<?php include 'config.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Disclaimer | Choosen One Mart</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css">
    <link rel="icon" type="image/png" sizes="32x32" href="images/favicon-green-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="images/favicon-green-16x16.png">
    <link rel="apple-touch-icon" sizes="180x180" href="images/apple-touch-icon-green.png">
    <link rel="manifest" href="site.webmanifest">
    <?php echo getThemeStyles(); ?>
    <style>
        .disclaimer-container { min-height: 100vh; }
        .disclaimer-card { max-width: 800px; border: none; box-shadow: 0 5px 15px rgba(0,0,0,0.1); }
    </style>
</head>
<body>
    <?php include 'navbar.php'; ?>
    
    <div class="disclaimer-container d-flex align-items-center bg-light">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-8">
                    <div class="disclaimer-card card">
                        <div class="card-header bg-com text-white">
                            <h4 class="mb-0"><i class="bi bi-info-circle"></i> Important Notice</h4>
                        </div>
                        <div class="card-body p-4 p-md-5">
                            <div class="text-center mb-4">
                                <i class="bi bi-exclamation-triangle-fill text-com" style="font-size: 3rem;"></i>
                            </div>
                            <h2 class="text-center text-com mb-4">Educational Purpose Only</h2>
                            <div class="alert alert-warning">
                                <p class="lead">This is a demo grocery store website created for educational purposes only.</p>
                                <ul>
                                    <li>No real transactions are processed</li>
                                    <li>Product images are for demonstration</li>
                                    <li>No personal data is stored permanently</li>
                                    <li>Part of a web development learning exercise</li>
                                </ul>
                            </div>
                        </div>
                        <div class="card-footer text-center py-3">
                            <a href="index.php" class="btn btn-com">
                                <i class="bi bi-arrow-left"></i> Back to Demo Store
                            </a>
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
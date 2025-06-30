<?php
session_start();
require_once 'config/database.php';
require_once 'includes/functions.php';

// Get all products
$sql = "SELECT * FROM products ORDER BY id DESC";
$result = $conn->query($sql);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Shopping Cart</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .product-card {
            border: 1px solid #ddd;
            padding: 20px;
            margin-bottom: 20px;
            border-radius: 8px;
        }
    </style>
</head>
<body>
    <div class="container mt-4">
        <div class="row">
            <div class="col-md-9">
                <h2>Products</h2>
                <div class="row">
                    <?php while($product = $result->fetch_assoc()): ?>
                        <div class="col-md-4 mb-4">
                            <div class="product-card">
                                <h5><?php echo htmlspecialchars($product['name']); ?></h5>
                                <p>$<?php echo number_format($product['price'], 2); ?></p>
                                <p><?php echo htmlspecialchars($product['description']); ?></p>
                                <form action="cart.php" method="POST">
                                    <input type="hidden" name="product_id" value="<?php echo $product['id']; ?>">
                                    <input type="hidden" name="action" value="add">
                                    <button type="submit" class="btn btn-primary">Add to Cart</button>
                                </form>
                            </div>
                        </div>
                    <?php endwhile; ?>
                </div>
            </div>
            <div class="col-md-3">
                <h3>Cart</h3>
                <?php include 'includes/cart-sidebar.php'; ?>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

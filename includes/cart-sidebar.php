<?php
function get_cart_total() {
    $total = 0;
    foreach ($_SESSION['cart'] ?? [] as $product_id) {
        $sql = "SELECT price FROM products WHERE id = ?";
        $stmt = $GLOBALS['conn']->prepare($sql);
        $stmt->bind_param("i", $product_id);
        $stmt->execute();
        $result = $stmt->get_result();
        $product = $result->fetch_assoc();
        if ($product) {
            $total += $product['price'];
        }
    }
    return $total;
}

$cart_items = $_SESSION['cart'] ?? [];
?>
<div class="cart-summary">
    <h4>Cart Items</h4>
    <?php if (empty($cart_items)): ?>
        <p>Your cart is empty</p>
    <?php else: ?>
        <ul class="list-group">
            <?php foreach ($cart_items as $product_id): ?>
                <?php
                $sql = "SELECT name, price FROM products WHERE id = ?";
                $stmt = $GLOBALS['conn']->prepare($sql);
                $stmt->bind_param("i", $product_id);
                $stmt->execute();
                $product = $stmt->get_result()->fetch_assoc();
                ?>
                <li class="list-group-item">
                    <?php echo htmlspecialchars($product['name']); ?> - $<?php echo number_format($product['price'], 2); ?>
                    <form action="cart.php" method="POST" style="display: inline;">
                        <input type="hidden" name="product_id" value="<?php echo $product_id; ?>">
                        <input type="hidden" name="action" value="remove">
                        <button type="submit" class="btn btn-sm btn-danger">Remove</button>
                    </form>
                </li>
            <?php endforeach; ?>
        </ul>
        <p class="mt-3"><strong>Total: $<?php echo number_format(get_cart_total(), 2); ?></strong></p>
    <?php endif; ?>
</div>

<?php
// Author: Aljowry
// Task: Checkout page (update quantities, delete items, empty cart, buy products, save past purchases)

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

include 'includes/header.php';
include 'database/db.php';

if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = [];
}

$message = "";
$purchase_completed = false;

// Remove item
if (isset($_GET['remove'])) {
    $remove_id = (int) $_GET['remove'];

    if (isset($_SESSION['cart'][$remove_id])) {
        unset($_SESSION['cart'][$remove_id]);
        $message = "Product removed successfully.";
    }
}

// Empty cart
if (isset($_GET['empty']) && $_GET['empty'] == 1) {
    $_SESSION['cart'] = [];
    $message = "Cart emptied successfully.";
}

// Update quantities
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['update_cart'])) {
    if (isset($_POST['quantities']) && is_array($_POST['quantities'])) {
        foreach ($_POST['quantities'] as $product_id => $quantity) {
            $product_id = (int) $product_id;
            $quantity = (int) $quantity;

            if ($quantity <= 0) {
                unset($_SESSION['cart'][$product_id]);
            } else {
                if (isset($_SESSION['cart'][$product_id])) {
                    $_SESSION['cart'][$product_id]['quantity'] = $quantity;
                }
            }
        }

        $message = "Cart updated successfully.";
    }
}

// Buy products
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['buy_now'])) {
    if (!empty($_SESSION['cart'])) {
        setcookie("past_purchases", json_encode($_SESSION['cart']), time() + (86400 * 30), "/");
        $_SESSION['cart'] = [];
        $purchase_completed = true;
        $message = "Purchase completed successfully.";
    } else {
        $message = "Your cart is empty.";
    }
}
?>

<section class="main-section">
    <h2 class="section-title">Checkout</h2>

    <?php if (!empty($message)) { ?>
        <p><strong><?php echo $message; ?></strong></p>
    <?php } ?>

    <?php if ($purchase_completed) { ?>
        <p>Your order has been placed and your cart is now empty.</p>
        <div class="button-group">
            <a href="products.php" class="btn btn-primary">Continue Shopping</a>
        </div>

    <?php } elseif (!empty($_SESSION['cart'])) { ?>
        <form method="POST" action="checkout.php">
            <div class="products-container">
                <?php
                $grand_total = 0;

                foreach ($_SESSION['cart'] as $item) {
                    $total = $item['price'] * $item['quantity'];
                    $grand_total += $total;
                ?>
                    <div class="product-card">
                        <img src="images/products/<?php echo htmlspecialchars($item['image']); ?>" alt="<?php echo htmlspecialchars($item['name']); ?>" width="150">
                        <h3><?php echo htmlspecialchars($item['name']); ?></h3>
                        <p><strong>Price:</strong> <?php echo number_format($item['price'], 2); ?> SAR</p>

                        <label for="qty_<?php echo $item['id']; ?>">Quantity:</label>
                        <input
                            type="number"
                            id="qty_<?php echo $item['id']; ?>"
                            name="quantities[<?php echo $item['id']; ?>]"
                            value="<?php echo $item['quantity']; ?>"
                            min="1"
                        >

                        <p><strong>Total:</strong> <?php echo number_format($total, 2); ?> SAR</p>

                        <a href="checkout.php?remove=<?php echo $item['id']; ?>" class="btn btn-secondary">Delete</a>
                    </div>
                <?php } ?>
            </div>

            <h3>Grand Total: <?php echo number_format($grand_total, 2); ?> SAR</h3>

            <div class="button-group">
                <button type="submit" name="update_cart" class="btn btn-primary">Update Cart</button>
                <a href="checkout.php?empty=1" class="btn btn-secondary">Delete All</a>
                <button type="submit" name="buy_now" class="btn btn-primary">Buy Now</button>
            </div>
        </form>

    <?php } else { ?>
        <p>Your cart is empty.</p>
        <div class="button-group">
            <a href="products.php" class="btn btn-primary">Continue Shopping</a>
        </div>
    <?php } ?>
</section>

<?php include 'includes/footer.php'; ?>
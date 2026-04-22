<?php
// Author: Aljowry
// Task: Shopping cart page (add products, display cart, remove items, empty cart)

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

include 'includes/header.php';
include 'database/db.php';

if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = [];
}

$message = "";

// Add product to cart
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['product_id'], $_POST['quantity']) && !isset($_POST['update_cart'])) {
    $product_id = (int) $_POST['product_id'];
    $quantity = (int) $_POST['quantity'];

    if ($quantity < 1) {
        $quantity = 1;
    }

    $query = "SELECT id, name, price, image, stock FROM products WHERE id = $product_id";
    $result = mysqli_query($conn, $query);

    if ($result && mysqli_num_rows($result) > 0) {
        $product = mysqli_fetch_assoc($result);

        $available_stock = isset($product['stock']) ? (int)$product['stock'] : 0;
        $current_quantity = isset($_SESSION['cart'][$product_id]) ? (int)$_SESSION['cart'][$product_id]['quantity'] : 0;
        $new_quantity = $current_quantity + $quantity;

        if ($available_stock <= 0) {
            $message = "Product is out of stock.";
        } elseif ($new_quantity > $available_stock) {
            $message = "Requested quantity is not available in stock.";
        } else {
            if (isset($_SESSION['cart'][$product_id])) {
                $_SESSION['cart'][$product_id]['quantity'] = $new_quantity;
            } else {
                $_SESSION['cart'][$product_id] = [
                    'id' => $product['id'],
                    'name' => $product['name'],
                    'price' => $product['price'],
                    'image' => $product['image'],
                    'quantity' => $quantity
                ];
            }

            $message = "Product added to cart successfully.";
        }
    } else {
        $message = "Product not found.";
    }
}

// Update quantities
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['update_cart'])) {
    if (isset($_POST['quantities']) && is_array($_POST['quantities'])) {
        foreach ($_POST['quantities'] as $product_id => $quantity) {
            $product_id = (int) $product_id;
            $quantity = (int) $quantity;

            if (!isset($_SESSION['cart'][$product_id])) {
                continue;
            }

            $stock_query = "SELECT stock FROM products WHERE id = $product_id";
            $stock_result = mysqli_query($conn, $stock_query);

            if ($stock_result && mysqli_num_rows($stock_result) > 0) {
                $product_data = mysqli_fetch_assoc($stock_result);
                $available_stock = isset($product_data['stock']) ? (int)$product_data['stock'] : 0;

                if ($quantity <= 0) {
                    unset($_SESSION['cart'][$product_id]);
                } elseif ($available_stock <= 0) {
                    $message = "Product is out of stock.";
                } elseif ($quantity > $available_stock) {
                    $message = "Requested quantity exceeds available stock.";
                } else {
                    $_SESSION['cart'][$product_id]['quantity'] = $quantity;
                }
            }
        }

        if ($message === "") {
            $message = "Cart updated successfully.";
        }
    }
}

// Remove item
if (isset($_GET['remove'])) {
    $remove_id = (int) $_GET['remove'];

    if (isset($_SESSION['cart'][$remove_id])) {
        unset($_SESSION['cart'][$remove_id]);
        $message = "Product removed from cart.";
    }
}

// Empty cart
if (isset($_GET['empty']) && $_GET['empty'] == 1) {
    $_SESSION['cart'] = [];
    $message = "Cart emptied successfully.";
}
?>

<section class="main-section">
    <h2 class="section-title">Shopping Cart</h2>

    <?php if (!empty($message)) { ?>
        <p><strong><?php echo htmlspecialchars($message); ?></strong></p>
    <?php } ?>

    <?php if (!empty($_SESSION['cart'])) { ?>
        <form method="POST" action="cart.php">
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
                            value="<?php echo (int)$item['quantity']; ?>"
                            min="1"
                        >

                        <p><strong>Total:</strong> <?php echo number_format($total, 2); ?> SAR</p>
                        <a href="cart.php?remove=<?php echo $item['id']; ?>" class="btn btn-secondary">Delete</a>
                    </div>
                <?php } ?>
            </div>

            <h3>Grand Total: <?php echo number_format($grand_total, 2); ?> SAR</h3>

            <div class="button-group">
                <button type="submit" name="update_cart" class="btn btn-primary">Update Cart</button>
                <a href="checkout.php" class="btn btn-primary">Go to Checkout</a>
                <a href="cart.php?empty=1" class="btn btn-secondary">Empty Cart</a>
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
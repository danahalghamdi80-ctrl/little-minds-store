<?php include 'includes/header.php'; ?>
<?php include 'database/db.php'; ?>

<section class="main-section">
    <?php
    if (!isset($_GET['id'])) {
        echo "<p>Product not found.</p>";
    } else {
        $id = (int) $_GET['id'];
        $result = mysqli_query($conn, "SELECT * FROM products WHERE id = $id");

        if ($result && mysqli_num_rows($result) > 0) {
            $product = mysqli_fetch_assoc($result);
    ?>
            <div class="product-details">
                <img src="images/products/<?php echo $product['image']; ?>" alt="<?php echo $product['name']; ?>" width="220">
                <h2><?php echo $product['name']; ?></h2>
                <p><?php echo $product['description']; ?></p>
                <p><strong>Price:</strong> <?php echo $product['price']; ?> SAR</p>

                <form action="cart.php" method="POST">
                    <input type="hidden" name="product_id" value="<?php echo $product['id']; ?>">

                    <label for="quantity">Quantity:</label>
                    <input type="number" name="quantity" value="1" min="1">

                    <br><br>
                    <button type="submit" class="btn btn-primary">Add to Cart</button>
                </form>
            </div>
    <?php
        } else {
            echo "<p>Product not found.</p>";
        }
    }
    ?>
</section>

<?php include 'includes/footer.php'; ?>

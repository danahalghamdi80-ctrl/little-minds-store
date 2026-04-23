<<<<<<< HEAD
=======
<?php
// Author: Jana Alqahtani
// Task: Display all products retrieved from the database
?>
>>>>>>> 1ca5c51b5db1f380816c59e9230d6d85593f7b13

<?php include 'includes/header.php'; ?>
<?php include 'database/db.php'; ?>

<style>
    .section-title {
        text-align: center;
        margin-bottom: 30px;
    }

    .products-container {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 30px;
        justify-items: center;
        align-items: stretch;
    }

    .product-card {
        background-color: #ffffff;
        padding: 20px;
        border-radius: 12px;
        text-align: center;
        width: 250px;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);

        display: flex;
        flex-direction: column;
        justify-content: space-between;
        height: 100%;
    }

    .product-card img {
        width: 150px;
        height: 150px;
        object-fit: cover;
        margin: 0 auto 15px;
    }

    .product-card h3 {
        margin-bottom: 10px;
    }

    .product-card p {
        margin-bottom: 10px;
    }

    .product-card .btn {
        margin-top: auto;
    }
</style>

<section class="main-section">
    <h2 class="section-title">Our Products</h2>

    <div class="products-container">
        <?php
        $result = mysqli_query($conn, "SELECT * FROM products");

        if ($result && mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
        ?>
                <div class="product-card">
                    <img src="images/products/<?php echo $row['image']; ?>" alt="<?php echo $row['name']; ?>">
                    <h3><?php echo $row['name']; ?></h3>
                    <p><?php echo $row['description']; ?></p>
                    <p><strong><?php echo $row['price']; ?> SAR</strong></p>
                    <a href="product-details.php?id=<?php echo $row['id']; ?>" class="btn btn-primary">View Details</a>
                </div>
        <?php
            }
        } else {
            echo "<p>No products found.</p>";
        }
        ?>
    </div>
</section>

<?php include 'includes/footer.php'; ?>

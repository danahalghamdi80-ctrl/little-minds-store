<?php
$pageTitle = "Little Minds Store - Contact Us";

$name = "";
$email = "";
$message = "";

$nameError = "";
$emailError = "";
$messageError = "";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $pageTitle; ?></title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>

<header>
    <div class="logo">
        <span class="logo-icon">🧸</span>
        <span class="store-name">Little Minds Store</span>
    </div>

    <nav>
        <a href="index.php">Home</a>
        <a href="products.php">Products</a>
        <a href="contact.php">Contact Us</a>
        <a href="cart.php" class="cart-link">
            <span class="cart-icon">🛒</span>
            <span>Cart</span>
        </a>
    </nav>
</header>

<section class="main-section">
    <div class="hero">
        <h1>Contact Us</h1>
        <p>
            If you have any questions or need help, you can contact us using the information below
            or send us a message through the form.
        </p>
    </div>

    <div class="contact-wrapper">
        <div class="contact-info-box">
            <h2 class="section-title">Store Information</h2>
            <p><strong>Store Name:</strong> Little Minds Store</p>
            <p><strong>Email:</strong> info@littlemindsstore.com</p>
            <p><strong>Phone:</strong> +966 5X XXX XXXX</p>
            <p><strong>Address:</strong> Dammam, Saudi Arabia</p>
            <p>
                This section can be updated later with the final team contact details and official store address.
            </p>
        </div>

        <div class="contact-form-box">
            <h2 class="section-title">Send a Message</h2>

            <form action="" method="post">
                <div class="form-group">
                    <label for="name">Full Name</label>
                    <input type="text" id="name" name="name" value="<?php echo htmlspecialchars($name); ?>">
                    <?php if (!empty($nameError)) { ?>
                        <span class="error-message"><?php echo $nameError; ?></span>
                    <?php } ?>
                </div>

                <div class="form-group">
                    <label for="email">Email Address</label>
                    <input type="email" id="email" name="email" value="<?php echo htmlspecialchars($email); ?>">
                    <?php if (!empty($emailError)) { ?>
                        <span class="error-message"><?php echo $emailError; ?></span>
                    <?php } ?>
                </div>

                <div class="form-group">
                    <label for="message">Message</label>
                    <textarea id="message" name="message"><?php echo htmlspecialchars($message); ?></textarea>
                    <?php if (!empty($messageError)) { ?>
                        <span class="error-message"><?php echo $messageError; ?></span>
                    <?php } ?>
                </div>

                <button type="submit" class="btn btn-primary">Send Message</button>
            </form>
        </div>
    </div>

    <br>

    <div class="map-box">
        <h2 class="section-title">Store Location</h2>
        <p>
            Google Map will be added here later after confirming the final store location.
        </p>
    </div>
</section>

<footer>
    <p>&copy; 2026 Little Minds Store. All rights reserved.</p>
</footer>

</body>
</html>
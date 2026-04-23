

<?php
// Author: Danah
// Task: Home page for Little Minds Store

error_reporting(E_ALL);
ini_set('display_errors', 1);

$pageTitle = "Little Minds Store - Home";
include 'includes/header.php';
?>


<section class="main-section">
    <div class="hero">
        <h1>Learning Through Play Starts Here</h1>
        <p>
            Welcome to Little Minds Store, where educational toys and creative learning tools
            make every playtime more meaningful, enjoyable, and inspiring for children.
        </p>

        <div class="button-group">
            <a href="products.php" class="btn btn-primary">Shop Now</a>
            <a href="contact.php" class="btn btn-secondary">Contact Us</a>
        </div>
    </div>

    <section>
        <h2 class="section-title">About Our Store</h2>
        <div class="placeholder-box">
            <p>
        
                Little Minds Store is a modern online platform dedicated to providing high-quality educational products for children.

                Our goal is to support early learning and creativity through carefully selected toys, books, and interactive tools that combine fun with education.

                We aim to offer parents a simple, reliable, and enjoyable shopping experience, with a focus on quality, usability, and future expansion of features such as personalized recommendations and advanced shopping options.



            
            </p>
        </div>
    </section>

    <br>

    <section>
        <h2 class="section-title">Why Choose Us</h2>
        <div class="placeholder-box">
            <p>
               At Little Minds Store, we prioritize both quality and user experience. Our platform is designed to be simple, intuitive, and accessible for all users.

               We carefully select products that promote learning, creativity, and child development, ensuring they meet high standards of safety and educational value.

               Our system is built with scalability in mind, allowing future integration of advanced features such as secure checkout, personalized recommendations, and enhanced user accounts to improve the overall shopping experience.
            </p>
        </div>
    </section>


   <div class="map-box" style="margin-top: 20px;">
    <h2 class="section-title">Past Purchases</h2>

    <div id="pastPurchasesContainer">
        <p id="pastPurchasesText">
            Returning customers will be able to view their past purchases here.
        </p>
    </div>

</div>
</section>

<?php include 'includes/footer.php'; ?>
<script>
document.addEventListener("DOMContentLoaded", function () {

    let purchases = localStorage.getItem("pastPurchases");
    let container = document.getElementById("pastPurchasesContainer");

    if (container) {
        if (purchases) {
            purchases = JSON.parse(purchases);

            if (purchases.length > 0) {
                let output = "<ul>";

                purchases.forEach(item => {
                    output += "<li>" + item + "</li>";
                });

                output += "</ul>";

                container.innerHTML = output;
            } else {
                container.innerHTML = "<p>No past purchases found yet.</p>";
            }
        } else {
            container.innerHTML = "<p>No past purchases found yet.</p>";
        }
    }

});
</script>
<?php
// Author: Danah
// Task: Contact Us page for Little Minds Store

$pageTitle = "Little Minds Store - Contact Us";
include 'includes/header.php';
?>

<section class="main-section">
    <div class="hero" style="padding-bottom: 30px;">
        <h1>Contact Us</h1>
        <p>
            We are happy to hear from you. For any questions or support, please use the contact information
            below or send us a message through the form.
        </p>
    </div>

    <div class="contact-wrapper">
        <div class="contact-info-box">
            <h2 class="section-title">Store Information</h2>
            <p><strong>Store Name:</strong> Little Minds Store</p>
            <p><strong>Email:</strong> info@littleminds.com</p>
            <p><strong>Phone:</strong> +966 5XXXXXXXX</p>
            <p><strong>Location:</strong> Dammam, Saudi Arabia</p>
        </div>

        <div class="contact-form-box">
            <h2 class="section-title">Send Message</h2>

            <form id="contactForm" method="post" action="" novalidate>
                <div class="form-group">
                    <label for="name">Name</label>
                    <input
                        type="text"
                        id="name"
                        name="name"
                        placeholder="Enter your name"
                    >
                    <span class="error-message" id="nameError"></span>
                </div>

                <div class="form-group">
                    <label for="email">Email</label>
                    <input
                        type="text"
                        id="email"
                        name="email"
                        placeholder="example@email.com"
                        autocomplete="off"
                    >
                    <span class="error-message" id="emailError"></span>
                </div>

                <div class="form-group">
                    <label for="message">Message</label>
                    <textarea
                        id="message"
                        name="message"
                        placeholder="Write your message here..."
                    ></textarea>
                    <span class="error-message" id="messageError"></span>
                </div>

                <button type="submit" class="btn btn-primary">Send Message</button>
            </form>
        </div>
    </div>

    <div style="margin-top: 28px;" class="map-box">
        <h2 class="section-title">Store Location</h2>
        <p><strong>Location:</strong> Dammam, Saudi Arabia</p>

        <iframe
            src="https://maps.google.com/maps?q=Dammam%20Saudi%20Arabia&t=&z=13&ie=UTF8&iwloc=&output=embed"
            width="100%"
            height="300"
            style="border:0; border-radius:12px; margin-top:16px;"
            loading="lazy"
            referrerpolicy="no-referrer-when-downgrade">
        </iframe>
    </div>
</section>

<?php include 'includes/footer.php'; ?>
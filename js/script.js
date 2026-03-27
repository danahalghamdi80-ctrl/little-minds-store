// Author: Danah
// Task: JavaScript validation + cookies logic
document.addEventListener("DOMContentLoaded", function () {
    setupContactValidation();
    renderPastPurchases();
});

/* =========================
   CONTACT FORM VALIDATION
========================= */
function setupContactValidation() {
    const form = document.getElementById("contactForm");
    if (!form) return;

    form.addEventListener("submit", function (e) {
        let isValid = true;

        const name = document.getElementById("name");
        const email = document.getElementById("email");
        const message = document.getElementById("message");

        const nameError = document.getElementById("nameError");
        const emailError = document.getElementById("emailError");
        const messageError = document.getElementById("messageError");

        nameError.textContent = "";
        emailError.textContent = "";
        messageError.textContent = "";

        name.classList.remove("input-error");
        email.classList.remove("input-error");
        message.classList.remove("input-error");

        if (name.value.trim() === "") {
            nameError.textContent = "Please enter your name.";
            name.classList.add("input-error");
            isValid = false;
        }

        const emailPattern = /^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/;

        if (email.value.trim() === "") {
            emailError.textContent = "Please enter your email address.";
            email.classList.add("input-error");
            isValid = false;
        } else if (!emailPattern.test(email.value.trim())) {
            emailError.textContent = "Please enter a valid email address.";
            email.classList.add("input-error");
            isValid = false;
        }

        if (message.value.trim() === "") {
            messageError.textContent = "Please write your message.";
            message.classList.add("input-error");
            isValid = false;
        }

        if (!isValid) {
            e.preventDefault();
        }
    });
}

/* =========================
   COOKIES - PAST PURCHASES
========================= */
function setCookie(name, value, days) {
    const expires = new Date();
    expires.setTime(expires.getTime() + (days * 24 * 60 * 60 * 1000));
    document.cookie = name + "=" + encodeURIComponent(value) + ";expires=" + expires.toUTCString() + ";path=/";
}

function getCookie(name) {
    const cookieName = name + "=";
    const cookies = document.cookie.split(";");

    for (let i = 0; i < cookies.length; i++) {
        let cookie = cookies[i].trim();
        if (cookie.indexOf(cookieName) === 0) {
            return decodeURIComponent(cookie.substring(cookieName.length));
        }
    }
    return "";
}

function savePastPurchase(productName) {
    let purchases = getCookie("pastPurchases");
    let purchaseArray = purchases ? purchases.split("|") : [];

    if (!purchaseArray.includes(productName)) {
        purchaseArray.push(productName);
    }

    setCookie("pastPurchases", purchaseArray.join("|"), 30);
}

function renderPastPurchases() {
    const container = document.getElementById("pastPurchasesContainer");
    if (!container) return;

    const purchases = getCookie("pastPurchases");

    if (!purchases) {
        container.innerHTML = "<p id='pastPurchasesText'>No past purchases found yet.</p>";
        return;
    }

    const purchaseArray = purchases.split("|");
    let html = "<ul>";

    purchaseArray.forEach(function (item) {
        html += "<li>" + item + "</li>";
    });

    html += "</ul>";
    container.innerHTML = html;
}

/* 
You can call this later after a successful purchase, for example:
savePastPurchase("Alphabet Toy");
savePastPurchase("Blocks");
*/
window.savePastPurchase = savePastPurchase;
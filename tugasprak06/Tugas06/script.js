document.addEventListener("DOMContentLoaded", function () {
    document
        .getElementById("registrationForm")
        .addEventListener("submit", function (event) {
            event.preventDefault();
            validateForm();
        });
});

function validateForm() {
    const name = document.getElementById("name").value.trim();
    const username = document.getElementById("username").value.trim();
    const email = document.getElementById("email").value.trim();
    const password = document.getElementById("password").value.trim();

    const nameError = document.getElementById("nameError");
    const usernameError = document.getElementById("usernameError");
    const emailError = document.getElementById("emailError");
    const passwordError = document.getElementById("passwordError");

    nameError.textContent = "";
    usernameError.textContent = "";
    emailError.textContent = "";
    passwordError.textContent = "";

    let isValid = true;

    if (name.length < 3) {
        nameError.textContent = "Name must be at least 3 characters";
        isValid = false;
    }

    if (username.length < 4 || !/^[a-zA-Z0-9]+$/.test(username)) {
        usernameError.textContent = "Username must be at least 4 characters and contain only letters and numbers";
        isValid = false;
    }

    if (!validateEmail(email)) {
        emailError.textContent = "Invalid email address";
        isValid = false;
    }

    if (password.length < 8 || !/[!@#$%^&*(),.?":{}|<>0-9A-Z]/.test(password) || !/[a-z]/.test(password) || !/[A-Z]/.test(password)) {
        passwordError.textContent = "Password must be at least 8 characters and include at least one symbol, one digit, and one uppercase letter";
        isValid = false;
    }

    if (isValid) {
        // Submit the form
        document.getElementById("registrationForm").submit();
    }
}

function validateEmail(email) {
    const re = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    return re.test(email);
}

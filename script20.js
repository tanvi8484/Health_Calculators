document.addEventListener("DOMContentLoaded", function () {
    // Registration Form Validation
    const regForm = document.getElementById("registrationForm");

    if (regForm) {
        regForm.addEventListener("submit", function (event) {
            event.preventDefault(); // Prevent default form submission

            let password = document.querySelector("input[name='password']").value;
            let confirmPassword = document.querySelector("input[name='confirmPassword']").value;

            if (password.length < 6) {
                alert("Password must be at least 6 characters long.");
                return;
            }

            if (password !== confirmPassword) {
                alert("Passwords do not match.");
                return;
            }

            alert("Registration Successful! Redirecting to login...");
            this.submit(); // Submit form if validation passes
        });
    }

    // Login Form Handling
    const loginForm = document.getElementById("loginForm");

    if (loginForm) {
        loginForm.addEventListener("submit", function (event) {
            event.preventDefault();

            let username = document.querySelector("input[name='username']").value;
            let password = document.querySelector("input[name='password']").value;

            if (username.trim() === "" || password.trim() === "") {
                alert("Please fill in all fields.");
                return;
            }

            alert("Login Successful! Redirecting...");
            this.submit();
        });
    }
});

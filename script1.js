// script.js

// Handle registration
document.getElementById('registerForm').addEventListener('submit', function(e) {
    e.preventDefault(); // Prevent form submission

    const name = document.getElementById('name').value;
    const contact = document.getElementById('contact').value;
    const email = document.getElementById('email').value;
    const password = document.getElementById('password').value;
    const confirmPassword = document.getElementById('confirmPassword').value;

    // Simple validation
    if (password !== confirmPassword) {
        alert("Passwords do not match!");
        return;
    }

    // Store user data in localStorage (for demonstration purposes)
    localStorage.setItem('userName', name);
    localStorage.setItem('userContact', contact);
    localStorage.setItem('userEmail', email);
    localStorage.setItem('userPassword', password);

    // Redirect to login page after successful registration
    alert("Registration successful! Redirecting to login page...");
    window.location.href = 'login.html';
});

// Handle login
document.getElementById('loginForm').addEventListener('submit', function(e) {
    e.preventDefault(); // Prevent form submission

    const loginEmail = document.getElementById('loginEmail').value;
    const loginPassword = document.getElementById('loginPassword').value;

    // Retrieve user data from localStorage
    const storedEmail = localStorage.getItem('userEmail');
    const storedPassword = localStorage.getItem('userPassword');

    // Check if the entered credentials match the stored ones
    if (loginEmail === storedEmail && loginPassword === storedPassword) {
        document.getElementById('loginMessage').innerText = "Logged in successfully!";
        document.getElementById('loginMessage').style.color = "#4CAF50"; // Green color for success
    } else {
        document.getElementById('loginMessage').innerText = "Invalid email or password.";
        document.getElementById('loginMessage').style.color = "red"; // Red color for error
    }
    // Redirect to Home page
    alert(" Redirecting to Home page...");
    window.location.href = 'file:///C:/xampp/Chinmay%20Project/NewCreation/index.html';
});
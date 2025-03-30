// Utility function for SHA-256 hashing (client-side encryption)
async function hashPassword(password) {
    const encoder = new TextEncoder();
    const data = encoder.encode(password);
    const hashBuffer = await crypto.subtle.digest('SHA-256', data);
    return Array.from(new Uint8Array(hashBuffer))
        .map(byte => byte.toString(16).padStart(2, '0'))
        .join('');
}

// Retrieve stored user data from localStorage
let userData = JSON.parse(localStorage.getItem('userData')) || {};

// Handle Registration
document.getElementById('registrationForm').addEventListener('submit', async function (event) {
    event.preventDefault(); // Prevent form submission

    const username = document.getElementById('regUsername').value.trim();
    const email = document.getElementById('regEmail').value.trim();
    const password = document.getElementById('regPassword').value;
    const confirmPassword = document.getElementById('confirmPassword').value;
    const registrationMessage = document.getElementById('registrationMessage');

    // Validate inputs
    if (!username || !email || !password || !confirmPassword) {
        registrationMessage.textContent = "All fields are required!";
        registrationMessage.style.color = "red";
        return;
    }

    if (!/\S+@\S+\.\S+/.test(email)) {
        registrationMessage.textContent = "Invalid email format!";
        registrationMessage.style.color = "red";
        return;
    }

    if (password !== confirmPassword) {
        registrationMessage.textContent = "Passwords do not match!";
        registrationMessage.style.color = "red";
        return;
    }

    if (password.length < 6) {
        registrationMessage.textContent = "Password must be at least 6 characters long!";
        registrationMessage.style.color = "red";
        return;
    }

    // Encrypt password
    const hashedPassword = await hashPassword(password);

    // Store user data securely
    userData = { username: username.toLowerCase(), email, password: hashedPassword };
    localStorage.setItem('userData', JSON.stringify(userData));

    registrationMessage.textContent = "Registration successful!";
    registrationMessage.style.color = "green";

    // Redirect after success
    setTimeout(() => {
        window.location.href = "login.html"; // Redirect to login page
    }, 2000);
});

// Handle Login
document.getElementById('loginForm').addEventListener('submit', async function (event) {
    event.preventDefault(); // Prevent form submission

    const loginUsername = document.getElementById('loginUsername').value.trim().toLowerCase();
    const loginPassword = document.getElementById('loginPassword').value;
    const loginMessage = document.getElementById('loginMessage');

    // Validate input
    if (!loginUsername || !loginPassword) {
        loginMessage.textContent = "Both fields are required!";
        loginMessage.style.color = "red";
        return;
    }

    // Debugging logs
    console.log("Entered Username:", loginUsername);
    console.log("Stored Username:", userData.username);

    // Hash entered password to compare with stored hash
    const hashedLoginPassword = await hashPassword(loginPassword);

    // Validate user credentials
    if (!userData.username || !userData.password) {
        loginMessage.textContent = "No registered user found! Please register first.";
        loginMessage.style.color = "red";
        return;
    }

    if (loginUsername !== userData.username) {
        loginMessage.textContent = "Invalid username!";
        loginMessage.style.color = "red";
        return;
    }

    if (hashedLoginPassword !== userData.password) {
        loginMessage.textContent = "Invalid password!";
        loginMessage.style.color = "red";
        return;
    }

    loginMessage.textContent = "Login successful!";
    loginMessage.style.color = "green";

    // Store session data
    sessionStorage.setItem('loggedInUser', loginUsername);

    // Redirect after a short delay
    setTimeout(() => {
        alert("You are now logged in. Click OK to go to the home page.");
        window.location.href = "design.html"; // Redirect to home page
    }, 2000);
});

function calculateIdealWeight(event) {
    event.preventDefault(); // Prevent the default form submission

    const heightInput = document.getElementById('height').value;
    const height = parseFloat(heightInput); // Convert height to a float

    if (!isNaN(height) && height > 0) { // Check if height is a valid number and greater than 0
        // Using a simple formula: Ideal Weight (kg) = Height (cm) - 100
        const idealWeight = height - 100;
        document.getElementById('result').innerText = `Your ideal weight is approximately ${idealWeight.toFixed(2)} kg.`; // Display with 2 decimal places
    } else {
        document.getElementById('result').innerText = 'Please enter a valid height.';
    }
}
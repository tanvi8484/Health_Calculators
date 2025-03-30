document.getElementById('calculate').addEventListener('click', function() {
    const weight = parseFloat(document.getElementById('weight').value);
    const activityLevel = parseFloat(document.getElementById('activity').value);

    if (isNaN(weight) || weight <= 0) {
        alert("Please enter a valid weight.");
        return;
    }

    // Calculate daily water intake in liters
    const waterIntake = weight * 0.033 * activityLevel; // 0.033 liters per kg
    
    // Display the result
    document.getElementById('result').textContent = `You should drink approximately ${waterIntake.toFixed(2)} liters of water daily.`;
});
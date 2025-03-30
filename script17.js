document.getElementById('calculateBtn').addEventListener('click', function() {
    const currentSugar = parseFloat(document.getElementById('currentSugar').value);
    const targetSugar = parseFloat(document.getElementById('targetSugar').value);
    
    if (isNaN(currentSugar) || isNaN(targetSugar)) {
        alert("Please enter valid numbers for both fields.");
        return;
    }

    // Simple formula for carbohydrate intake calculation
    const carbohydrateIntake = (targetSugar - currentSugar) * 0.5; // Example factor

    const resultDiv = document.getElementById('result');
    if (carbohydrateIntake < 0) {
        resultDiv.innerHTML = "Your current sugar level is already at or above your target level. No carbohydrates needed.";
    } else {
        resultDiv.innerHTML = `Recommended Carbohydrate Intake: <strong>${carbohydrateIntake.toFixed(2)} grams</strong>`;
    }
});
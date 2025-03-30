function calculateWeightGain() {
    const weight = parseFloat(document.getElementById('weight').value);
    const height = parseFloat(document.getElementById('height').value) / 100; // convert cm to meters

    // Validate input
    if (isNaN(weight) || isNaN(height) || weight <= 0 || height <= 0) {
        alert("Please enter valid weight and height.");
        return;
    }

    // Calculate BMI
    const bmi = weight / (height * height);
    let recommendedGain;

    // Determine recommended weight gain based on BMI
    if (bmi < 18.5) {
        recommendedGain = "12.5 to 18 kg";
    } else if (bmi >= 18.5 && bmi < 25) {
        recommendedGain = "11.5 to 16 kg";
    } else if (bmi >= 25 && bmi < 30) {
        recommendedGain = "7 to 11.5 kg";
    } else {
        recommendedGain = "5 to 9 kg";
    }

    // Display the result
    document.getElementById('result').innerText = `Recommended weight gain: ${recommendedGain}`;
}
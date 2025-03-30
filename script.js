function calculateBmi(event) {
    event.preventDefault(); // Prevent form submission

    const weight = parseFloat(document.getElementById('weight').value);
    const heightCm = parseFloat(document.getElementById('height').value);

    if (weight > 0 && heightCm > 0) {
        const heightM = heightCm / 100; // Convert height from cm to meters
        const bmi = weight / (heightM * heightM);
        const resultElement = document.getElementById('result');
        const categoryElement = document.getElementById('bmiCategory');

        resultElement.textContent = `Your BMI is: ${bmi.toFixed(2)}`;
        categoryElement.textContent = getBmiCategory(bmi);
    } else {
        alert("Please enter valid weight and height values.");
    }
}

function getBmiCategory(bmi) {
    if (bmi < 18.5) {
        return "You are underweight. It's important to eat a balanced diet and consult a healthcare provider for advice.";
    } else if (bmi >= 18.5 && bmi < 24.9) {
        return "You have a normal weight. Keep up the good work with a balanced diet and regular exercise!";
    } else if (bmi >= 25 && bmi < 29.9) {
        return "You are overweight. Consider a balanced diet and regular physical activity to maintain a healthy weight.";
    } else {
        return "You are obese. It's advisable to consult a healthcare provider for guidance on achieving a healthier weight.";
    }
}
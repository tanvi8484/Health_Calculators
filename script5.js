function calculateBodyFat() {
    const weight = parseFloat(document.getElementById('weight').value);
    const waist = parseFloat(document.getElementById('waist').value);
    const age = parseInt(document.getElementById('age').value);
    const gender = document.getElementById('gender').value;

    if (isNaN(weight) || isNaN(waist) || isNaN(age)) {
        document.getElementById('result').innerText = "Please fill in all fields.";
        return;
    }

    let bodyFatPercentage;

    if (gender === 'male') {
        bodyFatPercentage = (1.20 * (weight / ((waist / 100) ** 2))) + (0.23 * age) - 16.2;
    } else {
        bodyFatPercentage = (1.20 * (weight / ((waist / 100) ** 2))) + (0.23 * age) - 5.4;
    }

    document.getElementById('result').innerText = `Estimated Body Fat Percentage: ${bodyFatPercentage.toFixed(2)}%`;
}
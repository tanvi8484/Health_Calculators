document.getElementById('caloricNeedForm').addEventListener('submit', function(event) {
    event.preventDefault();

    const age = parseInt(document.getElementById('age').value);
    const gender = document.getElementById('gender').value;
    const weight = parseFloat(document.getElementById('weight').value);
    const height = parseFloat(document.getElementById('height').value);
    const activityLevel = document.getElementById('activityLevel').value;

    let bmr;

    // Calculate Basal Metabolic Rate (BMR) using Mifflin-St Jeor Equation
    if (gender === 'male') {
        bmr = 10 * weight + 6.25 * height - 5 * age + 5;
    } else {
        bmr = 10 * weight + 6.25 * height - 5 * age - 161;
    }

    // Adjust BMR based on activity level
    let activityMultiplier;
    switch (activityLevel) {
        case 'sedentary':
            activityMultiplier = 1.2;
            break;
        case 'light':
            activityMultiplier = 1.375;
            break;
        case 'moderate':
            activityMultiplier = 1.55;
            break;
        case 'active':
            activityMultiplier = 1.725;
            break;
        case 'very active':
            activityMultiplier = 1.9;
            break;
        default:
            activityMultiplier = 1.2; // Default to sedentary if something goes wrong
    }

    // Calculate daily caloric needs
    const dailyCalories = Math.round(bmr * activityMultiplier);

    // Display the result
    document.getElementById('result').innerText = `Your estimated daily caloric needs are: ${dailyCalories} calories.`;
});
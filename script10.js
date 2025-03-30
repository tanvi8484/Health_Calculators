document.getElementById('calories-form').addEventListener('submit', function(e) {
    e.preventDefault();

    const weight = parseFloat(document.getElementById('weight').value);
    const duration = parseFloat(document.getElementById('duration').value);
    const exercise = document.getElementById('exercise').value;

    let caloriesPerMinute;

    switch (exercise) {
        case 'running':
            caloriesPerMinute = 10; // Approximate calories burned per minute
            break;
        case 'cycling':
            caloriesPerMinute = 8;
            break;
        case 'swimming':
            caloriesPerMinute = 7;
            break;
        case 'walking':
            caloriesPerMinute = 4;
            break;
        case 'weightlifting':
            caloriesPerMinute = 6;
            break;
        default:
            caloriesPerMinute = 0;
    }

    const totalCaloriesBurned = (caloriesPerMinute * duration) * (weight / 70); // assuming 70 kg is the base weight
    document.getElementById('result').innerText = `You burned approximately ${totalCaloriesBurned.toFixed(2)} calories.`;
});
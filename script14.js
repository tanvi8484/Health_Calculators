document.getElementById('calculate').addEventListener('click', function() {
    const age = parseInt(document.getElementById('age').value);
    const restingHeartRate = parseInt(document.getElementById('restingHeartRate').value);
    const exerciseFrequency = parseInt(document.getElementById('exerciseFrequency').value);

    if (isNaN(age) || isNaN(restingHeartRate) || isNaN(exerciseFrequency)) {
        alert("Please enter valid values.");
        return;
    }

    // Simple calculation for fitness age
    let fitnessAge = age;

    // Adjust fitness age based on resting heart rate and exercise frequency
    if (restingHeartRate < 60) {
        fitnessAge -= 2; // Better heart rate
    } else if (restingHeartRate > 80) {
        fitnessAge += 2; // Poorer heart rate
    }

    if (exerciseFrequency >= 3) {
        fitnessAge -= 2; // Regular exercise
    } else if (exerciseFrequency < 1) {
        fitnessAge += 2; // No exercise
    }

    document.getElementById('result').innerText = `Your Fitness Age is: ${fitnessAge}`;
});
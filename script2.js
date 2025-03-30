function calculateBMR() {
    const age = parseInt(document.getElementById("age").value, 10); // Convert age to an integer
    const gender = document.getElementById("gender").value; // Assuming this is a select input
    const weight = parseFloat(document.getElementById("weight").value); // Convert weight to a float
    const height = parseFloat(document.getElementById("height").value); // Convert height to a float

    let bmr;

    if (gender === "male") {
        bmr = 66 + (6.2 * weight) + (12.7 * height) - (6.8 * age);
    } else {
        bmr = 655 + (4.35 * weight) + (4.7 * height) - (4.7 * age);
    }

    document.getElementById("result").innerHTML = `Your BMR is: ${Math.round(bmr)} calories`;
}
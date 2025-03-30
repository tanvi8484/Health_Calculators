document.getElementById('calculateBtn').addEventListener('click', function() {
    const height = parseFloat(document.getElementById('height').value);
    const weight = parseFloat(document.getElementById('weight').value);
    const gender = document.getElementById('gender').value;

    if (isNaN(height) || isNaN(weight)) {
        alert("Please enter valid numbers for height and weight.");
        return;
    }

    let size = '';

    // Simple size calculation logic based on height, weight, and gender
    if (gender === 'male') {
        if (height < 170) {
            size = (weight < 70) ? 'S' : 'M';
        } else if (height < 180) {
            size = (weight < 80) ? 'M' : 'L';
        } else {
            size = (weight < 90) ? 'L' : 'XL';
        }
    } else {
        if (height < 160) {
            size = (weight < 60) ? 'S' : 'M';
        } else if (height < 170) {
            size = (weight < 70) ? 'M' : 'L';
        } else {
            size = (weight < 80) ? 'L' : 'XL';
        }
    }

    const resultDiv = document.getElementById('result');
    resultDiv.innerHTML = `Recommended Clothing Size: <strong>${size}</strong>`;
});
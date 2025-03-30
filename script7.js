function calculateRatio() {
    const waist = parseFloat(document.getElementById('waist').value);
    const height = parseFloat(document.getElementById('height').value);
    const resultDiv = document.getElementById('result');

    if (waist > 0 && height > 0) {
        const ratio = (waist / height).toFixed(2);
        resultDiv.innerText = `Your Waist-to-Height Ratio is: ${ratio}`;

        if (ratio < 0.4) {
            resultDiv.innerText += " - Low risk of health problems.";
        } else if (ratio >= 0.4 && ratio <= 0.5) {
            resultDiv.innerText += " - Moderate risk.";
        } else {
            resultDiv.innerText += " - High risk.";
        }
    } else {
        resultDiv.innerText = "Please enter valid waist and height values.";
    }
}
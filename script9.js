document.getElementById('bsa-form').addEventListener('submit', function(event) {
    event.preventDefault();

    const weight = parseFloat(document.getElementById('weight').value);
    const height = parseFloat(document.getElementById('height').value) / 100; // convert cm to meters

    // BSA formula: BSA (m²) = sqrt((height(cm) * weight(kg)) / 3600)
    const bsa = Math.sqrt((height * 100 * weight) / 3600).toFixed(2);

    document.getElementById('result').innerText = `Your Body Surface Area is ${bsa} m²`;
});
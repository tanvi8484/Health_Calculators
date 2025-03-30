const form = document.querySelector('form');
const lmpInput = document.querySelector('#lmp');
const cycleLengthInput = document.querySelector('#cycle-length');
const resultDiv = document.querySelector('#result');

form.addEventListener('submit', (e) => {
    e.preventDefault();
    
    const lmp = new Date(lmpInput.value);
    const cycleLength = parseInt(cycleLengthInput.value);
    
    // Calculate the next period date based on the cycle length
    const nextPeriodDate = new Date(lmp.getTime() + (cycleLength * 24 * 60 * 60 * 1000)); // Convert days to milliseconds
    
    resultDiv.innerText = `Your next expected period is: ${nextPeriodDate.toLocaleDateString()}`;
});
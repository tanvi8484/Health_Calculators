document.getElementById('calculateBtn').addEventListener('click', function() {
    const wakeTime = document.getElementById('wakeTime').value;
    if (!wakeTime) {
        alert('Please enter a wake-up time.');
        return;
    }

    const wakeDate = new Date();
    const [hours, minutes] = wakeTime.split(':');
    wakeDate.setHours(hours);
    wakeDate.setMinutes(minutes);
    wakeDate.setSeconds(0);

    const sleepCycleDuration = 90; // Sleep cycle duration in minutes
    const recommendedSleepTimes = [];

    for (let i = 0; i < 6; i++) {
        const sleepTime = new Date(wakeDate.getTime() - (sleepCycleDuration * (i + 1) * 60000));
        recommendedSleepTimes.push(sleepTime.toLocaleTimeString([], { hour: '2-digit', minute: '2-digit' }));
    }

    const sleepTimesList = document.getElementById('sleepTimesList');
    sleepTimesList.innerHTML = ''; // Clear previous results

    recommendedSleepTimes.forEach(time => {
        const li = document.createElement('li');
        li.textContent = time;
        sleepTimesList.appendChild(li);
    });
});
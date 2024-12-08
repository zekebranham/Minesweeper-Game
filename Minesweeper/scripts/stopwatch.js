let timerInterval;
let timerRunning = false;
let time = { hr: 0, min: 0, sec: 0, count: 0 };

function updateStopwatch() {
    time.count++;
    if (time.count === 100) {
        time.count = 0;
        time.sec++;
    }
    if (time.sec === 60) {
        time.sec = 0;
        time.min++;
    }
    if (time.min === 60) {
        time.min = 0;
        time.hr++;
    }

    // Update the display
    document.getElementById('hr').textContent = time.hr.toString().padStart(2, '0');
    document.getElementById('min').textContent = time.min.toString().padStart(2, '0');
    document.getElementById('sec').textContent = time.sec.toString().padStart(2, '0');
    document.getElementById('count').textContent = time.count.toString().padStart(2, '0');
}

export function startStopwatch() {
    if (!timerRunning) {
        timerRunning = true;
        timerInterval = setInterval(updateStopwatch, 10); // 10ms for centiseconds
    }
}

export function stopStopwatch() {
    clearInterval(timerInterval);
    timerRunning = false;
}

export function resetStopwatch() {
    clearInterval(timerInterval);
    timerRunning = false;
    time = { hr: 0, min: 0, sec: 0, count: 0 };

    // Reset the display
    document.getElementById('hr').textContent = '00';
    document.getElementById('min').textContent = '00';
    document.getElementById('sec').textContent = '00';
    document.getElementById('count').textContent = '00';
}

export function getTimerValue() {
    // Convert timer to total seconds (lower is better for ranking)
    return (time.hr * 3600) + (time.min * 60) + time.sec + (time.count / 100);
}
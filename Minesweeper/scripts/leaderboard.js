let lowestScore = null; // To hold the 25th (lowest) score for the current mode
let currentMode = 'Beginner'; // Default mode

// Fetch the 25th score for the current mode
function fetchLowestScore() {
    fetch(`./php/leaderboard.php?mode=${currentMode}`)
        .then(response => {
            if (!response.ok) {
                throw new Error(`HTTP error! Status: ${response.status}`);
            }
            return response.json();
        })
        .then(data => {
            if (Array.isArray(data) && data.length === 25) {
                lowestScore = data[data.length - 1].score;
            } else {
                lowestScore = null; // Handle cases with fewer than 25 entries
            }
        })
        .catch(error => {
            console.error('Error fetching leaderboard:', error);
            lowestScore = null; // Reset on error
        });
}

export function checkAndSubmitScore(currentScore) {
    if (lowestScore === null || currentScore < lowestScore) {
        fetch('./php/leaderboard.php', {
            method: 'POST',
            headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
            body: new URLSearchParams({
                score: currentScore, 
                mode: currentMode   
            })
        })
            .then(response => {
                if (!response.ok) {
                    throw new Error(`HTTP error! Status: ${response.status}`);
                }
                return response.json();
            })
            .then(data => {
                if (data.status === 'success') {
                    alert('High-Score submitted successfully!');
                    fetchLowestScore();
                    loadLeaderboard(currentMode); 
                } else {
                    alert(`Error submitting score: ${data.message}`);
                }
            })
            .catch(error => {
                console.error('Error submitting score:', error);
                alert('There was an issue submitting your score. Please try again later.');
            });
    }
}


export function loadLeaderboard(mode) {
    currentMode = mode;
    fetch(`./php/leaderboard.php?mode=${mode}`)
        .then(response => {
            if (!response.ok) {
                throw new Error(`HTTP error! Status: ${response.status}`);
            }
            return response.json();
        })
        .then(data => {
            const leaderboard = document.getElementById('leaderboard');
            leaderboard.innerHTML = `
                <h2>${capitalize(mode)} Leaderboard</h2>
                ${data.map((entry, index) =>
                    `<p>${index + 1}. ${entry.username} - ${formatTime(entry.score)}</p>`
                ).join('')}
            `;
        })
        .catch(error => {
            console.error('Error loading leaderboard:', error);
            const leaderboard = document.getElementById('leaderboard');
            leaderboard.innerHTML = `<p>Error loading leaderboard. Please try again later.</p>`;
        });
}

// Format time from seconds to HH:MM:SS
function formatTime(seconds) {
    const hr = Math.floor(seconds / 3600);
    const min = Math.floor((seconds % 3600) / 60);
    const sec = Math.floor(seconds % 60);
    return `${hr.toString().padStart(2, '0')}:${min.toString().padStart(2, '0')}:${sec.toString().padStart(2, '0')}`;
}

// Capitalize the first letter of a string
function capitalize(str) {
    return str.charAt(0).toUpperCase() + str.slice(1);
}

// Switch leaderboard mode
function switchMode(mode) {
    currentMode = mode;
    fetchLowestScore(); // Fetch 25th score for the new mode
    loadLeaderboard(mode); // Reload the leaderboard for the new mode
}

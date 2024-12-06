<?php
session_start();
include './php/config.php'; // Include database connection

if (!isset($_SESSION['username'])) {
    header('Location: loginPage.php'); // Redirect to login if not logged in
    exit();
}

$username = $_SESSION['username'];
$gamesPlayed = 0; // Default value

try {
    // Fetch the number of games played from the database
    $stmt = $conn->prepare("SELECT games_played FROM users WHERE username = :username");
    $stmt->bindParam(':username', $username);
    $stmt->execute();
    $result = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($result) {
        $gamesPlayed = $result['games_played'];
    }
} catch (PDOException $e) {
    // Handle errors gracefully (optional: log the error for debugging)
    error_log("Error fetching games played: " . $e->getMessage());
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Minesweeper</title>
    <link rel="stylesheet" href="styles/minesweeper.css" />
    <link rel="stylesheet" href="styles/stopwatch.css"/>
    
</head>
<body>
    <header>
        <a href="homepage.html">
            <img src="./assets/bulldogs.png" alt="Fresno State Logo" id="logo">
        </a>
        <h1>Play Minesweeper</h1>
    </header>
    <div id="start-menu">
        <h1>Select a Difficulty</h1>
        <button id="beginner" onclick="startGame('beginner')">Beginner (10 Mines: 8x8)</button>
        <button id="intermediate" onclick="startGame('intermediate')">Intermediate (40 Mines: 16x16)</button>
        <button id="expert" onclick="startGame('expert')">Expert (99 Mines: 16x30)</button>
        
    </div>
    
    <div id="games-played" style="margin-top: 10px; font-size: 16px; color: #333;">
        Games Played: <?php echo htmlspecialchars($gamesPlayed); ?>
    </div>
    <div id="game-container" style="display: none; flex-direction: column;">
        <div id="timer-container">
            <div id="time">
                <span class="digit" id="hr">00</span>
                <span class="txt">:</span>
                <span class="digit" id="min">00</span>
                <span class="txt">:</span>
                <span class="digit" id="sec">00</span>
                <span class="txt">:</span>
                <span class="digit" id="count">00</span>
            </div>
            <div id="buttons">
                <button class="btn" id="restart">😊</button>
            </div>
        </div>
        <div id="minesweeper-grid">
            <!-- Minesweeper grid cells will be dynamically populated -->
        </div>
    </div>

    
    <div id="leaderboard-container" style="display: none" >
        <h2>Leaderboard</h2>
        <div id="leaderboard">
            <!-- Leaderboard will be dynamically populated -->
        </div>
    </div>

    <!-- Hidden Debug Button -->
    <button id="auto-win" style="display: block;">Auto-Win</button>
    <script type="module">
        import { autoWin } from './scripts/game.js';

        // Add event listener for the debug button
        document.getElementById('auto-win').addEventListener('click', () => {
            autoWin();
        });

        // Example game start function call
        startGame('beginner'); // Default to beginner mode
    </script>
    <div id="leaderboard-prompt" style="display: none;">
        <p>Congratulations! You made it to the top 25!</p>
        <label for="username">Enter your username:</label>
        <input type="text" id="username" name="username">
        <button id="submit-score">Submit</button>
    </div>

     <!-- Background Audio -->
     <audio id="background-music" autoplay loop>
        <source src="./assets/SickoMode.mp3" type="audio/mpeg">
        Your browser does not support the audio element.
    </audio>
    <button id="music-toggle">Mute Music</button>
    
    
    <script type="module">
        import { setupGrid } from './scripts/game.js';
        import { resetStopwatch, stopStopwatch } from './scripts/stopwatch.js';
    
        let lastMode = 'beginner'; // Default mode to track the last-selected mode
    
        // Background music toggle logic
        const music = document.getElementById('background-music');
        const musicToggle = document.getElementById('music-toggle');

        music.volume = 0.5; // Set default volume to 50%
        musicToggle.addEventListener('click', () => {
            if (!music.muted) {
                music.muted = true;
                musicToggle.textContent = 'Unmute Music';
            } else {
                music.muted = false;
                musicToggle.textContent = 'Mute Music';
            }
        });
        
        // Function to update the Games Played count dynamically
        function updateGamesPlayed() {
            fetch('./php/updateGamesPlayed.php', {
                method: 'POST',
                headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
            })
                .then(response => {
                    if (!response.ok) {
                        throw new Error(`HTTP error! Status: ${response.status}`);
                    }
                    return response.json();
                })
                .then(data => {
                    if (data.status === 'success') {
                        const gamesPlayedContainer = document.getElementById('games-played');
                        gamesPlayedContainer.textContent = `Games Played: ${data.games_played}`;
                    } else {
                        console.error(`Error updating games played: ${data.message}`);
                    }
                })
                .catch(error => console.error('Error fetching games played:', error));
        }

        // Attach event listener for the restart button
        document.getElementById('restart').addEventListener('click', () => {
            resetGame(); // Reset the game logic
            updateGamesPlayed(); // Update the games played count dynamically
        });

        // Call this function when the page loads to initialize the games played count
        updateGamesPlayed();
        // Function to reset the game
        function resetGame() {
            // Reset the timer
            resetStopwatch();

            // Clear the Minesweeper grid
            const minesweeperGrid = document.getElementById('minesweeper-grid');
            minesweeperGrid.innerHTML = ''; // Remove all child elements (existing grid)

            // Reinitialize the game with the last selected mode
            startGame(lastMode);
        }

    
        // Function to start a new game in the selected mode
        async function startGame(mode) {
            try {
                lastMode = mode; // Update the last-selected mode
    
                // Fetch mode-specific configuration from PHP
                const response = await fetch(`/Minesweeper/Minesweeper/php/renderMode.php?mode=${mode}`);
                const { rows, cols, mines } = await response.json();
    
                // Hide start menu and display the game container
                document.getElementById('start-menu').style.display = 'none';
                const gameContainer = document.getElementById('game-container');
                const leaderboardContainer = document.getElementById('leaderboard-container')
                const timerContainer = document.getElementById('timer-container');
                const minesweeperGrid = document.getElementById('minesweeper-grid');
    
                gameContainer.style.display = 'flex'; // Ensure the game container is visible
                leaderboardContainer.style.display = 'block';
                leaderboardContainer.style.width = '400px'; // Adjust the width
                timerContainer.style.display = 'block'; // Ensure the timer is visible
                minesweeperGrid.style.display = 'grid'; // Set up the Minesweeper grid layout
    
                resetStopwatch(); // Reset the timer to its initial state
    
                // Initialize the grid with the fetched configuration
                setupGrid(rows, cols, mines, mode);
            } catch (error) {
                console.error('Error initializing game:', error);
            }
        }
    
        // Make the `startGame` function globally accessible
        window.startGame = startGame;
    </script>
    
    
    
</body>
</html>

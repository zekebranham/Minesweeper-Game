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
    <title>Leaderboard - Minesweeper</title>
    <link rel="stylesheet" href="styles/minesweeper.css">
</head>
<body>
    <header>
        <a href="homepage.html">
            <img src="./assets/bulldogs.png" alt="Fresno State Logo" id="logo">
        </a>
        <h1>Leaderboard</h1>
    </header>
    
    <main>
        <div id="games-played" style="margin-top: 10px; font-size: 16px; color: #333;">
            Games Played: <?php echo htmlspecialchars($gamesPlayed); ?>
        </div>
        <section id="leaderboards">
            <div class="leaderboard-container">
                <h2>Beginner</h2>
                <div id="beginner-leaderboard">
                    <p>Loading...</p>
                </div>
            </div>
            <div class="leaderboard-container">
                <h2>Intermediate</h2>
                <div id="intermediate-leaderboard">
                    <p>Loading...</p>
                </div>
            </div>
            <div class="leaderboard-container">
                <h2>Expert</h2>
                <div id="expert-leaderboard">
                    <p>Loading...</p>
                </div>
            </div>
        </section>    
        
        <div id="help-buttons">
            <button onclick="navigateTo('homepage.html')">Return to Homepage</button>
            <button onclick="navigateTo('loginPage.php')">Start Game</button>
        </div>
    </main>

    <footer>
        <p>&copy; 2024 Minesweeper Project | Fresno State</p>
    </footer>

    <script>
        function navigateTo(page) {
            window.location.href = page;
        }

        // Fetch Leaderboards for all modes
        async function loadAllLeaderboards() {
            const modes = ['Beginner', 'Intermediate', 'Expert'];
            for (const mode of modes) {
                const leaderboardElement = document.getElementById(`${mode.toLowerCase()}-leaderboard`);
                try {
                    const response = await fetch(`./php/leaderboard.php?mode=${mode}`);
                    const data = await response.json();
                    leaderboardElement.innerHTML = data.map((entry, index) =>
                        `<p>${index + 1}. ${entry.username} - ${formatTime(entry.score)}</p>`
                    ).join('');
                } catch (error) {
                    leaderboardElement.innerHTML = '<p>Error loading leaderboard</p>';
                    console.error(`Error loading ${mode} leaderboard:`, error);
                }
            }
        }

        function fetchGamesPlayed() {
            fetch('./php/getGamesPlayed.php') // Create a corresponding PHP file for this
                .then(response => response.json())
                .then(data => {
                    if (data.games_played !== undefined) {
                        const gamesPlayedContainer = document.getElementById('games-played');
                        gamesPlayedContainer.textContent = `Games Played: ${data.games_played}`;
                    }
                })
                .catch(error => console.error('Error fetching games played:', error));
        }

        // Call this function when the page loads
        fetchGamesPlayed();

        // Format time helper function
        function formatTime(seconds) {
            const hr = Math.floor(seconds / 3600);
            const min = Math.floor((seconds % 3600) / 60);
            const sec = Math.floor(seconds % 60);
            return `${hr.toString().padStart(2, '0')}:${min.toString().padStart(2, '0')}:${sec.toString().padStart(2, '0')}`;
        }

        // Load leaderboards on page load
        loadAllLeaderboards();
    </script>
</body>
</html>

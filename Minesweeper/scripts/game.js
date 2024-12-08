import { startStopwatch, stopStopwatch, getTimerValue, resetStopwatch } from './stopwatch.js';
import { checkAndSubmitScore, loadLeaderboard } from './leaderboard.js'; //this throws a MIME error
let gameStarted = false;
let grid = []; // Global grid to maintain state

const clickSound = new Audio('./assets/cellClick.mp3');
const flagSound = new Audio('./assets/flagPlace.mp3');
const mineSound = new Audio('./assets/loserSound.mp3');
const winSound = new Audio('./assets/winnerSound.mp3');
let minesLeft = 0; // Will be set during initialization

clickSound.volume = 0.5;
mineSound.volume = 0.8;
winSound.volume = 0.7;

function updateMinesDisplay(mines) {
    const minesCounterElement = document.getElementById('mines-count');
    if (minesCounterElement) {
        minesCounterElement.textContent = mines;
    }
}

function updateMinesLeftDisplay() {
    const minesLeftElement = document.getElementById('mines-count');
    if (minesLeftElement) {
        minesLeftElement.textContent = minesLeft;
    }
}

export function setupGrid(rows, cols, mines, mode) {
    const gameContainer = document.getElementById('minesweeper-grid');
    const minesContainer = document.getElementById('mines-container');
    gameContainer.style.display = 'grid';
    gameContainer.style.gridTemplateColumns = `repeat(${cols}, 30px)`;
    gameContainer.style.gridTemplateRows = `repeat(${rows}, 30px)`;
    minesContainer.style.display = 'block';
    
    // Reset the game state
    gameStarted = false; // Reset the timer start flag
    gameContainer.innerHTML = ''; // Clear the grid
    grid = Array.from({ length: rows }, () => Array(cols).fill(null));
    loadLeaderboard(mode);

    // Initialize minesLeft and update display
    minesLeft = mines;
    updateMinesLeftDisplay();
    updateMinesDisplay(mines);

    for (let r = 0; r < rows; r++) {
        for (let c = 0; c < cols; c++) {
            const cell = document.createElement('div');
            cell.classList.add('cell');
            cell.dataset.row = r;
            cell.dataset.col = c;

            // Attach event listeners
            cell.addEventListener('click', () => {
                if (!gameStarted) {
                    gameStarted = true; // Start the timer on the first click
                    startStopwatch();
                }
                clickSound.play(); // Play click sound
                revealCell(r, c);
            });

            cell.addEventListener('contextmenu', (event) => {
                toggleFlag(event, r, c);
                flagSound.play();
                if (checkWinCondition(grid, mines)) {
                    endGame(true);
                }
            });

            grid[r][c] = { element: cell, mine: false, revealed: false, flagged: false };
            gameContainer.appendChild(cell);
        }
    }

    placeMines(grid, rows, cols, mines);
    calculateAdjacentMines(grid, rows, cols);
}

function placeMines(grid, rows, cols, mines) {
    let minesPlaced = 0;
    while (minesPlaced < mines) {
        const r = Math.floor(Math.random() * rows);
        const c = Math.floor(Math.random() * cols);
        if (!grid[r][c].mine) {
            grid[r][c].mine = true;
            minesPlaced++;
        }
    }
}

function calculateAdjacentMines(grid, rows, cols) {
    const directions = [
        [-1, -1], [-1, 0], [-1, 1],
        [0, -1],           [0, 1],
        [1, -1], [1, 0], [1, 1],
    ];

    for (let r = 0; r < rows; r++) {
        for (let c = 0; c < cols; c++) {
            if (grid[r][c].mine) continue;
            let count = 0;
            directions.forEach(([dr, dc]) => {
                const nr = r + dr, nc = c + dc;
                if (nr >= 0 && nr < rows && nc >= 0 && nc < cols && grid[nr][nc].mine) {
                    count++;
                }
            });
            grid[r][c].adjacentMines = count;
        }
    }
}

function revealCell(row, col) {
    //timer = true;
    //stopWatch()
    console.log(`Reveal cell: (${row}, ${col})`);
    const cell = grid[row][col];
    if (cell.revealed || cell.flagged) return;

    cell.revealed = true;
    cell.element.classList.add('revealed');

    if (cell.mine) {
        mineSound.play(); // Play mine sound
        cell.element.style.backgroundImage = "url('https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQga-XyEd4uRgR6okj_78KLxPy6XcyMf9PAwQ&s')";
        revealAllMines();
        endGame(false);
    } else if (cell.adjacentMines > 0) {
        cell.element.textContent = cell.adjacentMines;
    } else {
        revealAdjacentCells(row, col);
    }
}

function toggleFlag(event, row, col) {
    event.preventDefault(); // Prevent default right-click menu

    const cell = grid[row][col];
    if (cell.revealed) return; // Do nothing if the cell is already revealed

    if (cell.flagged) {
        // Remove a flag
        cell.flagged = false;
        cell.element.classList.remove('flag');
        if (cell.mine) {
            // Increment minesLeft if the flag was on a mine
            minesLeft++;
            updateMinesLeftDisplay();
        }
    } else {
        // Add a flag
        if (!cell.flagged) {
            cell.flagged = true;
            cell.element.classList.add('flag');
            if (cell.mine) {
                // Decrement minesLeft if the flag is on a mine
                minesLeft--;
                updateMinesLeftDisplay();
            }
        }
    }
}


function checkWinCondition(grid, totalMines) {
    let flagCount = 0;

    for (let row = 0; row < grid.length; row++) {
        for (let col = 0; col < grid[row].length; col++) {
            const cell = grid[row][col];

            // Count flags and check if flags are placed on mines
            if (cell.flagged) {
                flagCount++;
                
                if (!cell.mine) {
                    return false; // Flag placed on a non-mine cell
                }
            }
        }
    }

    // Win condition: All mines are flagged, and flag count matches the total mines
    return flagCount === totalMines;
}


function endGame(isWin) {
    stopStopwatch(); // Stop the timer
    const finalScore = getTimerValue(); // Get the timer value as the score

    if (isWin) {
        winSound.play(); // Play win sound
        alert(`You won! Your time: ${finalScore.toFixed(2)} seconds`);
        checkAndSubmitScore(finalScore); // Check if the score qualifies for the leaderboard
    } else {
        alert('Game Over! Better luck next time.');
    }
}

function revealAllMines() {
    grid.forEach(row =>
        row.forEach(cell => {
            if (cell.mine) {
                cell.element.classList.add('mine');
            }
        })
    );
}

function revealAdjacentCells(row, col) {
    const directions = [
        [-1, -1], [-1, 0], [-1, 1],
        [0, -1],           [0, 1],
        [1, -1], [1, 0], [1, 1],
    ];

    directions.forEach(([dr, dc]) => {
        const nr = row + dr, nc = col + dc;
        if (nr >= 0 && nr < grid.length && nc >= 0 && nc < grid[0].length) {
            const cell = grid[nr][nc];
            if (!cell.revealed && !cell.flagged) {
                revealCell(nr, nc);
            }
        }
    });
}

// Debug method to auto-win the game
export function autoWin() {
    grid.forEach(row =>
        row.forEach(cell => {
            if (cell.mine) {
                cell.flagged = true; // Automatically flag all mines
                cell.element.classList.add('flag');
            }
        })
    );

    // Simulate the win condition
    if (checkWinCondition(grid, totalMines)) {
        endGame(true);
        alert('Debug: Auto-win triggered!');
    }
}

Minesweeper Project Setup Instructions
Files Included in the ZIP
1.	setup.php: Script to automatically create the database, tables, and sample data.
2.	Minesweeper.sql: Backup SQL file for manual database import.
Steps to Run the Project
1. Extract the Files
•	Unzip the provided project folder (Minesweeper_project.zip) into your local server's root directory:
o	For XAMPP, place it in C:/xampp/htdocs/Minesweeper_project/.
________________________________________
2. Start the Server
•	Launch XAMPP and start:
o	Apache (for PHP).
o	MySQL (for the database).
________________________________________
3. Option A: Use setup.php to Create the Database (Preferred)
1.	Open a web browser and navigate to: http://localhost/Minesweeper_project/setup.php
1.	The script will:
o	Create a database named minesweeperDB.
o	Create the required tables: beginnerleaderboard, intermediateleaderboard, expertleaderboard, and users.
o	Insert initial sample records for testing.
2.	Upon completion, you’ll see confirmation messages for database and table creation.
________________________________________
4. Option B: Manually Import Minesweeper.sql
If setup.php cannot be used:
1.	Open phpMyAdmin:
2.	Navigate to http://localhost/phpmyadmin/ 
3.	Create a new database:
o	Name it minesweeperDB.
4.	Import the backup file:
o	Select the Import tab.
o	Choose Minesweeper.sql from the extracted folder.
o	Click "Go" to import the data.
5.	Verify the import:
o	Check that the beginnerleaderboard, intermediateleaderboard, expertleaderboard, and users tables exist with sample records.
________________________________________
5. Access the Application
1.	Navigate to the ‘./php/config.php’ file to update credentials that can be used globally through the program. Then navigate to the project in your browser: http://localhost/Minesweeper_project/index.html
2.	You’ll see the Minesweeper interface with the following functionalities:
1.	Play Minesweeper: Choose difficulty levels (Beginner, Intermediate, Expert). An “auto-win” button is there and will display all mine flags for testing purposes.
2.	Leaderboard: View top scores for each difficulty level.
3.	User Accounts: Manage user accounts (register/login).
________________________________________
If you need to reset the database:
3.	Run setup.php again: This will recreate the database and reset the sample records.
4.	Alternatively, manually re-import Minesweeper.sql using phpMyAdmin.


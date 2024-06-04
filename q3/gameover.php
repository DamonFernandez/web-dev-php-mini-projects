<?php

/**
 * This file contains the code for the "Game Over" page of the rock-paper-spock game.
 * It allows the player to enter their name for the highscore and saves their score to the database.
 * If the player submits their name, the score is added to the database and the user is redirected to the highscores page.
 */

// Function to add the player's score to the database
function addScoresToDB()
{
    include "./includes/library.php";
    $pdo = connectdb();

    $preparedQuery = $pdo->prepare(
        "INSERT INTO rock_paper_spock_scores
            VALUES (?, ?)"
    );

    $name = $_POST['name'];
    $score = $_SESSION['numberWins'];
    $preparedQuery->execute([$name, $score]);
}
// Start the session
session_start();
$errors = [];
// Check if the submit button is clicked
if (isset($_POST['submit'])) {
    if (empty($_POST['name'])) {
        $errors['name'] = true;
    } else {
        addScoresToDB(); // Add the player's score to the database
        session_destroy(); // Destroy the session
        header('location: highscores.php'); // Redirect to the highscores page
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>GameOver</title>
    <link rel="stylesheet" href="./styles/main.css">
</head>

<body>
    <?php include_once "./includes/header.php" ?>
    <h1>GAME OVER!</h1>
    <p>Thank you for playing the game. You have reached the maximum number of losses.</p>

    <div class="game">
        <p>Enter your name for highscore</p>
        <form method="post">
            <input type="text" name="name" id="name" required>
            <button type="submit" name="submit" id="submit">Submit</button>
            <span class="error <?= !isset($errors['name']) ? 'hidden' : ''  ?>"> No name provided!</span>
        </form>
    </div>

</body>

</html>
<?php

/**
 * Function to play the game and determine the winner.
 *
 * @param int $userChoice The user's choice (0-4).
 * @param int $computerChoice The computer's choice (0-4).
 * @return int Returns 0 if it's a tie, 1 if the user wins, or 2 if the computer wins.
 */
function playGame($userChoice, $computerChoice)
{
    global $CHOICES; // Import the global choices array
    // Rules for the game: 
    // 0 - ROCK, 1 - SPOCK, 2 - PAPER, 3 - LIZARD, 4 - SCISSORS

    $rules = [
        0 => [count($CHOICES) - 1, count($CHOICES) - 2],
        1 => [0, count($CHOICES) - 1],
        2 => [1, 0],
        3 => [2, 1],
        4 => [3, 2]
    ];
    // Check the winner based on the rules
    if ($userChoice == $computerChoice) {
        return 0; // Tie
    } elseif (in_array($computerChoice, $rules[$userChoice])) {
        return 1; // User wins
    } else {
        return 2; // Computer wins
    }
}

/**
 * Function to update the win status and feedback message.
 *
 * @param int $winner The winner of the game (0-2).
 * @return void
 */
function updateWinStatus($winner)
{
    global $CHOICES, $numberWins, $numberLosses, $feedback, $userSelection, $computerSelection;
    // Update the feedback message based on the winner
    if ($winner == 1) { // User wins
        $numberWins++; // Increment the number of wins
        $feedback = $CHOICES[$userSelection] . " beats " . $CHOICES[$computerSelection] . " You win!"; // Set the feedback message
    } elseif ($winner == 2) { // Computer wins
        $feedback = $CHOICES[$computerSelection] . " beats " . $CHOICES[$userSelection] . " You lose!"; // Set the feedback message
        $numberLosses++; // Increment the number of losses
    } else { // Tie
        $feedback = "Both selected " . $CHOICES[$userSelection] . " It's a tie!"; // Set the feedback message
    }
    $_SESSION['feedback'] = $feedback; // Update the feedback message in the session
}

/**
 * Function to display the rules of the game.
 *
 * @return void
 */
function showRules()
{
    echo "<p>Rules <iframe width='560' height='315' src='//www.youtube.com/embed/pIpmITBocfM?si=YZQzqyGqSjz6QtYq&amp;cc_load_policy=1;controls=0?autoplay=1&mute=1' title='YouTube video player' frameborder='0' allow='accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share' referrerpolicy'strict-origin-when-cross-origin' allowfullscreen></iframe></p>";
}

/**
 * Function to update the session array with current game, number of wins, and number of losses.
 *
 * @return void
 */
function updateSessionArray()
{
    global $currentGame, $numberWins, $numberLosses;
    // Update the session array with the current game, number of wins, and number of losses
    $_SESSION['currentGame'] = $currentGame;
    $_SESSION['numberWins'] = $numberWins;
    $_SESSION['numberLosses'] = $numberLosses;
}

// GLOBAL:
// Session start and global var declaration 
session_start();
$_SESSION['currentGame'] = $_SESSION['currentGame'] ?? 0; // Initialize the current game
$_SESSION['numberWins'] = $_SESSION['numberWins'] ?? 0; // Initialize the number of wins
$_SESSION['numberLosses'] = $_SESSION['numberLosses'] ?? 0; // Initialize the number of losses

// Variables
$currentGame =  $_SESSION['currentGame'];
$numberWins = $_SESSION['numberWins'];
$numberLosses = $_SESSION['numberLosses'];
$feedback = "";
// Choices array
$CHOICES = ["ROCK", "SPOCK", "PAPER", "LIZARD", "SCISSORS"];

// Check if the user has made a choice and the number of losses is less than 10
if (isset($_POST['userChoice']) && $numberLosses < 10) {
    $userSelection = $_POST['userChoice'] ?? null; // Get the user's choice
    $computerSelection =  random_int(0, 4); // Generate a random choice for the computer
    $winner = playGame($userSelection, $computerSelection); // Play the game and determine the winner
    updateWinStatus($winner); // Update the win status and feedback message
    $currentGame++;  // Increment the current game
    updateSessionArray(); // Update the session array
} else if ($numberLosses >= 10) {  // Check if the number of losses is greater than or equal to 10
    header("Location: gameover.php"); // Redirect to the game over page
    exit();
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>RPSLS:GAME</title>
    <link rel="stylesheet" href="./styles/main.css">
</head>

<body>
    <?php include_once "./includes/header.php" ?>
    <h1>The Rock Paper Scissor Lizard Spock Game</h1>
    <?php if ($currentGame == 0) : ?>
        <?= showRules(); ?>
    <?php endif; ?>
    <div class="game">
        <h3>Game Number: <?= $currentGame + 1 ?></h3>
        <div class="labels">
            <span class="green">Number of wins: <?= $numberWins ?> </span><span class="red"> Number of losses: <?= $numberLosses ?></span>
        </div>
        <form method="post">
            <span>Play your turn: </span>
            <button type="submit" name="userChoice" id="0" value="0"> <?= $CHOICES[0] ?> </button>
            <button type="submit" name="userChoice" id="1" value="1"> <?= $CHOICES[1] ?> </button>
            <button type="submit" name="userChoice" id="2" value="2"> <?= $CHOICES[2] ?> </button>
            <button type="submit" name="userChoice" id="3" value="3"> <?= $CHOICES[3] ?> </button>
            <button type="submit" name="userChoice" id="4" value="4"> <?= $CHOICES[4] ?> </button>
        </form>

        <?php if (isset($_POST['userChoice'])) : ?> <!-- Check if the user has made a choice -->
            <div class="feedback">
                <p>Results of game: <?= $currentGame ?></p> <!-- Display the results of the game -->
                <p>You Selected: <span class="selection"><?= $CHOICES[$userSelection] ?></span></p>
                <p>The Computer Selected: <span class="selection"><?= $CHOICES[$computerSelection] ?></span></p>
                <p><?= $feedback ?></p>
            </div>

        <?php endif; ?>
    </div>
</body>

</html>
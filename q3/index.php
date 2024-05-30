<?php
$CHOICES = ["ROCK", "SPOCK", "PAPER", "LIZARD", "SCISSORS"];
function playGame($u, $c)
{
    global $CHOICES;
    $rules = [
        0 => [count($CHOICES) - 1, count($CHOICES) - 2],
        1 => [0, count($CHOICES) - 1],
        2 => [1, 0],
        3 => [2, 1],
        4 => [3, 2]
    ];

    if ($u == $c) {
        return 0;
    } elseif (in_array($c, $rules[$u])) {
        return 1;
    } else {
        return 2;
    }
}
session_start();
$_SESSION['currentGame'] = $_SESSION['currentGame'] ?? 0;
$_SESSION['numberWins'] = $_SESSION['numberWins'] ?? 0;
$_SESSION['numberLosses'] = $_SESSION['numberLosses'] ?? 0;

$currentGame =  $_SESSION['currentGame'];
$numberWins = $_SESSION['numberWins'];
$numberLosses = $_SESSION['numberLosses'];
$feedback = "";
if (isset($_POST['userChoice']) && $numberLosses < 10) {
    $userSelection = $_POST['userChoice'] ?? null;
    $computerSelection =  random_int(0, 4);
    $winner = playGame($userSelection, $computerSelection);
    if ($winner == 1) {
        $numberWins++;
        $feedback = $CHOICES[$userSelection] . " beats " . $CHOICES[$computerSelection] . " You win!";
    } elseif ($winner == 2) {
        $feedback = $CHOICES[$computerSelection] . " beats " . $CHOICES[$userSelection] . " You lose!";
        $numberLosses++;
    } else {
        $feedback = "Both selected " . $CHOICES[$userSelection] . " It's a tie!";
    }
    $currentGame++;
    $_SESSION['currentGame'] = $currentGame;
    $_SESSION['numberWins'] = $numberWins;
    $_SESSION['numberLosses'] = $numberLosses;
    $_SESSION['feedback'] = $feedback;
} else if ($numberLosses >= 10) {
    header("Location: gameover.php");
}


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>RPSLS:GAME</title>
</head>

<body>
    <?php include_once "./includes/header.php" ?>
    <h1>The Rock Paper Scissor Lizard Spock Game</h1>
    <h3>Game Number: <?= $currentGame + 1 ?></h3>
    <span>Number of wins: <?= $numberWins ?> </span>
    <span>Number of losses: <?= $numberLosses ?></span>
    <span>Play your turn: </span>
    <form method="post">
        <button type="submit" name="userChoice" id="0" value="0"> <?= $CHOICES[0] ?> </button>
        <button type="submit" name="userChoice" id="1" value="1"> <?= $CHOICES[1] ?> </button>
        <button type="submit" name="userChoice" id="2" value="2"> <?= $CHOICES[2] ?> </button>
        <button type="submit" name="userChoice" id="3" value="3"> <?= $CHOICES[3] ?> </button>
        <button type="submit" name="userChoice" id="4" value="4"> <?= $CHOICES[4] ?> </button>
    </form>

    <?php if (isset($_POST['userChoice'])) : ?>
        <p>You Selected: <?= $CHOICES[$userSelection] ?></p>
        <p>The Computer Selected: <?= $CHOICES[$computerSelection] ?></p>
        <p><?= $feedback ?></p>
    <?php endif; ?>
</body>

</html>
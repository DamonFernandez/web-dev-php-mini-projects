<?php

$CHOICES = ["ROCK", "SPOCK", "PAPER", "LIZARD", "SCISSORS"];
$POSSIBLE_OUTCOMES = [
    "0" => "It's a tie",
    "1" => "You win",
    "2" => "You lose"
];
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
        return 0; // It's a tie
    } elseif (in_array($c, $rules[$u])) {
        return 1; // User wins
    } else {
        return 2; // Computer wins
    }
}

$currentGame = 0;
$numberWins = 0;
$numberLosses = 0;
$feedback = "";
if (isset($_POST['userChoice'])) {
    $userSelection = $_POST['userChoice'] ?? null;
    $computerSelection =  random_int(0, 4);
    $winner = playGame($userSelection, $computerSelection);
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
    <h1>The Rock Paper Scissor Lizard Splock Game</h1>
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
        <p><?= $POSSIBLE_OUTCOMES[$winner] ?></p>
    <?php endif; ?>
</body>

</html>
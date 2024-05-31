<?php

function renderScores($setOfScores)
{
    foreach ($setOfScores as $currRow) {
        echo "<li> {$currRow['Name']} - Score: {$currRow['Score']} </li>";
    }
}

include "./includes/library.php";
$pdo = connectdb();
$query = $pdo->query(
    "SELECT * FROM rock_paper_spock_scores ORDER BY score DESC LIMIT 20 ;"
);

$queryResults = $query->fetchAll();
var_dump($queryResults);


?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>HighScores</title>
</head>

<body>
    <?php include_once "./includes/header.php" ?>
    <h1>High Scores</h1>
    <ol>
        <?= renderScores($queryResults) ?>
    </ol>

</body>

</html>
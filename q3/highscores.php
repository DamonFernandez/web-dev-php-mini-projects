<?php

/**
 * Function to render a list of scores as HTML list items
 */
function renderScores($setOfScores)
{
    // Iterate over each row in the set of scores
    foreach ($setOfScores as $currRow) {
        // Output the current row as an HTML list item
        echo "<li> {$currRow['Name']} - Score: {$currRow['Score']} </li>";
    }
}

// Include the library file that contains the database connection function
include "./includes/library.php";

// Connect to the database
$pdo = connectdb();

// Prepare and execute the query to fetch the top 20 scores from the database
$query = $pdo->query(
    "SELECT * FROM rock_paper_spock_scores ORDER BY score DESC LIMIT 20 ;"
);

// Fetch all the results from the query
$queryResults = $query->fetchAll();

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>HighScores</title>
    <link rel="stylesheet" href="./styles/main.css">
</head>

<body>
    <!-- Include the header file -->
    <?php include_once "./includes/header.php" ?>

    <h1>High Scores</h1>
    <ol>
        <!-- Render the scores as an ordered list -->
        <?= renderScores($queryResults) ?>
    </ol>
</body>

</html>
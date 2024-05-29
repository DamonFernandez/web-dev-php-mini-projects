<?php

$score = 0;
session_start();
if (isset($_SESSION['correct'])) {
    $correct = $_SESSION['correct'];
} else {
    header('Location: index.php');
}
if (isset($_GET['submit'])) {
    session_destroy();
    header('Location: index.php');
    exit();
}
foreach ($correct as $ans) {
    $score += $ans ? 1 : 0;
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Results</title>
</head>

<body>
    <h1>Results: </h1>
    <p>Score: <?= $score ?></p>
    <p>Correct Answers: <?= $score ?></p>
    <p>Incorrect Answers: <?= count($correct) - $score ?></p>
    <p>Percentage: <?= ($score / count($correct)) * 100 ?>%</p>
    <form method="get">
        <button type="submit" name="submit">Try Again</button>
    </form>
</body>

</html>
<?php

$score = 0;
session_start();
require_once("./questions.php");
if (isset($_SESSION['feedback'])) {
    $feedback = $_SESSION['feedback'];
} else {
    header('Location: index.php');
}
if (isset($_GET['submit'])) {
    session_destroy();
    header('Location: index.php');
    exit();
}
foreach ($feedback as $question => &$answer) {
    if ($answer['answer'] === $answer['choice']) {
        $score++;
    }
}
$feedbacks = [
    "Looks like you need to brush up on your anime knowledge! Try watching 'Attack on Titan', 'Jujutsu Kaisen', and 'Code Geass' again to catch all the details!",
    "Not bad, but there's room for improvement! Maybe a rewatch of your favorite scenes from 'Attack on Titan', 'Jujutsu Kaisen', and 'Code Geass' will help!",
    "You're getting there! Your anime knowledge is solid, but a little more focus on the details in 'Attack on Titan', 'Jujutsu Kaisen', and 'Code Geass' will make you an expert!",
    "Great job! You really know your stuff when it comes to 'Attack on Titan', 'Jujutsu Kaisen', and 'Code Geass'. Just a few more details to master!",
    "Excellent work! You're a true anime fan with impressive knowledge of 'Attack on Titan', 'Jujutsu Kaisen', and 'Code Geass'. Keep it up!",
    "Perfect score! You're an anime master! Your knowledge of 'Attack on Titan', 'Jujutsu Kaisen', and 'Code Geass' is unbeatable!"
];

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Results</title>
    <link rel="stylesheet" href="./styles/main.css">
</head>

<body>
    <h1>Results: </h1>
    <?php foreach ($feedback as $question => &$answer) : ?>
        <p class="Question"> Question : <?= $question + 1 . " $questions[$question]" ?> </p>
        <span class=" <?= ($answer['answer'] === $answer['choice']) ? 'correct' : 'incorrect' ?>"> Your Answer: <?= $answer['choice'] ?> </span>
        <span class="correct"> Correct Answer: <?= $answer['answer'] ?></span>
    <?php endforeach; ?>
    <p>Score: <?= $score ?></p>
    <p>Correct Answers: <?= $score ?></p>
    <p>Incorrect Answers: <?= count($feedback) - $score ?></p>
    <p>Percentage: <?= ($score / count($feedback)) * 100 ?>%</p>
    <p>Feedback: <?= $feedbacks[$score] ?></p>
    <form method="get">
        <button type="submit" name="submit">Try Again ?</button>
    </form>
</body>

</html>
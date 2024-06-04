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
    "0 correct: Seems like your anime knowledge has been Titan-ed down. Time for a binge-watch!",
    "1 correct: Not bad! But you're still a genin in the anime world. Keep training!",
    "2 correct: You're getting there! Just a few more episodes and you'll be a pro.",
    "3 correct: Great job! Your anime knowledge is leveling up!",
    "4 correct: Excellent work! You're one step away from being an anime sensei!",
    "5 correct: Perfect score! You've gone Plus Ultra in anime mastery!"
];

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Results</title>
    <link rel="stylesheet" href="./styles/results.css">
</head>

<body>
    <h1>Results </h1>
    <?php foreach ($feedback as $question => &$answer) : ?>
            <p class="question"> Question  <?= $question + 1 . ":" . " $questions[$question]" ?> </p>
            <span class=" <?= ($answer['answer'] === $answer['choice']) ? 'correct' : 'incorrect' ?>"> Your Answer: <?= $answer['choice'] ?> </span>
            <span class="correct"> Correct Answer: <?= $answer['answer'] ?></span>
    <?php endforeach; ?>
    <p>Score: <?= $score ?></p>
    <p>Correct Answers: <?= $score ?></p>
    <p>Incorrect Answers: <?= count($feedback) - $score ?></p>
    <p>Percentage Correct: <?= ($score / count($feedback)) * 100 ?>%</p>
    <p>Feedback: <?= $feedbacks[$score] ?></p>
    <form method="get">
        <button type="submit" name="submit">Try Again ?</button>
    </form>
</body>

</html>
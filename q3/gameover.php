<?php
function addScoresToDB(){
    include "./includes/library.php";
    $pdo = connectdb(); 

    $preparedQuery = $pdo -> prepare(
    "INSERT INTO rock_paper_spock_scores 
     VALUES (?, ?)");


    $name = $_POST['name'];
    $score = $_SESSION['numberWins'];
    $preparedQuery -> execute([$name, $score]);
}

session_start();

if (isset($_POST['submit'])) {
    addScoresToDB();
    header('location: highscores.php');
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>GameOver</title>
</head>

<body>
    <?php include_once "./includes/header.php" ?>
    <h1>GAME OVER!</h1>
    <p>Thank you for playing the game. You have reached the maximum number of losses.</p>
    <p>Enter your name for highscore</p>
    <form method="post">
        <input type="text" name="name" id="name" required>
        <button type="submit" name="submit" id="submit">Submit</button>
    </form>

</body>

</html>
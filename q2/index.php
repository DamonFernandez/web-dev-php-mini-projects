<?php

session_start();
if (isset($_POST['restart'])) {
    session_destroy();
    header('Refresh:0');
}



if (!(isset($_SESSION["correct"]) || isset($_SESSION["current_question"]))) {
    $_SESSION["correct"] = array();
    $_SESSION["current_question"] = 0;
}

$current_question = $_SESSION["current_question"];
$correct = $_SESSION["correct"];
$choice = $_POST["choice"] ?? "";
require_once "./questions.php";

if (isset($_POST["submit"]) && $current_question < count($questions)) {
    if ($choice == $questions[$current_question]->getCorrectAnswer()) {
        $correct[$current_question] = true;
    } else {
        $correct[$current_question] = false;
    }
    $current_question++;

    $_SESSION['correct'] = $correct;
    $_SESSION['current_question'] = $current_question;
}

if ($current_question >= count($questions)) {
    header("Location: results.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <h1>Assignment One - Question Two</h1>
    <p class="question"> Question <?= $current_question + 1  . " $questions[$current_question]" ?> </p>
    <form method="post">
        <input type="radio" name="choice" value="0" id="0">
        <label for="choiceOne"><?= $questions[$current_question]->getChoiceOne() ?></label>
        <input type="radio" name="choice" value="1" id="1">
        <label for="choiceTwo"><?= $questions[$current_question]->getChoiceTwo() ?></label>
        <input type="radio" name="choice" value="2" id="2">
        <label for="choiceThree"><?= $questions[$current_question]->getChoiceThree() ?></label>
        <input type="radio" name="choice" value="3" id="3">
        <label for="choiceFour"><?= $questions[$current_question]->getChoiceFour() ?></label>
        <button type="submit" name="submit">Submit</button>
        <button name="restart"> Restart </button>
    </form>

</body>

</html>
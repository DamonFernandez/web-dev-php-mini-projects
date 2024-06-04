<?php

session_start();

require_once "./questions.php";

if (isset($_POST['restart'])) {
    session_destroy();
    header('Refresh:0');
    exit();
}
if (!(isset($_SESSION["feedback"]) || isset($_SESSION["current_question"]))) {
    $_SESSION["feedback"] = array();
    $_SESSION["current_question"] = 0;
}

$current_question = $_SESSION["current_question"];
$feedback = $_SESSION["feedback"];
$choice = $_POST["choice"] ?? null;
$errors = [];
if (isset($_POST["submit"])) {
    if (is_null($choice)) {
        $errors['choice'] = true;
    }
    if (empty($errors)) {
        if ($current_question < count($questions)) {
            $feedback[$current_question]['answer'] = $questions[$current_question]->getAnswerStr();
            $feedback[$current_question]['choice'] = $questions[$current_question]->getChoice($choice);
            $current_question++;

            $_SESSION['feedback'] = $feedback;
            $_SESSION['current_question'] = $current_question;
        }

        if ($current_question >= count($questions)) {
            header("Location: results.php");
            exit();
        }
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="./styles/index.css">
</head>

<body>
    <main>
        <h1>Anime Quiz </h1>
        <span class="question"> Anime: <?= $current_question + 1 . "/" . count($questions)  . " $questions[$current_question]" ?> </span>
        <form method="post">
            <div class="formColumnWrapper">
                <fieldset>
                    <input type="radio" name="choice" value="0" id="0">
                    <label for="0"><?= $questions[$current_question]->getChoice(0) ?></label>
                    </fieldset>
            
                <fieldset>
                    <input type="radio" name="choice" value="1" id="1">
                    <label for="1"><?= $questions[$current_question]->getChoice(1) ?></label>
                </fieldset>
                <button type="submit" name="submit">Submit</button>
            </div>
            <div class="formColumnWrapper">
                
                <fieldset>
            <input type="radio" name="choice" value="2" id="2">
            <label for="2"><?= $questions[$current_question]->getChoice(2) ?></label>
                </fieldset>
                
                <fieldset>
            <input type="radio" name="choice" value="3" id="3">
            <label for="3"><?= $questions[$current_question]->getChoice(3) ?></label>
                </fieldset>
                    <button name="restart">Restart </button>
            </div>
<span class="red <?= !isset($errors['choice']) ? 'hidden' : ''  ?>"> you didnt try guessing!</span>

        </form>
    </main>

</body>

</html>
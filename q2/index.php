<?php

/**
 * This file is the main page of the Anime Quiz application. It handles the display of questions, user input, and session management.
 * The user is presented with a question and four choices. The user must select one of the choices and click the submit button to proceed to the next question. The user can restart the quiz at any time by clicking the restart button.
 */

// Include the Question class

$questionOne = new Question( // Create a new Question object for the first question
    "Which anime features a boy named Tanjiro Kamado who becomes a demon slayer after his family is slaughtered and his sister is turned into a demon?",
    "Demon Slayer",
    "Attack on Titan",
    "Blue Exorcist",
    "Naruto",
    0
);
$questionTwo = new Question(
    "In which anime does a young alchemist named Edward Elric use alchemy in a quest to find the Philosopher's Stone to restore his and his brother's bodies?",
    "Fullmetal Alchemist: Brotherhood",
    "My Hero Academia",
    "Sword Art Online",
    "Black Clover",
    0
);
$questionThree = new Question(
    "Which anime follows a group of pirates led by Monkey D. Luffy in their search for the ultimate treasure, the One Piece?",
    "One Piece",
    "Fairy Tail",
    "Bleach",
    "Hunter x Hunter",
    0
);
$questionFour = new Question(
    "In which anime does a boy named Gon Freecss become a Hunter to find his missing father and uncover the secrets of the Hunter Association?",
    "Naruto",
    "One Piece",
    "Hunter x Hunter",
    "Dragon Ball Z",
    2
);
$questionFive = new Question(
    "Which anime is set in a world where 80% of the population has superpowers, and follows a boy named Izuku Midoriya who dreams of becoming the greatest hero?",
    "My Hero Academia",
    "One Punch Man",
    "Blue Exorcist",
    "Attack on Titan",
    0
);

$questions = [$questionOne, $questionTwo, $questionThree, $questionFour, $questionFive]; // Create an array of Question objects

// Start the session
session_start();

// Include the questions file
require_once "./questions.php";

// Restart the quiz if the restart button is clicked
if (isset($_POST['restart'])) {
    session_destroy();
    header('Refresh:0');
    exit();
}

// Initialize session variables if they don't exist
if (!(isset($_SESSION["feedback"]) || isset($_SESSION["current_question"]))) {
    $_SESSION["feedback"] = array();
    $_SESSION["current_question"] = 0;
}

// Get the current question and feedback from session variables
$current_question = $_SESSION["current_question"];
$feedback = $_SESSION["feedback"];

// Get the user's choice from the form submission
$choice = $_POST["choice"] ?? null;

// Initialize an array to store errors
$errors = [];

// Process the form submission if the submit button is clicked
if (isset($_POST["submit"])) {
    // Validate the user's choice
    if (is_null($choice)) {
        $errors['choice'] = true;
    }

    // If there are no errors, update the feedback and current question
    if (empty($errors)) {
        if ($current_question < count($questions)) {
            $feedback[$current_question]['answer'] = $questions[$current_question]->getAnswerStr(); // Get the correct answer
            $feedback[$current_question]['choice'] = $questions[$current_question]->getChoice($choice); // Get the user's choice
            $current_question++; // Move to the next question

            $_SESSION['feedback'] = $feedback; // Update the feedback in the session
            $_SESSION['current_question'] = $current_question; // Update the current question in the session
        }

        // If all questions have been answered, redirect to the results page
        if ($current_question >= count($questions)) {
            header("Location: results.php"); // Redirect to the results page
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
        <h1>Anime Quiz</h1>
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
                <button name="restart">Restart</button>
            </div>

        </form>
    </main>

    <span class="error <?= !isset($errors['choice']) ? 'hidden' : ''  ?>">You didn't try guessing!</span>


</body>

</html>
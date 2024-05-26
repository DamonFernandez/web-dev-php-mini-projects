<?php 

$choiceOne = "choice one";
$choiceTwo= "choice two";
$choiceThree = "choice three";
$choiceFour = "choice four";


function checkForSubmissionButton(){

}


class Question {
    private $choiceOne;
    private $choiceTwo;
    private $choiceThree;
    private $choiceFour;
    private $correctAnswer;
    private $questionText;

    // Constructor
    function __construct($questionText, $choiceOne, $choiceTwo, $choiceThree, $choiceFour, $correctAnswer) {
        $this->questionText = $questionText;
        $this->choiceOne = $choiceOne;
        $this->choiceTwo = $choiceTwo;
        $this->choiceThree = $choiceThree;
        $this->choiceFour = $choiceFour;
        $this->correctAnswer = $correctAnswer;
    }

    // Getters
    public function getQuestionText() {
        return $this->questionText;
    }

    public function getChoiceOne() {
        return $this->choiceOne;
    }

    public function getChoiceTwo() {
        return $this->choiceTwo;
    }

    public function getChoiceThree() {
        return $this->choiceThree;
    }

    public function getChoiceFour() {
        return $this->choiceFour;
    }

    public function getCorrectAnswer() {
        return $this->correctAnswer;
    }

    // Setters
    public function setQuestionText($questionText) {
        $this->questionText = $questionText;
    }

    public function setChoiceOne($choiceOne) {
        $this->choiceOne = $choiceOne;
    }

    public function setChoiceTwo($choiceTwo) {
        $this->choiceTwo = $choiceTwo;
    }

    public function setChoiceThree($choiceThree) {
        $this->choiceThree = $choiceThree;
    }

    public function setChoiceFour($choiceFour) {
        $this->choiceFour = $choiceFour;
    }

    public function setCorrectAnswer($correctAnswer) {
        $this->correctAnswer = $correctAnswer;
    }
}

$question = new Question(
    "What is the capital of France?",
    "Berlin",
    "Madrid",
    "Paris",
    "Rome",
    "Paris"
);
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

    <form action="">
    <button name="choiceOne" type="submit"><?= $choiceOne?></button>
    <button name="choiceTwo" type="submit"><?= $choiceTwo?></button>
    <button name="choiceThree" type="submit"><?= $choiceThree?></button>
    <button name="choiceFour" type="submit"><?= $choiceFour?></button>
    </form>

</body>
</html>
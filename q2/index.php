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


$questionOne = new Question(
    "What is the capital of France?",
    "Berlin",
    "Madrid",
    "Paris",
    "Rome",
    "Paris"
);
$questionTwo = new Question(
    "HTML: For any decorative image that we use that is not meaningful what should we do in terms of the alt attribute for the element?",
    "set the alt attribute to the number 404",
    "We should use the alt attributes set to an empty string",
    "We should not use any alt attribute",
    "Set the alt attribute to \"descriptive\"",
    "We should use the alt attributes set to an empty string"
);
$questionThree = new Question(
    "What part of a computer handles logical operations?",
    "ALU",
    "FPU",
    "CPU",
    "The brain",
    "ALU"
);
$questionFour = new Question(
    "What is the capital of India?",
    "Berlin",
    "Madrid",
    "New Delhi",
    "Pakistan",
    "New Delhi"
);
$questionFive = new Question(
    "JS: What is an IIFE function?",
    "An function that we pass into another function",
    "An private function",
    "an function that returns nothing",
    "A function that is executed immediately after being defined",
    "A function that is executed immediately after being defined"
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
<?php
class Question
{
    private $choiceOne;
    private $choiceTwo;
    private $choiceThree;
    private $choiceFour;
    private $choices;
    private $correctAnswer;
    private $questionText;
    public $questions = array();

    // Constructor
    function __construct($questionText, $choiceOne, $choiceTwo, $choiceThree, $choiceFour, $correctAnswer)
    {
        $this->questionText = $questionText;
        $this->choices = [$choiceOne, $choiceTwo, $choiceThree, $choiceFour];
        $this->correctAnswer = $correctAnswer;
    }


    // Getters
    public function getQuestionText()
    {
        return $this->questionText;
    }

    public function getChoiceOne()
    {
        return $this->choices[0];
    }

    public function getChoiceTwo()
    {
        return $this->choices[1];
    }

    public function getChoiceThree()
    {
        return $this->choices[2];
    }

    public function getChoiceFour()
    {
        return $this->choices[3];
    }

    public function getCorrectAnswer()
    {
        return $this->correctAnswer;
    }
    public function __toString(): string
    {
        return $this->questionText;
    }
}


$questionOne = new Question(
    "What is the capital of France?",
    "Berlin",
    "Madrid",
    "Paris",
    "Rome",
    2
);
$questionTwo = new Question(
    "HTML: For any decorative image that we use that is not meaningful what should we do in terms of the alt attribute for the element?",
    "set the alt attribute to the number 404",
    "We should use the alt attributes set to an empty string",
    "We should not use any alt attribute",
    "Set the alt attribute to \"descriptive\"",
    1
);
$questionThree = new Question(
    "What part of a computer handles logical operations?",
    "ALU",
    "FPU",
    "CPU",
    "The brain",
    0
);
$questionFour = new Question(
    "What is the capital of India?",
    "Berlin",
    "Madrid",
    "New Delhi",
    "Pakistan",
    2
);
$questionFive = new Question(
    "JS: What is an IIFE function?",
    "An function that we pass into another function",
    "An private function",
    "an function that returns nothing",
    "A function that is executed immediately after being defined",
    3
);

$questions = [$questionOne, $questionTwo, $questionThree, $questionFour, $questionFive];

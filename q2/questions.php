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
    "In 'Attack on Titan', what is the name of the protagonist who vows to eliminate all Titans after witnessing the destruction of his hometown?",
    "Eren Yeager",
    "Mikasa Ackerman",
    "Levi Ackerman",
    "Armin Arlert",
    0
);
$questionTwo = new Question(
    "Who is the main character of 'Jujutsu Kaisen', a high school student with exceptional combat abilities and a strong sense of justice?",
    "Gojo Satoru",
    "Suguru Geto",
    "Nanami Kento",
    "Yuji Itadori",
    3
);
$questionThree = new Question(
    "What is the special power possessed by Lelouch Lamperouge, the main character of 'Code Geass'?",
    "Super strength",
    "Telekinesis",
    "Mind control",
    "Time manipulation",
    2
);
$questionFour = new Question(
    "Which military organization in 'Attack on Titan' is dedicated to fighting Titans and protecting humanity?",
    "Garrison Regiment",
    "Military Police Brigade",
    "Survey Corps",
    "Marleyan Military",
    2
);
$questionFive = new Question(
    "In 'Jujutsu Kaisen', what is the name of the cursed object that Yuji Itadori swallows, resulting in him becoming the vessel of a powerful cursed spirit?",
    "Sukuna's Finger",
    "Inverted Spear of Heaven",
    "Cursed Womb: Death Paintings",
    "Cursed Corpse",
    0
);


$questions = [$questionOne, $questionTwo, $questionThree, $questionFour, $questionFive];

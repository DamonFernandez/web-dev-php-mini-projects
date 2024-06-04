<?php

/**
 * Represents a question in a quiz.
 */
class Question
{

    private $choices;
    private $correctAnswer;
    private $questionText;
    public $questions = array();

    /**
     * Constructor for the Question class.
     *
     * @param string $questionText The text of the question.
     * @param string $choiceOne The first choice for the question.
     * @param string $choiceTwo The second choice for the question.
     * @param string $choiceThree The third choice for the question.
     * @param string $choiceFour The fourth choice for the question.
     * @param int $correctAnswer The index of the correct answer choice.
     */
    function __construct($questionText, $choiceOne, $choiceTwo, $choiceThree, $choiceFour, $correctAnswer)
    {
        $this->questionText = $questionText;
        $this->choices = [$choiceOne, $choiceTwo, $choiceThree, $choiceFour];
        $this->correctAnswer = $correctAnswer;
    }


    /**
     * Get the text of the question.
     *
     * @return string The text of the question.
     */
    public function getQuestionText()
    {
        return $this->questionText;
    }

    /**
     * Get a specific choice for the question.
     *
     * @param int $choice The index of the choice to retrieve.
     * @return string The choice at the specified index.
     */
    public function getChoice($choice)
    {
        return $this->choices[$choice];
    }

    /**
     * Get the index of the correct answer choice.
     *
     * @return int The index of the correct answer choice.
     */
    public function getCorrectAnswer()
    {
        return $this->correctAnswer;
    }

    /**
     * Get the correct answer choice as a string.
     *
     * @return string The correct answer choice.
     */
    public function getAnswerStr()
    {
        return $this->choices[$this->correctAnswer];
    }

    /**
     * Convert the Question object to a string.
     *
     * @return string The text of the question.
     */
    public function __toString(): string
    {
        return $this->questionText;
    }
}

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
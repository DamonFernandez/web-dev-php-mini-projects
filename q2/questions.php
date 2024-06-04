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

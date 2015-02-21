<?

class Quiz
{
    /* @var Question */
    private $question;

    /* @var UserQuestion */
    private $userQuestion;

    public function __construct($question, $userQuestion)
    {
        $this->question = $question;
        $this->userQuestion = $userQuestion;
    }

    public function getQuestion()
    {
        return $this->question;
    }

    public function getUserQuestion()
    {
        return $this->userQuestion;
    }
}
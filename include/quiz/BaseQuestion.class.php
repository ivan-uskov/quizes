<?

abstract class BaseQuestion
{
    protected $id;
    protected $title;
    protected $body;
    protected $correct;

    /* @var Answer[] */
    protected $answers;

    public function __construct($row)
    {
        $this->id = $row['question_id'];
        $this->body = $row['q_text'];
        $this->title = $row['title'];
        $this->correct = $row['answer_id'];
    }

    public function getId()
    {
        return $this->id;
    }

    public function getTitle()
    {
        return $this->title;
    }

    public function getDescription()
    {
        return $this->body;
    }

    public function getAnswers()
    {
        return $this->answers;
    }

    public function getCorrectId()
    {
        return $this->correct;
    }

    public function setAnswers($answers)
    {
        $this->answers = $answers;
    }
}
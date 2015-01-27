<?

abstract class BaseQuestion
{
    protected $id;
    protected $title;
    protected $body;

    protected $answers;

    public function __construct($row)
    {
        $this->id = $row['question_id'];
        $this->body = $row['q_text'];
        $this->title = $row['title'];
    }

    public function getId()
    {
        return $this->id;
    }

    public function setAnswers($answers)
    {
        $this->answers = $answers;
    }
}
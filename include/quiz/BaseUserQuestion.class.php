<?

abstract class BaseUserQuestion
{
    protected $id;
    protected $userId;
    protected $questionId;
    protected $answerId;

    public function __construct($row)
    {
        $this->id =         $row['user_question_id'];
        $this->userId =     $row['user_id'];
        $this->answerId =   $row['answer_id'];
        $this->questionId = $row['question_id'];
    }

    public function getId()
    {
        return $this->id;
    }

    public function getUserId()
    {
        return $this->userId;
    }

    public function getQuestionId()
    {
        return $this->questionId;
    }

    public function getAnswerId()
    {
        return $this->answerId;
    }
}
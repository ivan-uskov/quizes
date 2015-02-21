<?

abstract class BaseAnswer
{
    protected $id;
    protected $body;

    public function __construct($row)
    {
        $this->id = $row['answer_id'];
        $this->body = $row['a_text'];
    }

    public function getId()
    {
        return $this->id;
    }

    public function getDescription()
    {
        return $this->body;
    }
}
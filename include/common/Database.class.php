<?

class Database
{
    const LOG_FILE_NAME = 'database_errors.log';

    private $pdoConn;

    public function __construct()
    {
        try
        {
            $this->pdoConn = new PDO(Config::DB_DSN, Config::DB_USER, Config::DB_PASS);
        }
        catch (PDOException $e)
        {
            Logger::logException(self::LOG_FILE_NAME, $e);
            throw new RuntimeException();
        }
    }

    public function getQuestions($con = '')
    {
        $questions = array();
        $sql = 'SELECT * FROM question ' . $con;
        foreach ($this->pdoConn->query($sql) as $row)
        {
            if (!empty($row))
            {
                $question = new Question($row);
                $answers = $this->getAnswers($question->getId());
                $question->setAnswers($answers);
                $questions[] = $question;
            }
        }
        return $questions;
    }

    public function  getQuiz($userQuestionId)
    {
        $sql = 'SELECT * FROM user_question WHERE user_question_id = ' . $userQuestionId;

        /* @var $userQuestion UserQuestion */
        $userQuestion = null;
        foreach ($this->pdoConn->query($sql) as $userQuestion) break;
        if (empty($userQuestion))
        {
            throw new Exception('UserQuestion not exists!');
        }
        $userQuestion = new UserQuestion($userQuestion);
        $question = $this->getQuestions('WHERE question_id = ' . $userQuestion->getQuestionId())[0];
        if (empty($question))
        {
            throw new Exception('Question not exists!');
        }

        return new Quiz($question, $userQuestion);
    }

    private function getAnswers($questionId)
    {
        $answers = array();
        $sql = 'SELECT * FROM answer WHERE question_id = ' . $this->escape($questionId);
        foreach ($this->pdoConn->query($sql) as $row)
        {
            if (!empty($row))
            {
                $answer = new Answer($row);
                $answers[] = $answer;
            }
        }
        return $answers ;
    }

    public function initUser($loginKey)
    {
        $user = null;
        $sql = 'SELECT * FROM user WHERE login_key = ' . $this->escape($loginKey);

        /** @var $row array */
        foreach ($this->pdoConn->query($sql) as $row);
        {
            if (!empty($row))
            {
                $user = new User($row);
            }
        }
        return $user;
    }

    public function getUser($email, $password)
    {
        $user = null;
        $sql = 'SELECT * FROM user WHERE email = ' . $this->escape($email) . ' && password = ' . $this->escape(md5($password));

        /** @var $row array */
        foreach ($this->pdoConn->query($sql) as $row);
        {
            if (!empty($row))
            {
                $user = new User($row);
            }
        }

        return $user;
    }

    public function getStudentQuizes()
    {

    }

    private function escape($str)
    {
        return $this->pdoConn->quote($str);
    }
}
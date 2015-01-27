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
            Logger::logException(Config::SITE_ROOT, $e);
            throw new RuntimeException();
        }
    }

    public function getQuestions()
    {
        $questions = array();
        $sql = 'SELECT * FROM question' . '';
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

    private function escape($str)
    {
        return $this->pdoConn->quote($str);
    }
}
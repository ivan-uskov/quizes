<?

class Context
{
    /* @var Database */
    private $database;

    /* @var User */
    private $user;

    public static function getInstance()
    {
        static $instance = null;
        if (null === $instance) {
            $instance = new static();
        }

        return $instance;
    }

    public function initDatabaseConnection()
    {
        $this->database = new Database();
    }

    public function initSession()
    {
        session_id(Session::SESSION_ID);
        session_start();
    }

    public function getQuestions()
    {
        return $this->database->getQuestions();
    }

    public function getUser($email, $password)
    {
        return !empty($email) && !empty($password) ? $this->database->getUser($email, $password) : null;
    }

    public function authorizeUser(User $user)
    {
        $this->user = $user;

        Session::setUser($user->getLoginKey());
    }

    public function getLoggedUser()
    {
        $loginKey = Session::getUserData();

        if (!$this->user && $loginKey)
        {
            $this->user = $this->database->initUser($loginKey);
        }

        return $this->user;
    }

    public function logOut()
    {
        $this->user = null;
        Session::setUser(null);
    }

    /**
     * Protected constructor to prevent creating a new instance of the
     * *Singleton* via the `new` operator from outside of this class.
     */
    protected function __construct()
    {
    }

    /**
     * Private clone method to prevent cloning of the instance of the
     * *Singleton* instance.
     *
     * @return void
     */
    private function __clone()
    {
    }
}
<?

class ProfilePage extends Page
{
    /* @var $user User  */
    private $user;

    public function __construct()
    {
        $this->protect();
        parent::__construct();
    }

    protected function init()
    {
        $this->setTitle("Profile!");
        $this->addStyle('profile.css');
        $this->setTplVars(array());

        $this->initTemplate();
        $this->initContent();
    }

    protected function initAjax()
    {
    }

    private function initTemplate()
    {
        $this->user = Context::getInstance()->getLoggedUser();

        if ($this->user->isStudent())
        {
            $this->setTemplate("student-profile.tpl");
        }
        else
        {
            $this->setTemplate("teacher-profile.tpl");
        }
    }

    private function initContent()
    {
        $contentType = $this->request->getGetParameter('content', '');

        if ($contentType == 'info' || empty($contentType))
        {
            $this->addTplVar('content', TemplateUtils::getView('partitial/user-info.tpl', $this->getInfoContentVars()));
        }
        else if ($contentType == 'quizes')
        {
            $this->initQuizesContent();
        }
        else if ($contentType == 'students')
        {
            $this->initStudentsContent();
        }
    }

    private function initStudentsContent()
    {
        $str = '';



        $this->addTplVar('content', $str);
    }

    private function initQuizesContent()
    {

    }

    private function getInfoContentVars()
    {
        return array
        (
            'firstName' => StringUtils::camelCase($this->user->getFirstName()),
            'lastName' => StringUtils::camelCase($this->user->getLastName()),
            'status' => UserStatus::toString($this->user->getStatus()),
            'email' => $this->user->getEmail(),
            'phone' => $this->user->getPhone(),
            'country' => $this->user->getCountry(),
            'addDate' => $this->user->getAddDate()

        );
    }
}
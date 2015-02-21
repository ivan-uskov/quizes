<?

abstract class Page
{
    /**
     * Page title
     * @var string
     */
    private $title;

    /**
     * Css file names
     * @var array
     */
    private $styles = array();

    /**
     * Js file names
     * @var array
     */
    private $scripts = array();

    /**
     * Template variables
     * @var array
     */
    private $tplVars = array();

    /**
     * Page template name
     * @var string
     */
    private $template;

    /**
     * @var Request
     */
    protected $request;

    protected $ajaxResponse;

    /**
     * @var bool Is page only for logged users
     */
    private $isProtected = false;

    public function __construct()
    {
        $this->request = new Request();

        if ($this->isProtected && !Context::getInstance()->getLoggedUser())
        {
            UrlUtils::forwardSingIn();
        }
    }

    private function renderStatic()
    {
        $this->init();

        $user = Context::getInstance()->getLoggedUser();

        $pageVars = array
        (
            TemplateUtils::USER_VAR_NAME  => $user ? StringUtils::camelCase($user->getName()) : TemplateUtils::ANONYMOUS_USER_TEXT,
            TemplateUtils::TITLE_VAR_NAME => $this->title,
            TemplateUtils::CSS_VAR_NAME   => TemplateUtils::getCssString($this->styles),
            TemplateUtils::JS_VAR_NAME    => TemplateUtils::getJsString($this->scripts)
        );

        echo TemplateUtils::buildPage($this->template, $this->tplVars, $pageVars);
    }

    private function renderAjax()
    {
        $this->initAjax();

        echo json_encode($this->ajaxResponse);
    }

    public function render()
    {
        if ($this->request->isAjax())
        {
            $this->renderAjax();
        }
        else
        {
            $this->renderStatic();
        }
    }

    protected function protect()
    {
        $this->isProtected = true;
    }

    protected function setTitle($title)
    {
        $this->title = $title;
    }

    protected function setStyles(array $styles)
    {
        $this->styles = $styles;
    }

    protected function setScripts(array $scripts)
    {
        $this->scripts = $scripts;
    }

    protected function addScript($script)
    {
        $this->scripts[] = $script;
    }

    protected function addStyle($style)
    {
        $this->styles[] = $style;
    }

    protected function setTplVars(array $tplVars)
    {
        $this->tplVars = $tplVars;
    }

    protected function addTplVar($key, $val)
    {
        $this->tplVars[$key] = $val;
    }

    protected function setTemplate($template)
    {
        $this->template = $template;
    }

    abstract protected function init();
    abstract protected function initAjax();
}
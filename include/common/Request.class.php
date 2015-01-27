<?

class Request
{
    private $method;

    public function __construct()
    {
        $this->method = $_SERVER['REQUEST_METHOD'];
    }

    public function isAjax()
    {
        return $this->method == RequestMethod::POST;
    }

    public function getParameter($param, $default = null)
    {
        $value = $this->getGetParameter($param, $default);
        return ($value === $default) ? $this->getPostParameter($param, $default) : $value;
    }

    public function getGetParameter($param, $default = null)
    {
        return isset($_GET[$param]) && !empty($_GET[$param]) ? $_GET[$param] : $default;
    }

    public function getPostParameter($param, $default = null)
    {
        return isset($_POST[$param]) && !empty($_POST[$param]) ? $_POST[$param] : $default;
    }
}
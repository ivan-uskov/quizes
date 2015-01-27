<?

class IndexPage extends Page
{
    protected function init()
    {
        $this->setTitle("Quizes!");
        $this->setTemplate("index.tpl");

        $this->setTplVars(array());
        $this->addStyle('index.css');
    }

    protected function initAjax()
    {

    }
}
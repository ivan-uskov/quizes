<?

class InfoPage extends Page
{
    protected function init()
    {
        $pageTitle = $this->request->getGetParameter('pageTitle');
        $vars = array
        (

            'title' => $this->request->getGetParameter('title'),
            'description' => $this->request->getGetParameter('description')
        );

        $this->setTitle($pageTitle);
        $this->setTemplate("info.tpl");

        $this->setTplVars($vars);
        $this->addStyle('info.css');
    }

    protected function initAjax()
    {

    }
}
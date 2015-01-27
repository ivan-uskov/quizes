<?

class TemplateUtils
{
    const TITLE_VAR_NAME = 'title';
    const JS_VAR_NAME    = 'scripts';
    const CSS_VAR_NAME   = 'styles';
    const USER_VAR_NAME = 'userEmail';
    const ANONYMOUS_USER_TEXT = 'Anonymous';

    public static function getView($templateName, $vars = array())
    {
        $tpl = null;
        $templatePath = Config::SITE_ROOT . Config::TPL_PATH . $templateName;
        if(file_exists($templatePath))
        {
            $tpl = file_get_contents($templatePath);
            $tpl = preg_replace('/[{][$]([a-zA-Z]{0,30})[}]/e', 'isset($vars["$1"]) ? $vars["$1"] : ""', $tpl);
        }
        return $tpl;
    }

    public static function getCssString($styles)
    {
        $stylesHtml = '';
        foreach ($styles as $styleName)
        {
            $stylePath = Config::STYLES_DIR . $styleName;
            $stylesHtml .= '<link rel="stylesheet" type="text/css" href="' . $stylePath . '" media="all" />';
        }
        return $stylesHtml;
    }

    public static function getJsString($scripts)
    {
        $scriptsHtml = '';
        foreach ($scripts as $scriptName)
        {
            $scriptPath = Config::JS_DIR . $scriptName;
            $scriptsHtml .= '<script type="text/javascript" src="' . $scriptPath . '"></script>';
        }
        return $scriptsHtml;
    }

    public static function buildPage($tplName, $tplVars, $pageVars)
    {
        $page = self::getView(Config::TOP_PATH, $pageVars);

        if (!is_null($tplName))
        {
            $page .= self::getView($tplName, $tplVars);
        }

        $page .= self::getView(Config::BOT_PATH, $pageVars);

        return $page;
    }
}
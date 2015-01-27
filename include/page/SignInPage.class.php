<?php

class SignInPage extends Page
{
    const SIGN_OUT_PARAM = 'sign_out';

    protected function init()
    {
        $this->processSignOut();

        $this->setTitle("Sign in!");
        $this->setTemplate("sign-in.tpl");

        $this->setTplVars(array());
        $this->addScript('page/SignInPage.class.js');
        $this->addStyle('sign-in.css');
    }

    protected function initAjax()
    {
        $success = false;
        $email = $this->request->getPostParameter('email');
        $password = $this->request->getPostParameter('password');

        $user = Context::getInstance()->getUser($email, $password);
        if ($user)
        {
            Context::getInstance()->authorizeUser($user);
            $success = true;
        }

        $this->ajaxResponse = array('success' => $success);
    }

    private function processSignOut()
    {
        $isSignOut = $this->request->getGetParameter(self::SIGN_OUT_PARAM);

        if (!is_null($isSignOut))
        {
            Context::getInstance()->logOut();
        }
    }
}
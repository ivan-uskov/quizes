<?php

    require_once( 'Config.class.php' );
    require_once( 'common/Logger.class.php' );
    require_once( 'common/Context.class.php' );
    require_once( 'common/Request.class.php' );
    require_once( 'common/Database.class.php' );
    require_once( 'common/RequestMethod.class.php' );
    require_once( 'common/TemplateUtils.class.php' );
    require_once( 'common/UrlUtils.class.php' );
    require_once( 'common/Session.class.php' );
    require_once( 'common/Secure.class.php' );

    require_once( 'quiz/BaseQuestion.class.php' );
    require_once( 'quiz/BaseAnswer.class.php' );
    require_once( 'quiz/Question.class.php' );
    require_once( 'quiz/Answer.class.php' );

    require_once( 'page/Page.class.php' );
    require_once( 'page/IndexPage.class.php' );
    require_once( 'page/QuizPage.class.php' );
    require_once( 'page/SignInPage.class.php' );

    require_once( 'user/UserStatus.class.php' );
    require_once( 'user/BaseUser.class.php' );
    require_once( 'user/User.class.php' );

    Context::getInstance()->initDatabaseConnection();
    Context::getInstance()->initSession();
    Context::getInstance()->getLoggedUser();

<?

class QuizPage extends Page
{
    public function __construct()
    {
        $this->protect();
        parent::__construct();
    }

    protected function init()
    {
        $user = Context::getInstance()->getLoggedUser();
        $this->setTemplate('quiz.tpl');
        $this->setTitle('Quiz resolve!');
        $this->addStyle('quiz.css');

        if (!$user->isStudent())
        {
            UrlUtils::redirect(UrlUtils::INDEX);
        }

        $id = $this->request->getGetParameter('user-question-id', 0);

        /* @var $quiz Quiz */
        $question = null;
        try
        {
            $quiz = Context::getInstance()->getQuiz($id);
        }
        catch (Exception $e)
        {
            UrlUtils::redirect(UrlUtils::INDEX);
        }

        $vars = array
        (
            'qtitle' => $quiz->getQuestion()->getTitle(),
            'description' => $quiz->getQuestion()->getDescription(),
            'userQuestionId' => $quiz->getUserQuestion()->getId(),
            'answerOneId' => $quiz->getQuestion()->getAnswers()[0]->getId(),
            'answerOne' => $quiz->getQuestion()->getAnswers()[0]->getDescription(),
            'answerTwoId' => $quiz->getQuestion()->getAnswers()[1]->getId(),
            'answerTwo' => $quiz->getQuestion()->getAnswers()[1]->getDescription(),
            'answerThreeId' => $quiz->getQuestion()->getAnswers()[2]->getId(),
            'answerThree' => $quiz->getQuestion()->getAnswers()[2]->getDescription(),
            'answerFourId' => $quiz->getQuestion()->getAnswers()[3]->getId(),
            'answerFour' => $quiz->getQuestion()->getAnswers()[3]->getDescription()
        );

        $this->setTplVars($vars);
    }


    protected function initAjax()
    {
        $quiz = null;
        try
        {
            $quiz = Context::getInstance()->getQuiz($this->request->getPostParameter('userQuestionId', 0));
        }
        catch (Exception $e)
        {
            UrlUtils::redirect(UrlUtils::INDEX);
        }

        $answerId = $this->request->getPostParameter('answer');
        if (is_null($answerId))
        {
            UrlUtils::redirect(UrlUtils::INDEX);
        }

        if ($answerId == $quiz->getQuestion()->getCorrectId())
        {
            $title = 'Your correctly solve the quiz :))!';
            $description = 'Congratulations!';
        }
        else
        {
            $title = 'Your make a mistake ((:!';
            $description = 'Try Again!';
        }

        UrlUtils::redirect('info.php?title=' . $title . '&description=' . $description . '&pageTitle=' . 'Quiz result!');
    }
}
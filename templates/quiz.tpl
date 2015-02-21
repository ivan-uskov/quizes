<div class="form_container">
  <h4>
    {$qtitle}
  </h4>
  <p>
    {$description}
  </p>
  <form action="#" method="POST">
    <input type="hidden" name="userQuestionId" value="{$userQuestionId}" id="userQuestionId" />
    <input id="answer1" name="answer" value="{$answerOneId}" type="radio" />
    <label for="answer1" >{$answerOne}</label><br />
    <input id="answer2" name="answer" value="{$answerTwoId}" type="radio" />
    <label for="answer2" >{$answerTwo}</label><br />
    <input id="answer3" name="answer" value="{$answerThreeId}" type="radio" />
    <label for="answer3" >{$answerThree}</label><br />
    <input id="answer4" name="answer" value="{$answerFourId}" type="radio" />
    <label for="answer4" >{$answerFour}</label><br />
    <input type="submit" value="Завершить!" name="submit" class="submit" />
  </form>
</div>
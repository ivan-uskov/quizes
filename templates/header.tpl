<!DOCTYPE html>
<html>
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>{$title}</title>
    <link rel="stylesheet" type="text/css" href="/css/style.css" media="all" />
    {$styles}
  </head>
  <body>
    <div class="main">
      <div class="top_menu">
        <div class="nav_panel">
          <a href="/">Main</a>
          <a href="/sign-in.php" title="Sign In for quizes">Sign In</a>
          <a href="/quiz.php?random=1" title="Take a quiz">Random Quiz</a>
        </div>
        <div class="user_box">
          <span>{$userEmail}</span>
          <span> | </span>
          <a href="/sign-in.php?sign_out=true">Sign Out</a>
        </div>
      </div>

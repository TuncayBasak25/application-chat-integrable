<?php

class CommandController
{
  public static function execute($inputs)
  {
    if ($inputs['message'] === '<disconnect>')
    {
      (new MessageModel)->new_message('server', $_SESSION['username'] . " is disconnected");

      unset($_SESSION['username']);

      ob_start();
      FormView::loginForm();
      $response['input_board'] = ob_get_contents();
      ob_clean();

      return $response;
    }
    else if ($inputs['message'] === '<reset>')
    {
      (new UserModel)->reset();
      (new MessageModel)->reset();
    }
  }
}

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
    else if (substr($inputs['message'], 0, 3) === '<p:')
    {
      $message = substr($inputs['message'], 3);
      $pos = strpos($message, '>');

      $user = substr($message, 0, $pos);

      if (empty((new UserModel)->get_user($user)) === TRUE)
      {
        $message = "This user doesn't exist.";
        (new MessageModel)->new_message('server', $message, $_SESSION['username']);
      }
      else
      {
        $message = substr($message, $pos + 1);

        (new MessageModel)->new_message($_SESSION['username'], $message, $user);
      }
    }
  }
}

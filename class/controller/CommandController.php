<?php

class CommandController
{
  public static function execute($inputs)
  {
    $user = (new UserModel)->actual_user();

    if ($inputs['message'] === '<disconnect>')
    {
      (new MessageModel)->new_message('server', $user['username'] . " is disconnected");

      (new UserModel)->disconnect_user();

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

      $destination = substr($message, 0, $pos);

      if (empty((new UserModel)->get_user($destination)) === TRUE)
      {
        $message = "This user doesn't exist.";
        (new MessageModel)->new_message('server', $message, $user['username']);
      }
      else
      {
        $message = substr($message, $pos + 1);

        (new MessageModel)->new_message($user['username'], $message, $destination);
      }
    }
  }
}

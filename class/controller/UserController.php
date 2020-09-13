<?php

class UserController
{
  public static function login($inputs)
  {
    if (isset($inputs['username']) === FALSE || empty($inputs['username']) === TRUE)
    {
      ob_start();
      $message = ['id' => 'none', 'source' => 'server', 'message' => "Username empty or missing."];
      MessageView::single_message($message);
      $response['message_board']['add'] = ob_get_contents();
      ob_clean();
      return $response;
    }

    $userModel = new UserModel();

    $test = $userModel->get_user($inputs['username']);

    if ($inputs['username'] === 'server' && empty($test) === FALSE && time() - $test['last_update'] < 900)
    {
      $test = FALSE;
    }
    else
    {
      $userModel->delete_user($inputs['username']);

      $test = TRUE;
    }

    if ($test === FALSE)
    {
      ob_start();
      $message = ['id' => 'none', 'source' => 'server', 'message' => "This username is not available."];
      MessageView::single_message($message);
      $response['message_board']['add'] = ob_get_contents();
      ob_clean();
      return $response;
    }

    $userModel->add_user($inputs['username']);

    $_SESSION['username'] = $inputs['username'];

    (new MessageModel())->new_message('server', $_SESSION['username'] . " is now connected.");

    ob_start();
    FormView::messageForm();
    $response['input_board'] = ob_get_contents();
    ob_clean();

    return $response;
  }
}

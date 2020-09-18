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

    $user = $userModel->actual_user();

    if ($inputs['username'] === 'server' && empty($user) === FALSE && time() - $user['last_update'] < 900)
    {
      $user = FALSE;
    }
    else
    {
      $userModel->disconnect_user();
      $userModel->delete_user($inputs['username']);

      $user = TRUE;
    }

    if ($user === FALSE)
    {
      ob_start();
      $message = ['id' => 'none', 'source' => 'server', 'message' => "This username is not available."];
      MessageView::single_message($message);
      $response['message_board']['add'] = ob_get_contents();
      ob_clean();
      return $response;
    }

    $userModel->add_user($inputs['username']);

    $userModel->connect_user($inputs['username']);

    (new MessageModel())->new_message('server', $inputs['username'] . " is now connected.");

    ob_start();
    FormView::messageForm();
    $response['input_board'] = ob_get_contents();
    ob_clean();

    return $response;
  }
}

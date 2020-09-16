<?php

class RequestController
{
  public static function execute($request, $inputs = false)
  {

    if ($request === 'update')
    {
      $user = (new UserModel)->actual_user();

      if (empty($user['username']) === TRUE)
      {
        if ($inputs['login_loaded'] !== "true")
        {
          ob_start();
          FormView::loginForm();
          $response['input_board'] = ob_get_contents();
          ob_clean();

          ob_start();
          $message = ['id' => 'none', 'source' => 'server', 'message' => "You are disconnected."];
          MessageView::single_message($message, $user);
          $response['message_board']['add'] = ob_get_contents();
          ob_clean();
        }

        $response['disconnected'] = "true";
      }
      else
      {
        $response = MessageController::update($inputs);

        $response['disconnected'] = "";
      }
    }
    else if ($request === 'message_input_form')
    {
      if (substr($inputs['message'], 0, 1) === '<')
      {
        $response = CommandController::execute($inputs);
      }
      else
      {
        $response = MessageController::send($inputs);
      }
    }
    else if ($request === 'login_input_form')
    {
      $response = UserController::login($inputs);
    }
    else if ($request === 'load')
    {
      if (isset($_SESSION['username']) === TRUE)
      {
        $user = (new UserModel)->get_user($_SESSION['username']);
        if (empty($user) === FALSE && $user['session_id'] === session_id())
        {
          (new MessageModel())->new_message('server', $_SESSION['username'] . " is reconnected.");
        }
      }
      ob_start();
      WindowView::display();
      $response['chat_container'] = ob_get_contents();
      ob_clean();
    }
    else if ($request === 'reset_server')
    {
      $userModel = new UserModel();
      $userModel->reset();

      $messageModel = new MessageModel();
      $messageModel->reset();

      session_destroy();

      $response = FormView::loginForm();
    }
    else {
      $response = ErrorView::undefinedRequest($request);
    }



    if (empty($response) === FALSE)
    {
      echo json_encode($response);
    }
  }
}

<?php

class RequestController
{
  public static function execute($request, $inputs = false)
  {

    if ($request === 'update')
    {
      $response = MessageController::update($inputs);
    }
    else if ($request === 'message_input_form')
    {
      $response = MessageController::send($inputs);
    }
    else if ($request === 'login_input_form')
    {
      $response = UserController::login($inputs);
    }
    else if ($request === 'load')
    {
      $response = ConnectView::display();
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

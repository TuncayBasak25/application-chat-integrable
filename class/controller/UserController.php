<?php

class UserController
{
  public static function login($inputs)
  {
    if (isset($inputs['username']) === FALSE || empty($inputs['username']) === TRUE) {
      $response = ErrorView::emptyLoginError();
      return $response;
    }

    $userModel = new UserModel();

    $test = $userModel->get_user($inputs['username']);

    if (empty($test) === FALSE) {
      $response = ErrorView::userExistError();
      return $response;
    }

    $userModel->add_user($inputs['username']);

    $_SESSION['username'] = $inputs['username'];

    $messageModel = new MessageModel();

    $messageModel->new_message('server', $_SESSION['username'] . " is now connected.");

    $response = FormView::messageForm();

    return $response;
  }
}

<?php

class UserController
{
  public static function login($inputs)
  {
    if (isset($inputs['username']) === FALSE || empty($inputs['username']) === TRUE)
    {
      ob_start();
      ErrorView::emptyLoginError();
      $response['login_input'] = ob_get_contents();
      ob_clean();
      return $response;
    }

    $userModel = new UserModel();

    $test = $userModel->get_user($inputs['username']);

    if (empty($test) === FALSE) {
      ob_start();
      ErrorView::userExistError();
      $response['login_input'] = ob_get_contents();
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

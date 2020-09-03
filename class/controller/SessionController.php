<?php

class SessionController
{
  public static function login($inputs)
  {
    if (isset($inputs['user_id']) === TRUE) $user_id = $inputs['user_id'];
    if (isset($inputs['password']) === TRUE) $password = $inputs['password'];

    $response['html'] = '';
    $response['error'] = '';

    if (isset($user_id) === FALSE || empty($user_id) === TRUE) {
      $response['error'] .= "User id is missing or empty.";
      return $response;
    }
    if (isset($password) === FALSE || empty($password) === TRUE) {
      $response['error'] .= "password is missing or empty.";
      return $response;
    }

    $_SESSION['user_id'] = $user_id;

    $response['html'] = LoggedHeaderView::display();

    return $response;
  }

  public static function logout()
  {
    $response['html'] = '';
    $response['error'] = '';

    session_destroy();

    $response['html'] = HeadBarView::display();

    return $response;
  }
}

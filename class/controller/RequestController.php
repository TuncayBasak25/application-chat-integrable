<?php

class RequestController
{
  public static function execute($request, $inputs = false)
  {
    $response['html'] = '';
    $response['error'] = '';

    if ($request === 'first_load') {
      HomePageView::display();
    }
    else if ($request === 'login') {
      $response = SessionController::login($inputs);
    }
    else if ($request === 'logout') {
      $response = SessionController::logout();
    }


    // Une fois la requete executé
    if ($request !== 'first_load') {
      RequestController::responds($response);
    }
  }

  public static function responds($response)
  {
    $response = json_encode($response);
    echo $response;
  }
}

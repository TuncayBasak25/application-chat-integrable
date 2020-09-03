<?php

class ErrorView
{
  public static function emptyLoginError($output_buffering = true)
  {
    if ($output_buffering === TRUE) ob_start();

    ?>
    Username is missing or Empty.
    <?php

    if ($output_buffering === FALSE) return FALSE;

    $response['error'] = ob_get_contents();
    ob_clean();
    return $response;
  }

  public static function emptyMessageError($output_buffering = true)
  {
    if ($output_buffering === TRUE) ob_start();

    ?>
    Message is missing or Empty.
    <?php

    if ($output_buffering === FALSE) return FALSE;

    $response['error'] = ob_get_contents();
    ob_clean();
    return $response;
  }

  public static function userExistError($output_buffering = true)
  {
    if ($output_buffering === TRUE) ob_start();

    ?>
    This username is already taken.
    <?php

    if ($output_buffering === FALSE) return FALSE;

    $response['error'] = ob_get_contents();
    ob_clean();
    return $response;
  }

  public static function undefinedRequest($request ,$output_buffering = true)
  {
    if ($output_buffering === TRUE) ob_start();

    ?>
    undefined request <?= $request ?>
    <?php

    if ($output_buffering === FALSE) return FALSE;

    $response['error'] = ob_get_contents();
    ob_clean();
    return $response;
  }
}

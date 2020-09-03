<?php

class ConnectView
{
  public static function display($output_buffering = true)
  {
    if ($output_buffering === TRUE) ob_start();

    ?>
    <div id="message_board">

    </div>
    <div id="input_board">
      <?php
      if (isset($_SESSION['username']) === TRUE)
      {
        FormView::messageForm(false);
      }
      else {
        FormView::loginForm(false);
      }
      ?>
    </div>
    <?php

    if ($output_buffering === FALSE) return FALSE;

    $response['html'] = ob_get_contents();
    ob_clean();
    return $response;
  }
}

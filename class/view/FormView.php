<?php

class FormView
{
  public static function loginForm($output_buffering = true)
  {
    if ($output_buffering === TRUE) ob_start();

    ?>
    <form id="login_input_form" onsubmit="formSubmit(this, loginResponse)" method="post"></form>
    <input id="login_input" form="login_input_form" type="text" name="username" placeholder="Username to connect" required='required' pattern=".{4,10}">
    <?php

    if ($output_buffering === FALSE) return FALSE;

    $response['html'] = ob_get_contents();
    ob_clean();
    return $response;
  }

  public static function messageForm($output_buffering = true)
  {
    if ($output_buffering === TRUE) ob_start();

    ?>
    <form id="message_input_form" onsubmit="formSubmit(this, messageResponse)" method="post"></form>
    <input id="message_input" form="message_input_form" type="text" name="message" placeholder="Max 300 charachter." required='required' pattern=".{1,300}">
    <?php
    if ($_SESSION['username'] === 'Tuncay' || $_SESSION['username'] === 'Sergio')
    {
      ?>
      <button type="reset" name="button" onclick="ajax(request('reset_server'), resetResponse)">Reset Server</button>
      <?php
    }

    if ($output_buffering === FALSE) return FALSE;

    $response['html'] = ob_get_contents();
    ob_clean();
    return $response;
  }
}

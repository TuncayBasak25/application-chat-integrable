<?php

class FormView
{
  public static function loginForm()
  {
    ?>
    <form id="login_input_form" onsubmit="formSubmit(this)" method="post"></form>
    <input id="login_input" form="login_input_form" type="text" name="username" placeholder="Username to connect" required='required' pattern=".{4,10}">
    <?php
  }

  public static function messageForm()
  {
    ?>
    <form id="message_input_form" onsubmit="formSubmit(this); setEmptyInputValue('message_input')" method="post"></form>
    <input id="message_input" form="message_input_form" type="text" name="message" placeholder="Max 300 charachter." required='required' pattern=".{1,300}" autocomplete="off">
    <?php
    if ($_SESSION['username'] === 'Tuncay' || $_SESSION['username'] === 'Sergio')
    {
      ?>
      <button type="reset" name="button" onclick="ajax(request('reset_server'), resetResponse)">Reset Server</button>
      <?php
    }
  }
}

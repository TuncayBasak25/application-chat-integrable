<?php

class HeadBarView
{
  public static function display()
  {
    ob_start();

    ?>

    <form id="login_form" onsubmit="formSubmit(this, loginResponse)" method="post"></form>
    <input form="login_form" type="text" name="user_id" placeholder="username or email">
    <input form="login_form" type="password" name="password" placeholder="password">
    <input form="login_form" type="submit" name="request" value="login">
    <p id="login_error" class="d-inline text-white"></p>

    <?php

    $html = ob_get_contents();

    ob_clean();

    return $html;
  }
}

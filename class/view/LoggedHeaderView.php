<?php

class LoggedHeaderView
{
  public static function display()
  {
    ob_start();
    ?>
    <div class="test">
      <span>You are logged as <?= $_SESSION['user_id'] ?>.</span>
      <form id="logout_form" class="d-none" onsubmit="formSubmit(this, logoutResponse)" method="post"></form>
      <input form="logout_form" type="submit" name="request" value="logout">
    </div>
    <?php

    $html = ob_get_contents();

    ob_clean();

    return $html;
  }
}

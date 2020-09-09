<?php

class WindowView
{
  public static function display()
  {
    ?>
    <div id="message_board">

    </div>
    <div id="input_board">
      <?php
      if (isset($_SESSION['username']) === TRUE)
      {
        FormView::messageForm();
      }
      else
      {
        FormView::loginForm();
      }
      ?>
    </div>
    <?php
  }
}

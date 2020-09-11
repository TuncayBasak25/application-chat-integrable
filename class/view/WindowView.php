<?php

class WindowView
{
  public static function display()
  {
    ?>
    <div id="chat_window" onmousedown="mouseDownChatWindow(this)" onmouseup="mouseUpChatWindow(this)" onmouseout="mouseQuitChatWindow(this)" onmouseover="mouseEnterChatWindow(this)" onmousemove="mouseMoveChatWindow(this)">

      <div id="chat_window_top" class="d-flex justify-content-between align-items-center bg-primary">
        <span class="ml-2" style="white-space: nowrap; overflow: hidden">Application Chat</span>
        <button id="chat_window_reduce_button mr-1" style="height: 20px" type="button" name="button" onclick="reduceChatWindow(this)">-</button>
        <button id="chat_window_develop_button mr-1" style="height: 20px; display: none" type="button" name="button" onclick="developChatWindow(this)">+</button>
      </div>

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
    </div>
    <?php
  }

}

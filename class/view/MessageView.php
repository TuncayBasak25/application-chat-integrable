<?php

class MessageView
{
  public static function display($message_list)
  {
    foreach ($message_list as $index => $message) {
      MessageView::single_message($message);
    }
  }

  public static function single_message($message)
  {
    ?>
    <div id="<?= $message['id'] ?>" class="w-100">
      <p class="d-flex" style="margin: 0; margin-top: 5px; margin-bottom: 5px; line-height: 16px">
        <?php
        if ($message['source'] === 'server')
        {
          MessageView::server_message($message);
        }
        else if (isset($_SESSION['username']) === TRUE && $message['source'] !== $_SESSION['username'])
        {
          MessageView::user_message($message);
        }
        else
        {
          MessageView::my_message($message);
        }
        ?>
      </p>
    </div>
    <?php
  }

  public static function user_message($message)
  {
    ?>
    <span class="message_source pl-1" style="color: blue"><?= $message['source'] ?>: </span>
    <span class="message_text ml-1" style="color: black;"><?= $message['message'] ?></span>
    <?php
  }

  public static function my_message($message)
  {
    ?>
    <span class="message_source pl-1" style="color: limegreen"><?= $message['source'] ?>: </span>
    <span class="message_text ml-1" style="color: navy;"><?= $message['message'] ?></span>
    <?php
  }

  public static function server_message($message)
  {
    ?>
    <span class="message_source pl-1" style="color: purple"><?= $message['source'] ?>: </span>
    <span class="message_text ml-1" style="color: green;"><?= $message['message'] ?></span>
    <?php
  }
}

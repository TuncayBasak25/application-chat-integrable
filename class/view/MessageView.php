<?php

class MessageView
{
  public static function display($message_list)
  {
    foreach ($message_list as $index => $message)
    {
      if (($message['destination'] === 'global') || (isset($_SESSION['username']) === TRUE) && ($message['destination'] === $_SESSION['username'] || $message['source'] === $_SESSION['username']))
      {
        MessageView::single_message($message);
      }
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
        else if ($message['destination'] === 'global')
        {
          if (isset($_SESSION['username']) === TRUE && $message['source'] === $_SESSION['username'])
          {
            MessageView::my_message($message);
          }
          else
          {
            MessageView::user_message($message);
          }
        }
        else if ($message['destination'] == $_SESSION['username'])
        {
          ?>
          <span class="message_source" style="color: red" onclick="test();"><?= $message['source'] ?>: </span>
          <span class="message_text" style="color: white"><?= $message['message'] ?></span>
          <?php
        }
        ?>
      </p>
    </div>
    <?php
  }

  public static function user_message($message)
  {
    ?>
    <span class="message_source pl-1" style="color: blue" onclick="privateMessage('<?= $message['source']; ?>');"><?= $message['source'] ?>: </span>
    <span class="message_text ml-1" style="color: black;"><?= $message['message'] ?></span>
    <?php
  }

  public static function my_message($message)
  {
    ?>
    <span class="pl-1" style="color: limegreen"><?= $message['source'] ?>: </span>
    <span class="ml-1" style="color: navy;"><?= $message['message'] ?></span>
    <?php
  }

  public static function my_private_message($message)
  {
    ?>
    <span class="pl-1" style="color: darkred">You to <span class="message_source" onclick="privateMessage('<?= $message['destination']; ?>');"><?= $message['destination']; ?></span>:</span>
    <span class="message_text ml-1" style="color: navy;"><?= $message['message'] ?></span>
    <?php
  }

  public static function received_private_message($message)
  {
    ?>
    <span class="pl-1" style="color: darkred"><span class="message_source" onclick="privateMessage('<?= $message['source']; ?>');"><?= $message['source'] ?></span> to you:</span>
    <span class="message_text ml-1" style="color: navy;"><?= $message['message'] ?></span>
    <?php
  }

  public static function server_message($message)
  {
    ?>
    <span class="pl-1" style="color: purple"><?= $message['source'] ?>: </span>
    <span class="ml-1" style="color: green;"><?= $message['message'] ?></span>
    <?php
  }
}

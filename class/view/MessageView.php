<?php

class MessageView
{
  public static function display($message_list, $user)
  {
    if (empty($user) === FALSE) $username = $user['username'];
    foreach ($message_list as $index => $message)
    {
      $source = $message['source'];
      $destination = $message['destination'];
      if (($destination === 'global') || ($user !== FALSE) && ($destination === $username || $source === $username))
      {
        MessageView::single_message($message, $user);
      }
    }
  }

  public static function single_message($message, $user)
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
          if (empty($user) === FALSE && $message['source'] === $user['username'])
          {
            MessageView::my_message($message);
          }
          else if (empty($user) === FALSE)
          {
            MessageView::user_message($message);
          }
          else
          {
            MessageView::disconnected_message($message);
          }
        }
        else if ($message['destination'] == $user['username'])
        {
          MessageView::received_private_message($message);
        }
        else if ($message['source'] === $user['username'])
        {
          MessageView::my_private_message($message);
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
    <span class="message_text ml-1" style="color: black;"><?= $message['message']; ?></span>
    <?php
  }

  public static function my_message($message)
  {
    ?>
    <span class="pl-1" style="color: limegreen"><?= $message['source']; ?>: </span>
    <span class="ml-1" style="color: navy;"><?= $message['message']; ?></span>
    <?php
  }

  public static function disconnected_message($message)
  {
    ?>
    <span class="pl-1" style="color: blue"><?= $message['source'] ?>: </span>
    <span class="ml-1" style="color: black;"><?= $message['message'] ?></span>
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

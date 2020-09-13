<?php

class MessageView
{
  public static function display($message_list)
  {
    foreach ($message_list as $index => $message) {
      ?>
      <p id="<?= $message['id'] ?>" class="w-100">
        <?php
        if ($message['source'] === 'server')
        {
          ?>
          <span class="message_source" style="color: purple"><?= $message['source'] ?>: </span>
          <span class="message_text" style="color: green"><?= $message['message'] ?></span>
          <?php
        }
        else
        {
          ?>
          <span class="message_source" style="color: red" onclick="test();"><?= $message['source'] ?>: </span>
          <span class="message_text" style="color: white"><?= $message['message'] ?></span>
          <?php
        }
        ?>
      </p>
      <?php
    }
  }
}

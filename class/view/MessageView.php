<?php

class MessageView
{
  public static function display($message_list)
  {
    foreach ($message_list as $index => $message) {
      ?>
      <div id="<?= $message['id'] ?>" class="w-100">
        <p class="d-flex" style="margin: 0; margin-top: 5px; margin-bottom: 5px; line-height: 16px">
          <?php
          if ($message['source'] === 'server')
          {
            ?>
            <span class="message_source pl-1" style="color: purple"><?= $message['source'] ?>: </span>
            <span class="message_text ml-1" style="color: green;"><?= $message['message'] ?></span>
            <?php
          }
          else
          {
            ?>
            <span class="message_source pl-1" style="color: blue"><?= $message['source'] ?>: </span>
            <span class="message_text ml-1" style="color: black;"><?= $message['message'] ?></span>
            <?php
          }
          ?>
        </p>
      </div>
      <?php
    }
  }
}

<?php

class MessageView
{
  public static function display($message_list, $output_buffering = true)
  {
    if ($output_buffering === TRUE) ob_start();

    foreach ($message_list as $index => $message) {
      ?>
      <p id="<?= $message['id'] ?>" class="w-100">
        <?php
        if ($message['source'] === 'server')
        {
          ?>
          <!-- added onclick="ajax(request('actionCreative'), actionResponse)" as example -->
          <span class="message_source" onclick="ajax(request('actionCreative'), actionResponse)" style="color: purple"><?= $message['source'] ?>: </span>
          <span class="message_text" style="color: green"><?= $message['message'] ?></span>
          <?php
        }
        else
        {
          ?>
          <span class="message_source" style="color: red"><?= $message['source'] ?>: </span>
          <span class="message_text" style="color: white"><?= $message['message'] ?></span>
          <?php
        }
        ?>
      </p>
      <?php
    }

    if ($output_buffering === FALSE) return FALSE;

    $response['html'] = ob_get_contents();
    ob_clean();
    return $response;
  }
}

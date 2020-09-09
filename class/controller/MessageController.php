<?php

class MessageController
{
  public static function send($inputs)
  {
    if (isset($inputs['message']) === FALSE || empty($inputs['message']) === TRUE) {
      ob_start();
      ErrorView::emptyMessageError();
      $response['message_input'] = ob_get_contents();
      ob_clean();
      return $response;
    }

    $messageModel = new MessageModel();
    $messageModel->new_message($_SESSION['username'], $inputs['message']);
    $message_list[0] = $messageModel->get_last_message();

    ob_start();
    MessageView::display($message_list);
    $response['message_board']['add'] = ob_get_contents();
    ob_clean();

    return $response;
  }

  public static function update($inputs)
  {
    $messageModel = new MessageModel();

    if ($inputs['last_message_id'] === 'none') $id = 0;
    else $id = intval($inputs['last_message_id']);

    $message_list = $messageModel->get_all_message_after($id);

    ob_start();
    MessageView::display($message_list);
    $response['message_board']['add'] = ob_get_contents();
    ob_clean();

    return $response;
  }
}

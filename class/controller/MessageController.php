<?php

class MessageController
{
  public static function send($inputs)
  {
    if (isset($inputs['message']) === FALSE || empty($inputs['message']) === TRUE) {
      $response = ErrorView::emptyMessageError();
      return $response;
    }

    $messageModel = new MessageModel();

    $messageModel->new_message($_SESSION['username'], $inputs['message']);

    $message_list[0] = $messageModel->get_last_message();

    $response = MessageView::display($message_list);

    return $response;
  }

  public static function update($inputs)
  {
    $messageModel = new MessageModel();

    if ($inputs['last_message_id'] === 'none') $id = 0;
    else $id = intval($inputs['last_message_id']);

    $message_list = $messageModel->get_all_message_after($id);

    $response = MessageView::display($message_list);

    return $response;
  }
}

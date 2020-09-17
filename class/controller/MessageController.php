<?php

class MessageController
{
  public static function send($inputs)
  {
    if (isset($inputs['message']) === FALSE || empty($inputs['message']) === TRUE)
    {
      ob_start();
      $message = ['id' => 'none', 'source' => 'server', 'message' => "Message is missing or empty"];
      MessageView::single_message($message);
      $response['message_board']['add'] = ob_get_contents();
      ob_clean();
      return $response;
    }

    $user = (new UserModel)->actual_user();

    if ($inputs['message'] === '<disconnect>')
    {
      (new MessageModel)->new_message('server', $user['username'] . " is disconnected");

      ob_start();
      FormView::loginForm();
      $response['input_board'] = ob_get_contents();
      ob_clean();

      return $response;
    }
    (new MessageModel)->new_message($user['username'], htmlspecialchars($inputs['message']));

    (new UserModel)->set_user_column($user['username'], 'last_update', time());
  }

  public static function update($inputs)
  {
    $messageModel = new MessageModel();

    if ($inputs['last_message_id'] === 'none')
    {
      $message_list = $messageModel->get_all_last_message(30);
    }
    else
    {
      $id = intval($inputs['last_message_id']);
      $message_list = $messageModel->get_all_message_after($id);
    }

    $user = (new UserModel)->actual_user();

    ob_start();
    MessageView::display($message_list, $user);
    $response['message_board']['add'] = ob_get_contents();
    ob_clean();

    return $response;
  }
}

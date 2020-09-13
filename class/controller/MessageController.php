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

    if ($inputs['message'] === '<disconnect>')
    {
      (new MessageModel)->new_message('server', $_SESSION['username'] . " is disconnected");

      session_destroy();
      session_unset();

      ob_start();
      FormView::loginForm();
      $response['input_board'] = ob_get_contents();
      ob_clean();

      return $response;
    }
    else
    {
      (new MessageModel)->new_message($_SESSION['username'], htmlspecialchars($inputs['message']));

      (new UserModel)->set_user_column($_SESSION['username'], 'last_update', time());
    }

    return ['none' => ''];
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


    ob_start();
    MessageView::display($message_list);
    $response['message_board']['add'] = ob_get_contents();
    ob_clean();

    return $response;
  }
}

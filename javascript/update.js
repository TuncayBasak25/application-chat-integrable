
let frame = 0;
function update()
{
  if (frame === 60)
  {
    let data = request('update');

    let lastMessage = document.getElementById('message_board').lastElementChild;

    if (lastMessage) lastMessage = lastMessage.id;
    else lastMessage = 'none';

    data.append('last_message_id', lastMessage);

    ajax(data, updateResponse);

    frame = 0;
  }

  frame++;

  window.requestAnimationFrame(update);
}

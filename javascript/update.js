
function update()
{
  let data = request('update');

  let lastMessage = document.getElementById('message_board').lastElementChild;

  if (lastMessage) lastMessage = lastMessage.id;
  else lastMessage = 'none';

  data.append('last_message_id', lastMessage);

  ajax(data, repeatUpdate);
}

function repeatUpdate(json)
{
  messageAutoScroll(json);

  setTimeout(update, 100);
}

function messageAutoScroll(json)
{
  if (typeof json.message_board.add !== 'string')
  {
    console.log('Problème dans messageAutoScroll' + json);
  }
  else if (json.message_board.add !== '')
  {
    let messageBoard = document.getElementById('message_board');
    messageBoard.scroll( {top: messageBoard.scrollHeight, left: 0, behavior: 'smooth'} );
  }
}

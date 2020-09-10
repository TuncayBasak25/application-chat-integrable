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

function setEmptyInputValue(inputId)
{
  let input = document.getElementById(inputId);

  if (input !== null) input.value = '';
}

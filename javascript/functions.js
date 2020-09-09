function messageAutoScroll()
{
  let messageBoard = document.getElementById('message_board');
  messageBoard.scroll( {top: messageBoard.scrollHeight, left: 0, behavior: 'smooth'} );
}

function setEmptyInputValue(inputId)
{
  let input = document.getElementById(inputId);

  if (input !== null) input.value = '';
}

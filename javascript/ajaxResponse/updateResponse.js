function updateResponse()
{
  if (this.response.charAt(0) !== '{')
  {
    errorLog(this.response);
    return false;
  }

  let response = JSON.parse(this.response);

  if (typeof response.html !== 'undefined')
  {
    let messag_board = document.getElementById('message_board');
    messag_board.innerHTML += response.html;

    if (response.html !== '') messag_board.scroll( {top: messag_board.scrollHeight, left: 0, behavior: 'smooth'} );
  }

}

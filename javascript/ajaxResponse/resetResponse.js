function resetResponse()
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
    messag_board.innerHTML = '';

    document.getElementById('input_board').innerHTML = response.html;
  }

}

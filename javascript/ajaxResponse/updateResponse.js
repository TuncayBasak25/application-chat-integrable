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
    document.getElementById('message_board').innerHTML += response.html;
  }

}

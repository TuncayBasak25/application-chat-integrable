function loginResponse()
{
  if (this.response.charAt(0) !== '{')
  {
    errorLog(this.response);
    return false;
  }

  let response = JSON.parse(this.response);

  if (typeof response.error !== 'undefined' && response.error !== '') {
    document.getElementById('login_input').value = '';
    document.getElementById('login_input').placeholder = response.error;
  }
  else if (typeof response.html !== 'undefined' && response.html !== '') {
    document.getElementById('input_board').innerHTML = response.html;
  }

}

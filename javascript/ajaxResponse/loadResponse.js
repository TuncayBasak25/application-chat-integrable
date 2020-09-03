function loadResponse()
{
  if (this.response.charAt(0) !== '{')
  {
    errorLog(this.response);
    return false;
  }

  let response = JSON.parse(this.response);

  if (typeof response.error !== 'undefined' && response.error !== '')
  {

  }
  else if (typeof response.html !== 'undefined' && response.html !== '')
  {
    messageDiv.innerHTML = response.html
  }
}

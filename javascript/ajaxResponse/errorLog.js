function errorLog(errorHtml)
{
  if (!document.getElementById('error_div'))
  {
    let div = document.createElement('div');
    div.id = 'error_div';
    document.body.appendChild(div);
  }

  document.getElementById('error_div').innerHTML = errorHtml;
}

function ajax(data, callBack = null, prenventDefault = false)
{
  let xhr = new XMLHttpRequest();
  xhr.open("POST", 'action/ajaxRequest.php');
  xhr.callBack = callBack;

  if (prenventDefault === false) xhr.onload = defaultAjaxCallBack;
  else xhr.onload = callBack
  xhr.send(data);
}

function formSubmit(form, callBack = null, preventDefault = false) {
  window.event.preventDefault();

  let data = request(form.id);

  let inputList = document.querySelectorAll("[form=" + form.id + "]");

  for (let input of inputList) data.append(input.name, input.value);

  ajax(data, callBack, preventDefault);

  return false;
}

function request(requestName, rawDataList = null)
{
  let data = new FormData();
  data.append("request", requestName);

  if (rawDataList !== null)
  {
    if (typeof rawDataList === 'string') rawDataList = [rawDataList];

    rawDataList.forEach( rawData => data.append(rawData.split('=')[0], rawData.split('=')[1]) );
  }

  return data;
}

function defaultAjaxCallBack()
{
  if (isJson(this.response) === false)
  {
    errorLog(this.response);
    return false;
  }

  let json = JSON.parse(this.response);

  for (let [elmId, content] of Object.entries(json))
  {
    let elm = document.getElementById(elmId);

    if (elm !== null)
    {
      if (typeof content === 'object')
      {
        if (typeof content.add === 'string' && content.add !== '')
        {
          elm.innerHTML += content.add;
        }
        else if (typeof content.value === 'string')
        {
          elm.value = content.value;
        }
      }
      else
      {
        elm.innerHTML = content;
      }
    }
  }

  if (typeof this.callBack === 'function') this.callBack(json);
}

function errorLog(errorHtml)
{
  if (document.getElementById('error_div') === null)
  {
    let div = document.createElement('div');
    div.id = 'error_div';
    document.body.appendChild(div);
  }

  document.getElementById('error_div').innerHTML = errorHtml;
}

function isJson(text)
{
  if (typeof text !== 'string') return false;
  else if (text.charAt(0) !== '{') return false;

  return true;
}

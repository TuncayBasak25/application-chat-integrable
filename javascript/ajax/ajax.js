function ajax(data, callBackFunction_array = null, prenventDefault = false)
{
  let xhr = new XMLHttpRequest();
  xhr.open("POST", 'action/ajaxRequest.php');

  if (prenventDefault === false)
  {
    xhr.onload = defaultAjaxCallBack;
    if (typeof callBackFunction_array !== 'object')
    {
      xhr.callBackFunction_array = Array(callBackFunction_array);
    }
    else
    {
      xhr.callBackFunction_array = callBackFunction_array;
    }
  }
  else
  {
    if (typeof callBackFunction_array !== 'object')
    {
      xhr.onload = callBackFunction_array;
    }
    else
    {
      xhr.onload = callBackFunction_array.shift();
      xhr.callBackFunction_array = callBackFunction_array;
    }
  }

  xhr.send(data);
}

function ajaxFormSubmit(form, callBackFunction_array = null, preventDefault = false) {
  window.event.preventDefault();

  let data = request(form.id);

  // let inputList = document.querySelectorAll("[form=" + form.id + "]");

  for (let input of form) data.append(input.name, input.value);


  ajax(data, callBackFunction_array, preventDefault);

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
    let elm;
    if (elmId === 'body')
    {
      elm = document.body;
    }
    else
    {
      elm = document.getElementById(elmId);
    }
    if (elm !== null)
    {
      if (typeof content === 'object')
      {
        if (typeof content.add === 'string' && content.add !== '')
        {
          elm.innerHTML += content.add;
        }
        else if (typeof content.value === 'string' && content.value !== '')
        {
          elm.value = content.value;
        }
      }
      else
      {
        elm.innerHTML = content;
      }
    }
    else if (elmId === 'none') // if (message sent)
    {
      // let messageSound = new SoundAlerts('message_sent');
    }
  }

  if (this.callBackFunction_array !== null)
  {
    this.callBackFunction_array.forEach((callBackFunction, i) => {
      callBackFunction(json);
    });
  }
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

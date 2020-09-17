function setEmptyInputValue(inputId)
{
  let input = document.getElementById(inputId);

  if (input !== null) input.value = '';
}

function privateMessage(username) {
  let privateMessage = getId('message_input');
  if (privateMessage !== null && privateMessage.value !== '')
  {
    privateMessage.value = '<p:' + username + '>';
  }
}

function playSoundAlert(json) {
  /*
  message_board: JSON { add:
  "<div id="11" class="w-100">
    <p class="d-flex" style="margin: 0; margin-top: 5px; margin-bottom: 5px; line-height: 16px">
      <span class="pl-1" style="color: limegreen">Sergio: </span>
      <span class="ml-1" style="color: navy;">test</span>
    </p>
  </div>" }
  */
  let messageSound = new SoundAlerts('message_sent');
}

window.addEventListener('unload', () => {
  ajax(request('message_input_form', 'message=<disconnect>'));
})

function setEmptyInputValue(inputId)
{
  let input = document.getElementById(inputId);

  if (input !== null) input.value = '';
}

function privateMessage(username) {
  document.getElementById('message_input').value = '<p:' + username + '>';
}

window.addEventListener('unload', () => {
  ajax(request('message_input_form', 'message=<disconnect>'));
})

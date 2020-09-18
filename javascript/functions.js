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
  // create an html class "alert", iterate over and detect an incoming message
  let board = getId('message_board');

  for (let div of board.children) {
    if (div.firstElementChild.firstElementChild.id === 'alert') {
      let messageSound = new SoundAlerts('message_sent');
      div.firstElementChild.firstElementChild.id = '';
    }
  }
}

// check if the user interacts with the window
let interaction = false;

function initSoundAlert() {
  // if an event listener is triggered, a sound can be played
  interaction = true;
}

document.body.addEventListener('mouseover', start);
document.body.addEventListener('scroll', start);
document.body.addEventListener('keydown', start);

// check if the user quits the page or the navigator
window.addEventListener('unload', () => {
  ajax(request('message_input_form', 'message=<disconnect>'));
})

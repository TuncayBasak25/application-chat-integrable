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
<<<<<<< HEAD
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
  messageSound.playSound();
=======
  // create an html class "alert", iterate over and detect an incoming message
  let board = getId('message_board');

  for (let div of board.children) {
    if (div.firstElementChild.firstElementChild.id === 'alert') {
      let messageSound = new SoundAlerts('message_sent');
      div.firstElementChild.firstElementChild.id = '';
    }
  }
>>>>>>> 7272aa824534575154ace0a50e9f1c56ac2d3481
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

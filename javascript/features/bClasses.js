let soundFiles = []; // sound file names

class SoundAlerts
{
  constructor(id)
  {
    this.id = Math.floor(Math.random() * 1000); // a string indicating requested action (e.g. connexion, message sent, message received, etc...)
    this.sound = 'src/snd/glitch.wav'; // id selects sound file from array
    this.setSound(this.sound);
  }

  setSound = function(sound)
  {
    this.audio = document.createElement('audio');
    this.audio.id = this.id;
    document.body.appendChild(this.audio);
    this.playSound();
	}

  playSound = function()
  {
    let audioTag = getId(this.id);

    // if the user has already inracted with the page...
    if (interaction === true && audioTag != null)
    {
      audioTag.play();
    }

    // when alert has been played, remove the audio element
  }
}

class ActionsPopUp
{
  constructor() {
    this.element = document.createElement('div');
  }
}

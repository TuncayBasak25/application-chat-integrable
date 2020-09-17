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
		this.audio.src = sound;
    this.audio.id = this.id;
    document.body.appendChild(this.audio); // or chat_container.appendChild(this.audio);
    this.playSound();
	}

  playSound = function()
  {
    let audioTag = document.getElementById(this.id);
      // rate = (Math.random() * 4.75) + 0.25; // playback rate range from 0.25 to 5.0

    if (audioTag != null)
    {
      soundAlert.play();
      // soundAlert.playbackRate = rate;
    }
  }

  stopSound = function(soundAlert)
  {
    setTimeout(() => {
      alert('done');
    }, Math.round(soundAlert.duration * 1000));
  }
}

class ActionsPopUp
{
  constructor() {
    this.element = document.createElement('div');
  }
}

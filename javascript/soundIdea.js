const ABS_PATH;
let soundFiles = [];

class ChatSounds {
  constructor(id) {
    this.id = id; // a string indicating requested action (e.g. connexion, message sent, message received, etc...)
    this.sound; // id selects sound file from array
    this.audio = document.createElement('audio');
    document.body.appendChild(this.audio); // or chat_container.appendChild(this.audio);
  }

  setSound = function() {
		this.audio.src; // ABS_PATH + this.sound
		this.audio.setAttribute('id', this.sound);
	}

  getSound = function() {
    return this.setSound();
  }

  playSound = function() {
  	let rate = (Math.random() * 4.75) + 0.25; // playback rate range from 0.25 to 5.0
    document.getElementById(this.id).play();
    document.getElementById(this.id).playbackRate = rate;

    // if (audio === finished playback) this.audio.stopSound()
  }

  stopSound = function() {
    this.audio.remove();
  }
}

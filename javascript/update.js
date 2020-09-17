let updateFrequency = 100;

function update()
{
  let data = request('update');

  if (document.getElementById('login_input') === null)
  {
    data.append('login_loaded', 'false');
  }
  else
  {
    data.append('login_loaded', 'true');
  }

  let lastMessage = document.getElementById('message_board').lastElementChild;

  if (lastMessage) lastMessage = lastMessage.id;
  else lastMessage = 'none';

  data.append('last_message_id', lastMessage);

  deltaT = (new Date).getTime();
  ajax(data, [repeatUpdate, pingMeter]);
}

let deltaT = 0;
let pingArray = [];
function pingMeter()
{
  deltaT = (new Date).getTime() - deltaT;
  pingArray.push(deltaT);
  if (deltaT > updateFrequency) updateFrequency = Math.ceil(deltaT);
  if (pingArray.length % Math.ceil(1000 / updateFrequency) === 0)
  {
    console.clear();
    console.log("The server's response time: " + deltaT);
    let total = 0;
    for (let i=0; i<pingArray.length; i++) total += pingArray[i];
    let average = total / pingArray.length;

    console.log("Average response time: " + average);

    pingArray = [];
  }
}

function repeatUpdate(json)
{
  messageAutoScroll(json);

  setTimeout(update, updateFrequency);
}

function messageAutoScroll(json)
{
  if (typeof json.message_board === 'undefined')
  {
    return false;
  }
  else if (typeof json.message_board.add !== 'string')
  {
    console.log('Problème dans messageAutoScroll' + json);
  }
  else if (json.message_board.add !== '')
  {
    let messageBoard = document.getElementById('message_board');
    messageBoard.scroll( {top: messageBoard.scrollHeight, left: 0, behavior: 'smooth'} );
  }
}

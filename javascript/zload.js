let messageDiv = document.createElement('div');

messageDiv.id = "chat_container";

document.body.appendChild(messageDiv);

ajax(request('load'));

let data = request('login');

data.append('username', 'tufan');

//ajax(data, loginResponse);

update();

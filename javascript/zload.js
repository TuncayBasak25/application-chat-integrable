let messageDiv = document.createElement('div');

messageDiv.id = "chat_container";

document.body.appendChild(messageDiv);

ajax(request('load'), initChatWindow);

//ajax(data, loginResponse);

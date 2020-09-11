function initChatWindow()
{
  document.getElementById('chat_window').reduced = false;
}

function mouseEnterChatWindow(chatWindow)
{

}

function mouseQuitChatWindow(chatWindow)
{
  if (window.clickedElement === chatWindow)
  {
    chatWindow.style.cursor = "";
  }
  else
  {
    chatWindow.style.cursor = "default";
  }

}

function mouseMoveChatWindow(chatWindow)
{
  if (window.clickedElement === chatWindow) return false;

  let mouseX = event.clientX;
  let mouseY = event.clientY;

  let rect = chatWindow.getBoundingClientRect();

  let border = 10;

  if (mouseX > rect.left + border && mouseX < rect.right - border && mouseY > rect.top + border && mouseY < rect.top + 30)
  {
    chatWindow.style.cursor = "move";
  }
  else if (chatWindow.reduced === true)
  {
    chatWindow.style.cursor = "default";
  }
  else if (mouseX > rect.left && mouseX < rect.left + border && mouseY > rect.top && mouseY < rect.top + border)
  {
    chatWindow.style.cursor = "nw-resize";
  }
  else if (mouseX > rect.right - border && mouseX < rect.right && mouseY > rect.top && mouseY < rect.top + border)
  {
    chatWindow.style.cursor = "ne-resize";
  }
  else if (mouseX > rect.right - border && mouseX < rect.right && mouseY > rect.bottom - border && mouseY < rect.bottom)
  {
    chatWindow.style.cursor = "se-resize";
  }
  else if (mouseX > rect.left && mouseX < rect.left + border && mouseY > rect.bottom - border && mouseY < rect.bottom)
  {
    chatWindow.style.cursor = "sw-resize";
  }
  else if (mouseX > rect.left && mouseX < rect.left + border && mouseY > rect.top + border && mouseY < rect.bottom - border)
  {
    chatWindow.style.cursor = "w-resize";
  }
  else if (mouseX > rect.right - border && mouseX < rect.right && mouseY > rect.top + border && mouseY < rect.bottom - border)
  {
    chatWindow.style.cursor = "e-resize";
  }
  else if (mouseX > rect.left + border && mouseX < rect.right - border && mouseY > rect.top && mouseY < rect.top + border)
  {
    chatWindow.style.cursor = "n-resize";
  }
  else if (mouseX > rect.left + border && mouseX < rect.right - border && mouseY > rect.bottom - border && mouseY < rect.bottom)
  {
    chatWindow.style.cursor = "s-resize";
  }
  else
  {
    chatWindow.style.cursor = "default";
  }

}

function mouseDownChatWindow(chatWindow)
{
  window.clickedElement = chatWindow;
}

window.addEventListener('mouseup', globalMouseUp);

function globalMouseUp()
{
  if (typeof window.clickedElement !== 'undefined')
  {
    window.clickedElement.dispatchEvent(new Event('mouseup'));
    window.clickedElement = undefined;
    window.mouseX = undefined;
    window.mouseY = undefined;

    document.body.style.cursor = '';
  }
}

window.addEventListener('mousemove', globalMouseMove);

function globalMouseMove()
{
  if (typeof window.clickedElement !== 'undefined')
  {
    if (window.clickedElement.id === 'chat_window' )
    {
      if (document.body.style.cursor === '')
      {
        document.body.style.cursor = window.clickedElement.style.cursor;
      }
      modifyChatWindow(window.clickedElement);
    }
  }
}

function modifyChatWindow(chatWindow)
{
  if (typeof window.mouseX === 'undefined') window.mouseX = event.clientX;
  if (typeof window.mouseY === 'undefined') window.mouseY = event.clientY;

  let mouseX = event.clientX;
  let mouseY = event.clientY;

  let lastMouseX = window.mouseX;
  let lastMouseY = window.mouseY;

  let rect = chatWindow.getBoundingClientRect();

  let crs = document.body.style.cursor;
  let diffX = mouseX - lastMouseX;
  let diffY = mouseY - lastMouseY;

  if (crs === 'move')
  {
    chatWindow.style.left = String(rect.left + diffX) + "px";
    chatWindow.style.top = String(rect.top + diffY) + "px";
  }

  if (crs === 'w-resize' || crs === 'nw-resize' || crs === 'sw-resize')
  {
    if (rect.width > 200) chatWindow.style.left = String(rect.left + diffX) + "px";
    chatWindow.style.width = String(rect.width - diffX) + "px";
  }
  else if (crs === 'e-resize' || crs === 'ne-resize' || crs === 'se-resize')
  {
    chatWindow.style.width = String(rect.width + diffX) + "px";
  }

  if (crs === 'n-resize' || crs === 'nw-resize' || crs === 'ne-resize')
  {
    if (rect.height > 300) chatWindow.style.top = String(rect.top + diffY) + "px";
    chatWindow.style.height = String(rect.height - diffY) + "px";
  }
  else if (crs === 's-resize' || crs === 'sw-resize' || crs === 'se-resize')
  {
    chatWindow.style.height = String(rect.height + diffY) + "px";
  }

  window.mouseX = mouseX;
  window.mouseY = mouseY;
}

function mouseUpChatWindow(chatWindow)
{

}

function reduceChatWindow(button)
{
  let chatWindow = button.parentElement.parentElement;

  button.style.display = "none";
  document.getElementById('chat_window_develop_button').style.display = "";

  chatWindow.reduced = true;

  document.getElementById('message_board').style.display = "none";
  document.getElementById('input_board').style.display = "none";

  chatWindow.style.width = "200px";
  chatWindow.style.height = "30px";

  chatWindow.style.left = String(window.innerWidth - 250) + "px";
  chatWindow.style.top = String(window.innerHeight - 80) + "px";

  chatWindow.style.minLeft = String(window.innerWidth - 250) + "px";
  chatWindow.style.minTop = String(window.innerHeight - 80) + "px";
}

function developChatWindow(button)
{
  let chatWindow = button.parentElement.parentElement;
  let rect = chatWindow.getBoundingClientRect();

  button.style.display = "none";
  document.getElementById('chat_window_reduce_button').style.display = "";

  chatWindow.reduced = false;

  document.getElementById('message_board').style.display = "";
  document.getElementById('input_board').style.display = "";

  chatWindow.style.width = "300px";
  chatWindow.style.height = "500px";

  chatWindow.style.minWidth = "200px";
  chatWindow.style.minHeight = "300px";

  let diffWidth = rect.right + 350 - window.innerWidth;
  let diffHeight = rect.bottom + 550 - window.innerHeight;

  if (diffWidth > 0)
  {
    chatWindow.style.left = String(window.innerWidth - 350) + "px";
  }

  if (diffHeight > 0)
  {
    chatWindow.style.top = String(window.innerHeight - 550) + "px";
  }

}

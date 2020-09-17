function getId(id) {
  return document.getElementById(id);
}

function getName(name) {
  return document.getElementsByName(name);
}

function getSelector(selector) {
  return docoument.querySelectorAll(selector);
}

function test() {
  alert('clicked');

  // const ACTIONS = getId('actionContainer');
  //
  // ACTIONS.style.width = "200px";
  // ACTIONS.style.height = "200px";
  // ACTIONS.style.backgroundColor = "#f00";
  // ACTIONS.innerHTML = '<form id="user_actions_form" onsubmit="" method="POST"><input class="form-control" type="text" name="some-action" value=""></form>'
  //
  // if (ACTIONS.classList.contains('hidden')) {
  //   ACTIONS.classList.remove('hidden');
  // } else {
  //   ACTIONS.classList.add('hidden');
  // }
}

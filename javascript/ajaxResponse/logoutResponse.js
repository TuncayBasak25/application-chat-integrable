function logoutResponse() {
  console.log(this.response);

  let response = JSON.parse(this.response);

  if (response.error !== '') {
    document.getElementById('login_error').innerHTML = response.error;
  }
  else if (response.html !== '') {
    document.getElementById('head_bar').innerHTML = response.html;
  }

}

function formSubmit(form, callBackFunction) {
  window.event.preventDefault();

  let data = request(form.id);

  let inputs = document.querySelectorAll("[form=" + form.id + "]");

  for (var i = 0; i < inputs.length; i++) {
    let input = inputs[i];

    data.append(input.name, input.value)

    input.value = '';
  }

  ajax(data, callBackFunction);

}

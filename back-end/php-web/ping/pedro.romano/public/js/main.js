
const ip = document.getElementById("1")
const quant = document.getElementById("2")
const submit = document.querySelector('input[type=submit]')
const helloMessage = document.querySelector('#hello-message')

submit.addEventListener('click', function(event) {
  event.preventDefault()
  const url = `../api/hello.php?name=${ip.value}&nome=${quant.value}`;
  fetch(url)
    .then(res => res.json())
    .then(json => loadHello(json))
})

function loadHello(message) {
  helloMessage.innerHTML = message.body;
}
window.onload = displayTime();

function displayTime() {
  const display = new Date().toLocaleString();
  document.getElementById('clock').innerHTML = display;
  setTimeout(displayTime, 1000);
}
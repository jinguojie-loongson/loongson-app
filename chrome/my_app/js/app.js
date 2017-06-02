/*function my_clock(e) {
  var d = new Date();
  var s = d.getHours() + ":" + d.getMinutes() + ":" + d.getSeconds();
  e.innerHTML = s;
  console.log(s);

  setTimeout(function() {my_clock(e);}, 1000);
}

var e = document.getElementById('clock_div');
my_clock(e);

*/

function httpRequest(url, callback) {
  var http = new XMLHttpRequest();
  http.open("GET", url, true);
  http.onreadystatechange = function() {
    if (http.readyState == 4) {
      callback(http.responseText);
    }
  }
  http.send();
}

function notify() {
  var notification = webkitNotifications.createNotification (
    'icon48.png',
    'Notification Demo',
    'Merry Hello workd'
  );

  notification.show();
}


/*
function installApp() {
  var btn = document.getElementById('installApp');
  btn.innerHTML = "Installing App...";

  httpRequest('http://localhost', function(text) {
    console.log("<<<GET HTML>>> " + text);
    btn.value = text;
  });
}

var btn = document.getElementById('installApp');
btn.onclick= function() {installApp();}
*/

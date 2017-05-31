chrome.app.runtime.onLaunched.addListener(function() {
  chrome.app.window.create('html/main.html', {
    id: 'MyApp' //,
    //frame: 'none'
  });
});

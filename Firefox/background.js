// chrome.runtime.onMessageExternal.addListener(
//   function(request, sender, sendResponse) {
//     if (sender.url == blocklistedWebsite)
//       return;  // don't allow this web page access
//     if (request.openUrlInEditor)
//       openUrl(request.openUrlInEditor);
//   });


// chrome.runtime.onMessage.addListener(function(message, sender, sendResponse) {
//     alert("message received");
// });

// chrome.windows.create({
//     type : 'popup',
//     url : "http://localhost:8080/SecPass/public/login",
//     type: "popup"
// }, function(newTab) {

// });

browser.browserAction.onClicked.addListener(function(activeTab){
  var newURL = "http://localhost";
  browser.tabs.create({ url: newURL });
});


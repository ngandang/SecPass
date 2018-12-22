chrome.storage.local.get('user_pgp', function(data){
  if (!data.user_pgp){
    console.info("Không có dữ liệu PGP của người dùng. Bạn cần đăng ký hoặc cài lại khoá để có thể sử dụng.");
    chrome.browserAction.setTitle({title:"SecPASS - Không tìm thấy dữ liệu người dùng"});
    chrome.browserAction.setIcon({path:"icon-red.png"});
  }
});
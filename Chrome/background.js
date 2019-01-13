var checkPGP = function () {
  chrome.storage.local.get('user_pgp', function(data){
    if (!data.user_pgp){
      console.info("Không có dữ liệu PGP của người dùng. Bạn cần đăng ký hoặc cài lại khoá để có thể sử dụng.");
      chrome.browserAction.setTitle({title:"SecPASS - Không tìm thấy dữ liệu người dùng"});
      chrome.browserAction.setIcon({path:"icon-red.png"});
      // Xoá cookies người dùng
      chrome.cookies.getAll({domain: "secpass.terabox.vn"}, function(cookies) {
        for(var i=0; i<cookies.length;i++) {
          chrome.cookies.remove({url: "https://secpass.terabox.vn" + cookies[i].path, name: cookies[i].name});
        }
      });
    }
    else {
      chrome.browserAction.setTitle({title:"SecPASS"});
      chrome.browserAction.setIcon({path:"icon.png"});
    }
  });
}

checkPGP();

setInterval(() => {
  checkPGP();
}, 60000);
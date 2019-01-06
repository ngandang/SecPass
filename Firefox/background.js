var checkPGP = function (){
  browser.storage.local.get('user_pgp', function(data){
    if (!data.user_pgp){
      console.info("Không có dữ liệu PGP của người dùng. Bạn cần đăng ký hoặc cài lại khoá để có thể sử dụng.");
      browser.browserAction.setTitle({title:"SecPASS - Không tìm thấy dữ liệu người dùng"});
      browser.browserAction.setIcon({path:"icon-red.png"});
    }
    else {
      browser.browserAction.setTitle({title:"SecPASS"});
      browser.browserAction.setIcon({path:"icon.png"});
    }
  });
}

checkPGP();

setInterval(() => {
  checkPGP();
}, 60000);
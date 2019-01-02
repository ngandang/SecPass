setInterval(() => {
  browser.storage.local.get('user_pgp', function(data){
    if (!data.user_pgp){
      console.info("PGP not found. Try to get user attention...");
      browser.browserAction.setTitle({title:"SecPASS - Không tìm thấy dữ liệu người dùng"});
      browser.browserAction.setIcon({path:"icon-red.png"});
    }
  });
}, 60000);
window.onload = function()
{
  document.getElementById('btnCancel').onclick = function()
  {
    window.location = "main.html";
  }

  document.getElementById('inputFile').onchange = function() {
    var zip = new JSZip();
    zip.loadAsync(this.files[0])
      .then(function(zip) {
        // process ZIP file content here
        Promise.all([
          zip.file("private.asc").async("text"),
          zip.file("public.txt").async("text")
        ]).then(function(result) {
          document.getElementById("priv-key").value = result[0];
          document.getElementById("pub-key").value = result[1];
          document.getElementById("btnSubmit").disabled=false;
        });

      }, function() {alert("SecPASS: Không đúng tập tin ZIP hợp lệ")}); 
  };
  document.getElementById('btnSubmit').onclick = function()
  {
    var user_pgp = {
      'privateKeyArmored': document.getElementById("priv-key").value,
      'publicKeyArmored': document.getElementById("pub-key").value
    };

    chrome.storage.local.get('user_pgp', async function(result){
      console.log('addon: read user_pgp');
      if (result.user_pgp)
        if(!confirm('SecPASS: Tiện ích hiện đang chứa khoá người dùng. Dữ liệu này sẽ bị ghi đè nếu tiếp tục. Bạn có chắc chắn ?'))
          return 1;
      
      const publicKeyObj = (await openpgp.key.readArmored(user_pgp.publicKeyArmored)).keys[0];
      chrome.storage.local.set({'user_email': publicKeyObj.users[0].userId.email});
      chrome.storage.local.set({'user_pgp': user_pgp }, function(){
        chrome.cookies.getAll({domain: "secpass.terabox.vn"}, function(cookies) {
          for(var i=0; i<cookies.length;i++) {
            chrome.cookies.remove({url: "https://secpass.terabox.vn" + cookies[i].path, name: cookies[i].name});
          }
        });
        console.log('addon: saved');
        alert('SecPASS: Đã nhận được cặp khoá của bạn.');
        window.location = "main.html";
      });
    });
  }
}
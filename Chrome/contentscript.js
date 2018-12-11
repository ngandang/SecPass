
console.log('addon: getin');

document.addEventListener('setUserPassphraseEvent', function (event) {
    chrome.storage.local.set({'user_passphrase': event.detail}, function(){
        console.log('addon: saved passphrase');
        alert('SecPASS: Mật khẩu sẽ được nhớ cho đến khi đăng xuất.');
    });
});

document.addEventListener('letgetUserPassphraseEvent', function (event) {
    console.log('addon: read passphrase');
    chrome.storage.local.get('user_passphrase', function(result){
        // console.log(result);
        document.dispatchEvent(new CustomEvent('getUserPassphraseEvent', {detail: result.user_passphrase}));
    });
});


document.addEventListener('setUserPGPEvent', function (event) {
    chrome.storage.local.set({'user_pgp': event.detail}, function(){
        console.log('addon: saved');
        // console.log(event.detail);
        alert('SecPASS: Đã nhận được cặp khoá của bạn.');
    });
});

document.addEventListener('letgetUserPGPEvent', function (event) {
    chrome.storage.local.get('user_pgp', function(result){
        console.log('addon: read user_pgp');
        document.dispatchEvent(new CustomEvent('getUserPGPEvent', {detail: JSON.stringify(result.user_pgp)})); // bypass firefox permission error
    });
});


$("#logout").click(function(){
    chrome.storage.local.remove('user_passphrase', function(){
        console.log('addon: destroy passphrase');
        alert('SecPASS: Mật khẩu đã được xoá khỏi tiện ích.'); 
    });
});
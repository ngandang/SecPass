// Check if connected.
document.addEventListener('hello', function (event) {
    if(event.detail === "kfbgobbmmfcdipebhoojjjkpcmcjefpg")
        document.dispatchEvent(new CustomEvent('hi', {detail: "kfbgobbmmfcdipebhoojjjkpcmcjefpg"}));
});

console.log('addon: getin');
document.addEventListener('setUserPassphraseEvent', function (event) {
    browser.storage.local.set({'user_passphrase': event.detail}, function(){
        console.log('addon: saved passphrase');
        alert('SecPASS: Mật khẩu sẽ được nhớ cho đến khi đăng xuất.');
    });
});

document.addEventListener('letgetUserPassphraseEvent', function (event) {
    console.log('addon: read passphrase');
    browser.storage.local.get('user_passphrase', function(result){
        document.dispatchEvent(new CustomEvent('getUserPassphraseEvent', {detail: result.user_passphrase}));
    });
});

document.addEventListener('letgetUserEmailEvent', function (event) {
    console.log('addon: read email');
    chrome.storage.local.get('user_email', function(result){
        document.dispatchEvent(new CustomEvent('getUserEmailEvent', {detail: result.user_email}));
    });
});

document.addEventListener('setUserPGPEvent', function (event) {
    browser.storage.local.get('user_pgp', async function(result){
        console.log('addon: read user_pgp');
        if(result.user_pgp)
            if(!confirm('SecPASS: Tiện ích hiện đang chứa khoá người dùng. Dữ liệu này sẽ bị ghi đè nếu tiếp tục. Bạn có chắc chắn ?'))
                return 1;
        
        const publicKeyObj = (await openpgp.key.readArmored(event.detail.publicKeyArmored)).keys[0];
        browser.storage.local.set({'user_email': publicKeyObj.users[0].userId.email});
        browser.storage.local.set({'user_pgp': event.detail}, function(){
            console.log('addon: saved');
            // console.log(event.detail);
            alert('SecPASS: Đã nhận được cặp khoá của bạn.');
        });
    });
});

document.addEventListener('letgetUserPGPEvent', function (event) {
    browser.storage.local.get('user_pgp', function(result){
        console.log('addon: read user_pgp');
        document.dispatchEvent(new CustomEvent('getUserPGPEvent', {detail: JSON.stringify(result.user_pgp)})); // bypass firefox permission error
    });
});

document.addEventListener('removeUserPassphraseEvent', function (event) {
    browser.storage.local.remove('user_passphrase', function(){
        console.log('addon: destroy passphrase');
        alert('SecPASS: Mật khẩu đã được xoá khỏi tiện ích.'); 
    });
});
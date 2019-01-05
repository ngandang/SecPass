// Check if connected.
document.addEventListener('hello', function (event) {
    if(event.detail === "kfbgobbmmfcdipebhoojjjkpcmcjefpg")
        document.dispatchEvent(new CustomEvent('hi', {detail: "kfbgobbmmfcdipebhoojjjkpcmcjefpg"}));
});

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
        document.dispatchEvent(new CustomEvent('getUserPassphraseEvent', {detail: result.user_passphrase}));
    });
});

document.addEventListener('removeUserPassphraseEvent', function (event) {
    chrome.storage.local.remove('user_passphrase', function(){
        console.log('addon: destroy passphrase');
    });
});

document.addEventListener('letgetUserEmailEvent', function (event) {
    console.log('addon: read email');
    chrome.storage.local.get('user_email', function(result){
        document.dispatchEvent(new CustomEvent('getUserEmailEvent', {detail: result.user_email}));
    });
});

document.addEventListener('setUserPGPEvent', function (event) {
    chrome.storage.local.get('user_pgp', async function(result){
        console.log('addon: read user_pgp');
        if (result.user_pgp)
            if(!confirm('SecPASS: Tiện ích hiện đang chứa khoá người dùng. Dữ liệu này sẽ bị ghi đè nếu tiếp tục. Bạn có chắc chắn ?'))
                return 1;

        const publicKeyObj = (await openpgp.key.readArmored(event.detail.publicKeyArmored)).keys[0];
        chrome.storage.local.set({'user_email': publicKeyObj.users[0].userId.email});
        chrome.storage.local.set({'user_pgp': event.detail}, function(){
            console.log('addon: saved');
            // console.log(event.detail);
            alert('SecPASS: Đã nhận được cặp khoá của bạn.');
        });
    });
});

document.addEventListener('letgetUserPGPEvent', function (event) {
    chrome.storage.local.get('user_pgp', function(result){
        console.log('addon: read user_pgp');
        document.dispatchEvent(new CustomEvent('getUserPGPEvent', {detail: JSON.stringify(result.user_pgp)})); // bypass firefox permission error
    });
});

document.addEventListener('setGroupPGPEvent', function (event) {
    var group_id = event.detail.group_id;
    var group_pgp = event.detail.group_pgp;
    chrome.storage.local.get(group_id, function(result){
        console.log('addon: read group_pgp');
        if (result[0])
            if(!confirm('SecPASS: Tiện ích hiện đang chứa khoá của nhóm này. Dữ liệu này sẽ bị ghi đè nếu tiếp tục. Bạn có chắc chắn ?'))
                return 1;

        chrome.storage.local.set({group_id: group_pgp}, function(){
            console.log('addon: saved');
            // console.log(event.detail);
            alert('SecPASS: Đã nhận được cặp khoá của nhóm.');
        });
    });
});

document.addEventListener('letgetGroupPGPEvent', function (event) {
    var group_id = event.detail;
    chrome.storage.local.get(group_id, function(result){
        console.log('addon: read group_pgp');
        document.dispatchEvent(new CustomEvent('getGroupPGPEvent', {detail: JSON.stringify(result[0])})); // bypass firefox permission error
    });
});


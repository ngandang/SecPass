
// var GeneratePGP = function() {
//     var handleSubmit = function () {
//         $('#saveSubmit').click(function(e) {
//             e.preventDefault();
//             var options = {
//                 userIds: [{ name: $('#pgp input[name=uid_name]').val() , 
//                             email: $('#pgp input[name=uid_email]').val() }], // multiple user IDs
//                 numBits: 2048,                                            // RSA key size
//                 passphrase: $('#pgp input[name=passphrase]').val()         // protects the private key
//             };
//             console.log(options)

//             openpgp.generateKey(options).then(function(key) {
//                 let user = {}
//                 user.privateKeyArmored = key.privateKeyArmored; // '-----BEGIN PGP PRIVATE KEY BLOCK ... '
//                 user.publicKeyArmored = key.publicKeyArmored;   // '-----BEGIN PGP PUBLIC KEY BLOCK ... '
//                 user.revocationCertificate = key.revocationCertificate;	// '-----BEGIN PGP PUBLIC KEY BLOCK ... '

// 				chrome.storage.local.set({'user_pgp':user}, function(){
// 					// console.log(user);
// 					console.log('generate pgp key pairs success!');
// 				});
//             });
//         })
//     };
   
//       //== Public Functions
//     return {
//         // public functions
//         init: function() {
//             handleSubmit();
//         }
//     };
// }();



// var UsePGP = function() {
//     var handleSubmit = function () {
//         $('#addSubmit').click(function(e) {
//             // e.preventDefault();
            
//             	// Listen you CRX event
		        
// 		        });
// 	            // send data through a DOM event
// 				// document.dispatchEvent(new CustomEvent('getUserPGPEvent', {user_pgp: data.user_pgp}));
// 			}
//         });

//     };
   
//       //== Public Functions
//     return {
//         // public functions
//         init: function() {
//             handleSubmit();
//         }
//     };
// }();


$(document).ready(function(){
	// TODO: sửa lại login
    // if(window.location.href.match("/pgp")){
    // 	GeneratePGP.init();
    // }
    // else
        if(window.location.href.match("/logout")){
        chrome.storage.local.remove('user_pgp.passphrase', function(){
            console.log('addon: destroy passphrase');
            // console.log(event.detail);
            alert('SecPASS: Mật khẩu đã được xoá.');
        });
    }

    else {
    	console.log('addon: getin');

        document.addEventListener('setUserPassphraseEvent', function (event) {
            chrome.storage.local.set({'user_passphrase': event.detail}, function(){
                console.log('addon: saved passphrase');
                alert('SecPASS: Mật khẩu sẽ được nhớ cho đến khi đăng xuất.');
            });
        });
    	
        document.addEventListener('letgetUserPassphraseEvent', function (event) {
            chrome.storage.local.get('user_passphrase', function(result){
                console.log('addon: read passphrase');
                console.log(result);
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
                document.dispatchEvent(new CustomEvent('getUserPGPEvent', {detail: result.user_pgp}));
            });
        });
        

    }
});
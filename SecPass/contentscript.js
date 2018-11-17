
var GeneratePGP = function() {
    var handleSubmit = function () {
        $('#saveSubmit').click(function(e) {
            e.preventDefault();
            var options = {
                userIds: [{ name: $('#pgp input[name=uid_name]').val() , 
                            email: $('#pgp input[name=uid_email]').val() }], // multiple user IDs
                numBits: 2048,                                            // RSA key size
                passphrase: $('#pgp input[name=passphrase]').val()         // protects the private key
            };
            console.log(options)

            openpgp.generateKey(options).then(function(key) {
                let user = {}
                user.privateKeyArmored = key.privateKeyArmored; // '-----BEGIN PGP PRIVATE KEY BLOCK ... '
                user.publicKeyArmored = key.publicKeyArmored;   // '-----BEGIN PGP PUBLIC KEY BLOCK ... '
                user.revocationCertificate = key.revocationCertificate;	// '-----BEGIN PGP PUBLIC KEY BLOCK ... '

				chrome.storage.local.set({'user_pgp':user}, function(){
					// console.log(user);
					console.log('generate pgp key pairs success!');
				});
            });
        })
    };
   
      //== Public Functions
    return {
        // public functions
        init: function() {
            handleSubmit();
        }
    };
}();



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
    if(window.location.href.match("/pgp"))
    	GeneratePGP.init();
    else {
    	console.log('getin');
    	document.addEventListener('getUserPGPEvent', function (event) {
			var user_pgp = chrome.storage.local.get('user_pgp', function(data){
				console.log('storage');
				// Lỗi tại thằng return
				return data.user_pgp;
			});
			console.log("data"+user_pgp);
			return	user_pgp;
		});

    }
});
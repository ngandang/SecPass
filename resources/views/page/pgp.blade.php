@extends('layouts.master')
@section('content')
<div class="container">
    <form id="pgp" action="" method="POST">
        <input name="uid_name" type="text" placeholder="Name">
        <input name="uid_email" type="text" placeholder="Email">
        <input name="passphrase" type="text" placeholder="Password/Passphrase">
        <textarea name="content" id="content" cols="30" rows="10"></textarea>
        <button id="saveSubmit" type="submit">Run</button>
    </form>
    <textarea name="results" id="" cols="150" rows="10"></textarea>

</div>

@endsection

@section('pageSnippets')
<script>
    var SnippetTest = function() {
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
                    console.log(key)
                    $("textarea[name=results]").val(key.privateKeyArmored+'\r\n'+key.publicKeyArmored)
                    let user = {}
                    user.privkey = key.privateKeyArmored; // '-----BEGIN PGP PRIVATE KEY BLOCK ... '
                    user.pubkey = key.publicKeyArmored;   // '-----BEGIN PGP PUBLIC KEY BLOCK ... '
                    user.revocationSignature = key.revocationSignature; // '-----BEGIN PGP PUBLIC KEY BLOCK ... '
                
                    // const openpgp = require('openpgp') // use as CommonJS, AMD, ES6 module or via window.openpgp

                    // openpgp.initWorker({ path:'openpgp.worker.js' }) // set the relative web worker path

                    // put keys in backtick (``) to avoid errors caused by spaces or tabs
                    const pubkey = user.pubkey
                    const privkey = user.privkey //encrypted private key
                    const passphrase = $('#pgp input[name=passphrase]').val() //what the privKey is encrypted with
                    
                    var messageToEncrypt = ""
                    var cipherToDecrypt = ""
                    
                    async function encryptFunction (callback) {
                        console.log('begin process')
                        const privKeyObj = (await openpgp.key.readArmored(privkey)).keys[0]
                        await privKeyObj.decrypt(passphrase)
                        
                        const options = {
                            message: openpgp.message.fromText($('#pgp textarea[name=content]').val()),       // input as Message object
                            publicKeys: (await openpgp.key.readArmored(pubkey)).keys, // for encryption
                            privateKeys: [privKeyObj]                                 // for signing (optional)
                        }
                        
                        openpgp.encrypt(options).then(ciphertext => {
                            encrypted = ciphertext.data // '-----BEGIN PGP MESSAGE ... END PGP MESSAGE-----'
                            console.log(encrypted)
                            callback(encrypted)
                        })
                        
                        console.log('end process')
                    }

                    async function decryptFunction (callback) {
                        console.log('begin process')
                        const privKeyObj = (await openpgp.key.readArmored(privkey)).keys[0]
                        await privKeyObj.decrypt(passphrase)
                        
                        console.log('config decrypt')
                        const options = {
                            message: await openpgp.message.readArmored(encrypted),    // parse armored message
                            publicKeys: (await openpgp.key.readArmored(pubkey)).keys, // for verification (optional)
                            privateKeys: [privKeyObj]                                 // for decryption
                        }
                        console.log('begin decrypt')
                        openpgp.decrypt(options).then(plaintext => {
                            decrypted = plaintext.data
                            console.log(decrypted)
                            callback(decrypted) // 'Hello, World!'
                        })

                        console.log('end process')
                    }

                    encryptFunction(function(result) {
                        cipherToDecrypt = result
                    })
                    decryptFunction(function(result) {
                        console.log(result)
                    })
                
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

    $(document).ready(function(){
        SnippetTest.init();
    });
</script>
@endsection
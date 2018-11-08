@extends('layouts.master')
@section('content')
<div class=test>
    
</div>

@endsection

@section('pageSnippets')
<script>
    $(document).ready(function(){
        var options = {
            userIds: [{ name:'AVC', email:'AVC@example.com' }], // multiple user IDs
            numBits: 2048,                                            // RSA key size
            passphrase: 'super long and hard to guess secret'         // protects the private key
        };
        openpgp.generateKey(options).then(function(key) {
            let user = {}
            user.privkey = key.privateKeyArmored; // '-----BEGIN PGP PRIVATE KEY BLOCK ... '
           // user.pubkey = key.publicKeyArmored;   // '-----BEGIN PGP PUBLIC KEY BLOCK ... '
            user.revocationSignature = key.revocationSignature; // '-----BEGIN PGP PUBLIC KEY BLOCK ... '
        
            // const openpgp = require('openpgp') // use as CommonJS, AMD, ES6 module or via window.openpgp

            // openpgp.initWorker({ path:'openpgp.worker.js' }) // set the relative web worker path

            // put keys in backtick (``) to avoid errors caused by spaces or tabs
            const pubkey = user.pubkey
            const privkey = user.privkey //encrypted private key
            const passphrase = 'super long and hard to guess secret'; //what the privKey is encrypted with
            
            const encryptFunction = async() => {
                console.log('begin process')
                const privKeyObj = (await openpgp.key.readArmored(privkey)).keys[0];
                await privKeyObj.decrypt(passphrase);
                
                const options = {
                    message: openpgp.message.fromText('Hello, World!'),       // input as Message object
                    publicKeys: (await openpgp.key.readArmored(pubkey)).keys, // for encryption
                    privateKeys: [privKeyObj]                                 // for signing (optional)
                }
                
                openpgp.encrypt(options).then(ciphertext => {
                    encrypted = ciphertext.data // '-----BEGIN PGP MESSAGE ... END PGP MESSAGE-----'
                    console.log(encrypted)
                    return encrypted
                })
                
                console.log('end process')
            }
            const decryptFunction = async() => {
                console.log('begin process')
                const privKeyObj = (await openpgp.key.readArmored(privkey)).keys[0];
                await privKeyObj.decrypt(passphrase);
                
                console.log('config decrypt')
                const options = {
                    message: await openpgp.message.readArmored(encrypted),    // parse armored message
                    publicKeys: (await openpgp.key.readArmored(pubkey)).keys, // for verification (optional)
                    privateKeys: [privKeyObj]                                 // for decryption
                }
                console.log('begin decrypt')
                openpgp.decrypt(options).then(plaintext => {
                    console.log(plaintext.data)
                    return plaintext.data // 'Hello, World!'
                })

                console.log('end process')
            }

            encryptFunction()
            decryptFunction()
        
        });

    });
</script>
@endsection
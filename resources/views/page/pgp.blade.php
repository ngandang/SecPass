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
    <button id="test1">Test set PGP</button>
    <button id="test2">Test get PGP</button>
    <button id="test3">Test get user passphrase</button>

</div>

@endsection

@section('pageSnippets')
<script>
    // // OpenPGPjs
    const privkey1 = '-----BEGIN PGP PRIVATE KEY BLOCK-----\r\nVersion: OpenPGP.js v4.2.1\r\nComment: https://openpgpjs.org\r\n\r\n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\r\nYXkb\r\n=K9rW\r\n-----END PGP PRIVATE KEY BLOCK-----\r\n' //encrypted private key
    const pubkey1 = '-----BEGIN PGP PUBLIC KEY BLOCK-----\r\nVersion: OpenPGP.js v4.2.1\r\nComment: https://openpgpjs.org\r\n\r\nxsBNBFvuUfgBCADgUdMAhzClHIHPfxxao0DBtauwukaSXwqNmY1YJgewBdlQ\r\nq61rbar29ER/eUWt51MIkv5LFAYluxqH0rNy2UD8x6zGm3Nfj1y04OwKPRC2\r\nZkT33CKc10ayaFxGjx11vJcC9iptrCftWCLkfOGBpTIdHoTTHwAGeVQevkGj\r\nh/u6tvYt/usXZfydJBKzrneYaaOMqz15Q2Yitdsvv9qAKFpVpsWvmWUnY2p2\r\nnLI5Bwp8+/alb/eomMBLwYgmuvycahUyH8SSH5MNCCok2Hg9fCD5GFPtAzNM\r\nxRprBByqGp1bSaLP9Bf2f7SYp6fbWUQ9PESutmuIalnesgJaHo97Ujl5ABEB\r\nAAHNGkN1b25nIDxjdW9uZ25wQHRlcmFib3gudm4+wsB1BBABCAAfBQJb7lH4\r\nBgsJBwgDAgQVCAoCAxYCAQIZAQIbAwIeAQAKCRDXodHgyo+aNvq8B/9cPVIf\r\n0Y7qgt1UnIK5XU1ebeVv/NRAXv6hu6xtEcEBsCyTmS51P2PeO0CRPBRnYlFT\r\neyUjrb2XZwpd39yIwOU9kK+bg16lp23QI+Ul8tkUYEagXYU8y+2EQqs/8gZN\r\nvxIK9axs/ddjxhfFUA4HX/c4TYNnz+0KS5anxm5AoNqn9im9lEulIY+E7pY9\r\nJIFsJZpRVNZOA1jsbCwQLwkK6/AT463YIhACImaFU3iXha1bLAU4wDmhqee3\r\nunq7EUc+yDYf8QDQF1TSMcHSNrZY2fyWohU/5J8UCs6BSo324I0C0RT+XPMj\r\n/K4dKMk73weY8bOkTub6MTKLw/8mQsvLnYYmzsBNBFvuUfgBCAC++0axJbnf\r\nM6rm9N0QM+sWtcuuKk2Z+20/nB8cgIEcB3/Hcro7D3k0IAxIupahQAyArcoP\r\nma4+9wqnxJJcZY9jhxVRuxxBCK4cVJuz30J47qiaJdd/qA90W3h606PyCMFX\r\n3il8IPq58Ec91DKcj/56uymfiutOqUSEwpw93rUZgfkVe3D0KogEEgoqQBug\r\n8Tb+E5lUNJe8XNqUhLeMsDjizj0JrbbT4tx52dn0tezUJ2kwyQkUscxn03dx\r\nu1X+Egs5BpGhG9t2ufc3UwJ6zNR0P3X3shJc0o2ThKunfeSxQSt1dZiVzp24\r\n6d1O+8AU7NQDBQqil6k/SROQN2+ZPwpJABEBAAHCwF8EGAEIAAkFAlvuUfgC\r\nGwwACgkQ16HR4MqPmjZavQf/ZELvlh0IwSzxtjUtDyoA7wpI2GK/gyTuc4CH\r\nPYH3sxWmgR8ZBiGxxeHdSbaQAmYNWS2Mj3J3graP5WgDVrRr+YnLMOr8d8FZ\r\nicAwpx9Q/uXRhqE3ice6FIShG7JF7KnHPYWrCo94j4PCbtHoVmE1oHIvJvyK\r\nCCvzt7/uvLZ5q69SJ2fQimNiZSEFILWEc4CVbd0o8M1Po/oHIuoDJS+TzmQd\r\nysYnrYugG5xqA8g17rKADlscPV59ffUweQxlG1MqD+5zAIJ/qy5jr4gwMlTx\r\n1Y8+ThfO4mOIRJWl4KAu9c/crQh4Bphh1jaWfvvGs8nfZVCUCCIavzT7Bsjg\r\nf2F5Gw==\r\n=ujeF\r\n-----END PGP PUBLIC KEY BLOCK-----\r\n'
    const revocationCertificate1 = "-----BEGIN PGP PUBLIC KEY BLOCK-----\r\nVersion: OpenPGP.js v4.2.1\r\nComment: https://openpgpjs.org\r\nComment: This is a revocation certificate\r\n\r\nwsBfBCABCAAJBQJb7lH4Ah0AAAoJENeh0eDKj5o2FWkH/iFGn8xeqOw1govM\r\nGqYtRBlUUhGmXNvd0YBs8T3TeJuFLKb+qj6/lWUf3wFCQZcMoKF/sdFuZY21\r\nZF7zJ3WeX7zF5PVHpD9M86n6g2bFsOU5UuZtCuI9fm14idoLYpAS+0pOigVm\r\nrzAqZ1osin30/a8v6ZwiSDEFiTKMTUtUsUEwfvdc62t37UPQgmXyQf8IDmrB\r\nd2nJP0JNN+wC4AQqUkKOtqxTgQ8juLSbjvwC92X5Dw52ayMxVFDWELua3lwf\r\nCHMZasIsBMQC0qRdzwf5+nPZ1fVSuzqoKL/7upmTpcEH9YKyPD5WkXhJmYj5\r\nfxzKZchZTghZ6PDoPpn94KM8F1w=\r\n=9a4j\r\n-----END PGP PUBLIC KEY BLOCK-----\r\n"
    let passphrase = "npc.Imahacker#135" //what the privKey is encrypted with

    

    var SnippetTest = function() {
        var handleSubmit = function () {
            $('#test1').click(function(){
                console.log('set PGP');
                alert('PGP cũ sẽ bị mất.')
                var data = {
                    'privateKeyArmored': privkey1,
                    'publicKeyArmored' : pubkey1,
                    'revocationCertificate': revocationCertificate1
                }
                document.dispatchEvent(new CustomEvent('setUserPGPEvent', {detail: data}));
            });

                // Get PGP keys automatically 
            $('#test2').click(function(){
                document.addEventListener('getUserPGPEvent', function (event) {
                    pgp_key= event.detail;
                    
                    privkey = pgp_key.privateKeyArmored;
                    pubkey = pgp_key.publicKeyArmored;
                    console.log(pgp_key);
                });
                document.dispatchEvent(new CustomEvent('letgetUserPGPEvent', {detail: ""}));         
            });
            $('#test3').click(function(){
                document.addEventListener('getUserPassphraseEvent', function (event) {
                    passphrase= event.detail;
                    console.log(passphrase);
                });
                document.dispatchEvent(new CustomEvent('letgetUserPassphraseEvent', {detail: ""}));         
            });



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
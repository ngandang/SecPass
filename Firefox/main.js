window.onload = function()
{
	// function dw(data) {
	// 	document.getElementById("result").innerHTML=data;
	// }

	browser.storage.local.get('user_email', function(data){
		console.log(data);
		document.getElementById("userEmail").innerText = data.user_email;
	});

	document.getElementById('backup').onclick = function()
	{
		browser.storage.local.get('user_pgp', function(data){
			if (!data.user_pgp){
				alert("Không có dữ liệu PGP của người dùng");
				return;
			}
			
			var zip = new JSZip();

			// Add an top-level, arbitrary text file with contents
			zip.file("readme.md", "Private key is still encrypted by your passphrase.\nSave it securely !!\n");
			zip.file("public.asc", data.user_pgp.publicKeyArmored);
			zip.file("private.asc", data.user_pgp.privateKeyArmored);

			// Generate the zip file asynchronously
			zip.generateAsync({type:"blob"})
			.then(function(content) {
				// Force down of the Zip file
				saveAs(content, "recovery.zip");
			});
		});
	}

	document.getElementById('restore').onclick = function()
	{
		window.location = "pgp-recovery.html";
	}

	// document.getElementById('get').onclick = function()
	// {
	// 	browser.storage.local.get('user_pgp', function(data){
	// 		dw(data.user_pgp.privateKeyArmored+"\r\n"+data.user_pgp.publicKeyArmored);
	// 	});
	// }

	document.getElementById('passGen').onclick = function()
	{
		window.location = "password-generator.html"
	}

	document.getElementById('goPage').onclick = function()
	{
		var newURL = "https://secpass.terabox.vn/dashboard";
		browser.tabs.create({ url: newURL });
		
	}

}
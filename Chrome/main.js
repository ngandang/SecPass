window.onload = function()
{
	function dw(data) {
		document.getElementById("result").innerHTML=data;
	}

	document.getElementById('backup').onclick = function()
	{
		chrome.storage.local.get('user_pgp', function(data){
			if (!data.user_pgp){
				alert("Không có dữ liệu PGP của người dùng");
				return;
			}
			
			var zip = new JSZip();

			// Add an top-level, arbitrary text file with contents
			zip.file("read.me", "Private key is still encrypted by your passphrase.\nSave it securely !!\n");
			zip.file("public.txt", data.user_pgp.publicKeyArmored);
			zip.file("private.asc", data.user_pgp.privateKeyArmored);

			// Generate the zip file asynchronously
			zip.generateAsync({type:"blob"})
			.then(function(content) {
				// Force down of the Zip file
				saveAs(content, "recovery.zip");
			});
		});
	}

	document.getElementById('get').onclick = function()
	{
		chrome.storage.local.get('user_pgp', function(data){
			dw(data.user_pgp.privateKeyArmored+"\r\n"+data.user_pgp.publicKeyArmored);
		});
	}

	document.getElementById('passGen').onclick = function()
	{
		window.location = "password-generator.html"
	}

	document.getElementById('goPage').onclick = function()
	{
			var newURL = "http://localhost:8080/SecPass/public/dashboard";
			chrome.tabs.create({ url: newURL });
		
	}
}
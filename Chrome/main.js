window.onload = function()
{
	function dw(data) {
		document.getElementById("result").innerHTML=data;
	}

	document.getElementById('backup').onclick = function()
	{
		// chrome.storage.local.get('user_pgp', function(data){
		// 	data.user_pgp.privateKeyArmored;
		// });
		let csvContent = "data:text/txt;charset=utf-8,";
		 csvContent += "SecPass";
		
		// var encodedUri = encodeURI(csvContent);
		// window.open(encodedUri);

		var encodedUri = encodeURI(csvContent);
		var link = document.createElement("a");
		link.setAttribute("href", encodedUri);
		link.setAttribute("download", "my_data.txt");
		document.body.appendChild(link); // Required for FF

		link.click(); 
	};
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
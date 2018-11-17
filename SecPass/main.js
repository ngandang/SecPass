window.onload = function()
{
	document.getElementById('save').onclick = function()
	{
		var value = document.getElementById('saveLine').value;
		//alert(value);

		chrome.storage.local.set({'myLine':value}, function(){
			alert('success!');
		});
	};
	document.getElementById('get').onclick = function()
	{
		chrome.storage.local.get('myLine', function(data){
			alert(data.myLine);
		});
	}
	document.getElementById('goPage').onclick = function()
	{
			var newURL = "http://localhost:8080/SecPass/public/dashboard";
			chrome.tabs.create({ url: newURL });
		
	}

}
(function(){

	var valuein = document.getElementById('value-in'),
		valuein = document.getElementById('value-in'),
		form =document.querySelector('form');

	function valueChanged(newValue){
		valueOut.innerText = newValue;
	}
	form.addEventListener('submit',function(evt){
		console.log('1');
		var value = valuein.value;
		evt.preventDefault();

		chrome.storage.sync.set({
			myValue: value,
			timestamp:Date.now()
		}, function(){
			console.log("Value set:"+ value);
		});
	});

	chrome.storage.onChanged.addListener(function(changes, namespace){
		if(changes.myValue){
			valueChanged(changes.myValue.newValue);
		}
	});
	chrome.storage.sync.get("myValue",function(result){
		valueChanged(result.myValue);
	});

})();

// var a=0;
// function count() {
//     a++;
//     console.log(a);
//     document.getElementById('demo').textContent = a;
// }
// document.getElementById('do-count').onclick = count;
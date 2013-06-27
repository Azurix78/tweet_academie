document.getElementById('bloc-connect').style.display = 'none';
document.getElementById('logo-connect').style.marginTop = '350px';
setTimeout(function(){
	document.getElementById('logo-connect').style.marginTop = '40px';
	document.getElementById('logo-connect').style.WebkitTransition = 'margin-top 1.5s';
	document.getElementById('logo-connect').style.MozTransition = 'margin-top 1.5s';
	document.getElementById('logo-connect').style.transitionDuration = '1.5s';
	setTimeout(function(){
	document.getElementById('bloc-connect').style.display = 'block';},1000);
},500);



function scrolTop() // revenir en haut de la page
{
	window.document.scrollTop = 0;
}

function nbcharTweet() // Nombre de caractères restants
    {
    maximum = 140;
    champ = document.getElementById('tweet-area').value; 
    indic = document.getElementById('nbcaract').innerHTML;


    if (champ.length > maximum)
    {
    	document.getElementById('max').style.display = "block";
    	document.getElementById('tweet-area').value = champ.substr(0, maximum);
    	
  	}
    else 
    {
    	document.getElementById('max').style.display = "none";
    	document.getElementById('nbcaract').innerHTML = maximum - champ.length;
    }
}

    function newTweet() // Popup pour écrire un tweet
			{
				document.getElementById('tweet-new').style.opacity = 0;
				document.getElementById("tweet-new").style.display = "block";
				for(var i = 0; i < 11; i++)
				{
					window.setInterval(function(){document.getElementById("tweet-new").style.opacity = i / 10} ,i * 1000);
				}
				document.body.style.overflow = "hidden";
			}

			function closeTweet()
			{
				document.getElementById("tweet-new").style.display = "none";
				document.body.style.overflow = "visible";
			}

			// Cacher la div si on clique en dehors - Popup tweet
			$(document).mouseup(function (e){
   			 var container = $("#tweet-new");
   			 var container2 = $("#contain-tweetnew");
    		if (container2.has(e.target).length === 0)
     		   container.hide();
     			$('html, body').css('overflow', 'visible');
			});
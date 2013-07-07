
/*###############
#####RICKY#######
################*/

function tweet_rep(id)
{
  if ( document.getElementById(id+'rep').style.display == "block")
  {
    document.getElementById(id+'rep').style.display = "none";
    if(document.getElementById(id+'ans'))
    { 
      document.getElementById(id+'ans').style.display = "none";
    }
  }
  else
  {
    document.getElementById(id+'text').focus();
    document.getElementById(id+'rep').style.display = "block";
    if(document.getElementById(id+'ans'))
    { 
      document.getElementById(id+'ans').style.display = "block";
    }
  }
}

function scrolTop() // revenir en haut de la page
{
	window.document.scrollTop = 0;
}


function nbcharTweet(area,compteur,max) // Nombre de caractères restants
    {
    maximum = 140;
    champ = document.getElementById(area).value; 
    indic = document.getElementById(compteur).innerHTML;



    if (champ.length > maximum)
    {

    	document.getElementById(max).style.display = "block";
    	document.getElementById(area).value = champ.substr(0, maximum);
    	
  	}
    else 
    {

    	document.getElementById(max).style.display = "none";
    	document.getElementById(compteur).innerHTML = maximum - champ.length;
    }
}

    function displayBloc(bloc) // Popup pour écrire un tweet
			{
				document.getElementById(bloc).style.opacity = 0;
				document.getElementById(bloc).style.display = "block";
				for(var i = 0; i < 11; i++)
				{
					window.setInterval(function(){document.getElementById(bloc).style.opacity = i / 10} ,i * 1000);
				}
				document.body.style.overflow = "hidden";
			}

			function closeBloc(bloc)
			{
				document.getElementById(bloc).style.display = "none";
				document.body.style.overflow = "visible";
			}


      function boutons(url)
      {
                var loc = window.location;
                window.location = loc + "&idmsg=" + url;
      }

      function colorInput(color,input)
      {
        document.getElementById(input).value = color;
        if(color != '')
        {
          document.getElementById(input).style.backgroundColor = color;
        }
        else
        {
          document.getElementById(input).style.backgroundColor = "white";
        }
        if(color == "000000" || color == "824500" || color == "009DB5" || color == "7004DB")
        {
          document.getElementById(input).style.color = "white";
        }
        else
        {
          document.getElementById(input).style.color = "black";
        }

      }


var global_genre="all";
var global_platform="all";
var global_page;
var global_idGame;

function getDetailGame(idGame)
{
	global_idGame = idGame;
	var xhttp = new XMLHttpRequest();
	  xhttp.onreadystatechange = function() {
	    if (xhttp.readyState == 4 && xhttp.status == 200) {
	    
	     document.getElementById("detailGame").style.display = "";
	     document.getElementById("detailGame").innerHTML = xhttp.responseText;
	     document.getElementById("mainSection").style.display = "none";
	
	     var i = 0 , prec;
	     var j = 0 , prec1;
	     var degs = $("#prec").attr("class").split(' ')[1];
	     var degs1 = $("#prec1").attr("class").split(' ')[1];
	     var activeBorder = $("#activeBorder");
	     var activeBorder1 = $("#activeBorder1");
	     setTimeout(function(){
	         loopit("c");
	         
	     },1);
	     
	     setTimeout(function(){
	         loopit1("c");
	         
	     },1);

	  function loopit(dir){
	      if (dir == "c")
	          i++
	      else
	          i--;
	      if (i < 0)
	          i = 0;
	      if (i > degs)
	          i = degs;
	      prec = (100*i)/3600;   
	      $("#prec").html(parseFloat(prec).toFixed(1));
	      
	      if (i<180){
	          activeBorder.css('background-image','linear-gradient(' + (90+i) + 'deg, transparent 50%, #A2ECFB 50%),linear-gradient(90deg, #A2ECFB 50%, transparent 50%)');
	      }
	      else{
	          activeBorder.css('background-image','linear-gradient(' + (i-90) + 'deg, transparent 50%, #39B4CC 50%),linear-gradient(90deg, #A2ECFB 50%, transparent 50%)');
	      }
	      
	      
	      setTimeout(function(){
	              loopit("c");
	      },1);
	      
	      
	      
	  }
	  
	  function loopit1(dir){
	      if (dir == "c")
	          j++
	      else
	          j--;
	      if (j < 0)
	          j = 0;
	      if (j > degs1)
	          j = degs1;
	      prec1 = (100*j)/3600;   
	      $("#prec1").html(parseFloat(prec1).toFixed(1));
	     
	      if (j<180){
	          activeBorder1.css('background-image','linear-gradient(' + (90+j) + 'deg, transparent 50%, #A2ECFB 50%),linear-gradient(90deg, #A2ECFB 50%, transparent 50%)');
	      }
	      else{
	          activeBorder1.css('background-image','linear-gradient(' + (j-90) + 'deg, transparent 50%, #39B4CC 50%),linear-gradient(90deg, #A2ECFB 50%, transparent 50%)');
	      }
	      
	      
	      setTimeout(function(){
	              loopit1("c");
	      },1);
	      
	      
	      
	  }
	  
	  
	  //chiamata ajax per mediator
	  var xhttp2 = new XMLHttpRequest();
	  xhttp2.onreadystatechange = function() {
	    if (xhttp2.readyState == 4 && xhttp2.status == 200) {
	     document.getElementById("comparaPrezzi").innerHTML = xhttp2.responseText;
	    		}
	  		};
	  		
	  xhttp2.open("GET", "getPrezzi.php?id="+global_idGame, true);
	  xhttp2.send();
	    }
	  };
	  
	  xhttp.open("GET", "getDetail.php?id="+idGame, true);
	  xhttp.send();
}

function getFilteredGames(genre,platform,page)
{
	if(genre!="")
		global_genre=genre;
	if(platform!="")
		global_platform=platform;
	var xhttp = new XMLHttpRequest();
	  
	  xhttp.onreadystatechange = function() {
		    if (xhttp.readyState == 4 && xhttp.status == 200) {
		     document.getElementById("elencoGiochi").innerHTML = xhttp.responseText;
		    }
	  }
	  xhttp.open("GET", "getFilteredGames.php?genre="+global_genre+"&platform="+global_platform, true);
	  xhttp.send();
}

function hideDetail()
{
    document.getElementById("mainSection").style.display = "";
    document.getElementById("detailGame").style.display = "none";


}

function getGame(nameGame)
{
//	var xhttp = new XMLHttpRequest();
//	  
//	  xhttp.onreadystatechange = function() {
//		    if (xhttp.readyState == 4 && xhttp.status == 200) {
//		    	document.getElementById("detailGame").style.display = "";
//		    	 document.getElementById("detailGame").innerHTML = xhttp.responseText;
//			     document.getElementById("mainSection").style.display = "none";
//		    }
//	  }
//	  xhttp.open("GET", "getGame.php?name="+nameGame, true);
//	  xhttp.send();
	var xhttp = new XMLHttpRequest();
	  xhttp.onreadystatechange = function() {
	    if (xhttp.readyState == 4 && xhttp.status == 200) {
	    
	     document.getElementById("detailGame").style.display = "";
	     document.getElementById("detailGame").innerHTML = xhttp.responseText;
	     document.getElementById("mainSection").style.display = "none";
	
	     var i = 0 , prec;
	     var j = 0 , prec1;
	     var degs = $("#prec").attr("class").split(' ')[1];
	     var degs1 = $("#prec1").attr("class").split(' ')[1];
	     var activeBorder = $("#activeBorder");
	     var activeBorder1 = $("#activeBorder1");
	     setTimeout(function(){
	         loopit("c");
	         
	     },1);
	     
	     setTimeout(function(){
	         loopit1("c");
	         
	     },1);

	  function loopit(dir){
	      if (dir == "c")
	          i++
	      else
	          i--;
	      if (i < 0)
	          i = 0;
	      if (i > degs)
	          i = degs;
	      prec = (100*i)/3600;   
	      $("#prec").html(parseFloat(prec).toFixed(1));
	      
	      if (i<180){
	          activeBorder.css('background-image','linear-gradient(' + (90+i) + 'deg, transparent 50%, #A2ECFB 50%),linear-gradient(90deg, #A2ECFB 50%, transparent 50%)');
	      }
	      else{
	          activeBorder.css('background-image','linear-gradient(' + (i-90) + 'deg, transparent 50%, #39B4CC 50%),linear-gradient(90deg, #A2ECFB 50%, transparent 50%)');
	      }
	      
	      
	      setTimeout(function(){
	              loopit("c");
	      },1);
	      
	      
	      
	  }
	  
	  function loopit1(dir){
	      if (dir == "c")
	          j++
	      else
	          j--;
	      if (j < 0)
	          j = 0;
	      if (j > degs1)
	          j = degs1;
	      prec1 = (100*j)/3600;   
	      $("#prec1").html(parseFloat(prec1).toFixed(1));
	     
	      if (j<180){
	          activeBorder1.css('background-image','linear-gradient(' + (90+j) + 'deg, transparent 50%, #A2ECFB 50%),linear-gradient(90deg, #A2ECFB 50%, transparent 50%)');
	      }
	      else{
	          activeBorder1.css('background-image','linear-gradient(' + (j-90) + 'deg, transparent 50%, #39B4CC 50%),linear-gradient(90deg, #A2ECFB 50%, transparent 50%)');
	      }
	      
	      
	      setTimeout(function(){
	              loopit1("c");
	      },1);
	      
	      
	      
	  }
	  
	  
	  //chiamata ajax per mediator
	  var xhttp2 = new XMLHttpRequest();
	  xhttp2.onreadystatechange = function() {
	    if (xhttp2.readyState == 4 && xhttp2.status == 200) {
	     document.getElementById("comparaPrezzi").innerHTML = xhttp2.responseText;
	    		}
	  		};
	  var idGame = document.getElementById("idGame").innerHTML;
	  alert(idGame);
	  xhttp2.open("GET", "getPrezzi.php?id="+idGame, true);
	  xhttp2.send();
	    }
	  };
	  
	  xhttp.open("GET", "getGame.php?name="+nameGame, true);
	  xhttp.send();
}
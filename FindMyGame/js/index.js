var global_genre="all";
var global_platform="all";
var global_elem_genre=null;
var global_elem_platform=null;
var global_page;
var global_idGame;
var global_timeout1;
var global_timeout2;
var global_timeout3;
var global_timeout4;


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
	     global_timeout1=setTimeout(function(){
	         loopit("c");
	         
	     },1);
	     
	   
	     
	     global_timeout2=setTimeout(function(){
	         loopit1("c");
	         
	     },1);

	    
	     
	  function loopit(dir){
	      if (dir == "c")
	          i++
	      else
	          i--;
	      if (i < 0)
	          i = 0;
	      if (i >= degs)
	      {
	    	  i = degs;
	    	  clearTimeout(global_timeout3);
	    	  prec = (100*i)/3600;   
		      $("#prec").html(parseFloat(prec).toFixed(1));
	    	  return;
	      }
	          
	      prec = (100*i)/3600;   
		    
	      $("#prec").html(parseFloat(prec).toFixed(1));
	      
	      if (i<180){
	          activeBorder.css('background-image','linear-gradient(' + (90+i) + 'deg, transparent 50%, #A2ECFB 50%),linear-gradient(90deg, #A2ECFB 50%, transparent 50%)');
	      }
	      else{
	          activeBorder.css('background-image','linear-gradient(' + (i-90) + 'deg, transparent 50%, #39B4CC 50%),linear-gradient(90deg, #A2ECFB 50%, transparent 50%)');
	      }
	      
	      
	      global_timeout3=setTimeout(function(){
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
	      if (j >= degs1)
	      {
	    	  j = degs1;
	    	  prec1 = (100*j)/3600;   
		      $("#prec1").html(parseFloat(prec1).toFixed(1));
	    	  clearTimeout(global_timeout4);
	    	  return;
	      }
	          
	      prec1 = (100*j)/3600;   
	      $("#prec1").html(parseFloat(prec1).toFixed(1));
	     
	      if (j<180){
	          activeBorder1.css('background-image','linear-gradient(' + (90+j) + 'deg, transparent 50%, #A2ECFB 50%),linear-gradient(90deg, #A2ECFB 50%, transparent 50%)');
	      }
	      else{
	          activeBorder1.css('background-image','linear-gradient(' + (j-90) + 'deg, transparent 50%, #39B4CC 50%),linear-gradient(90deg, #A2ECFB 50%, transparent 50%)');
	      }
	      
	      
	      global_timeout4=setTimeout(function(){
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

function getFilteredGames(elem,genre,platform,page,shift)
{
	
	if(elem!=null){
	page=1;	
	$('#accordian a').removeClass("cocc");
	$('#accordian1 a').removeClass("cocc1");
	
		if(genre!=""){
			global_genre=genre;
			global_elem_genre=elem;
			
		}
		if(platform!=""){
			global_platform=platform;
			global_elem_platform=elem;
			
		}
		
		  if(global_elem_genre!=null)
		  global_elem_genre.classList.add("cocc");
		  if(global_elem_platform!=null)
		  global_elem_platform.classList.add("cocc1");
	  }
	
	 var str="";
     //page=1;
     //pag=1;
		if(shift===undefined)
	       shift=1;
	    //if(page!==undefined)
	       pag=page;
	       page=shift;
	    if(page>5)
	    str+= "<li><a href=\"\" onclick=\"getFilteredGames(null,'','',"+(page-5)+","+(page-5)+");return false;\">&laquo;</a></li>";
	    for (i = 0; i < 5; i++) {
	    	if(pag==(page+i))
	    		str+= "<li  class=\"active\"><a href=\"\" onclick=\"getFilteredGames(null,'','',"+(page+i)+","+(page)+");return false;\">"+(page+i)+"</a></li>";
	    	else
	    		str+= "<li><a href=\"\" onclick=\"getFilteredGames(null,'','',"+(page+i)+","+(page)+");return false;\">"+(page+i)+"</a></li>";
	    }	
	    str+= "<li><a href=\"\" onclick=\"getFilteredGames(null,'','',"+(page+5)+","+(page+5)+");return false;\">&raquo;</a></li>";
	
	    var str1="";
	     //page=1;
	     //pag=1;
			//if(shift!==undefined)
		       
		    //if(page!==undefined)
		    if(page>5)
		    str1+= "<li><a href=\"\" onclick=\"getFilteredGames(null,'','',"+(page-5)+","+(page-5)+");return false;\">&laquo;</a></li>";
		    for (i = 0; i < 5; i++) {
		    	if(pag==(page+i)){
		    		str1+= "<li  class=\"active\"><a href=\"\" onclick=\"getFilteredGames(null,'','',"+(page+i)+","+(page)+");return false;\">"+(page+i)+"</a></li>";
		    		break;
		    	}else
		    		str1+= "<li><a href=\"\" onclick=\"getFilteredGames(null,'','',"+(page+i)+","+(page)+");return false;\">"+(page+i)+"</a></li>";
		    }
		    
		var xhttp = new XMLHttpRequest();
		  
		  xhttp.onreadystatechange = function() {
			    if (xhttp.readyState == 4 && xhttp.status == 200) {
			     document.getElementById("elencoGiochi").innerHTML = xhttp.responseText;
			     
			    if(xhttp.responseText=="0 results")
				    str=str1;
				    document.getElementById("paginator").innerHTML = str;
			    }
		  }
	  
	 // alert("getFilteredGames.php?genre="+global_genre+"&platform="+global_platform+"&page="+page+"&shift="+shift);
	  xhttp.open("GET", "getFilteredGames.php?genre="+global_genre+"&platform="+global_platform+"&page="+pag+"&shift="+shift, true);
	  xhttp.send();
}

function hideDetail()
{
    //document.getElementById("mainSection").style.display = "";
   // document.getElementById("detailGame").style.display = "none";
	location.reload();
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
	
	var opts = {
			  lines: 11 // The number of lines to draw
			, length: 40 // The length of each line
			, width: 20 // The line thickness
			, radius: 53 // The radius of the inner circle
			, scale: 0.75 // Scales overall size of the spinner
			, corners: 0.9 // Corner roundness (0..1)
			, color: '#000' // #rgb or #rrggbb or array of colors
			, opacity: 0.15 // Opacity of the lines
			, rotate: 0 // The rotation offset
			, direction: 1 // 1: clockwise, -1: counterclockwise
			, speed: 0.6 // Rounds per second
			, trail: 79 // Afterglow percentage
			, fps: 20 // Frames per second when using setTimeout() as a fallback for CSS
			, zIndex: 2e9 // The z-index (defaults to 2000000000)
			, className: 'spinner' // The CSS class to assign to the spinner
			, top: '50%' // Top position relative to parent
			, left: '50%' // Left position relative to parent
			, shadow: false // Whether to render a shadow
			, hwaccel: false // Whether to use hardware acceleration
			, position: 'absolute' // Element positioning
			}
			var target = document.getElementById('dark_cover');
			var spinner = new Spinner(opts).spin(target);
    document.getElementById("dark_cover").style.display = "";

	var xhttp = new XMLHttpRequest();
	  xhttp.onreadystatechange = function() {
	    if (xhttp.readyState == 4 && xhttp.status == 200) {
	    
	     if(xhttp.responseText == "")
	     {
	    	 alert("Gioco non trovato!");
		     document.getElementById("dark_cover").style.display = "none";
	    	 return;
	     }
	     if(xhttp.responseText == "errore")
	     {
	    	 alert("Non siamo riusciti a recuperare il tuo gioco, riprova più tardi!");
		     document.getElementById("dark_cover").style.display = "none";
	    	 return;
	     }
	     document.getElementById("detailGame").style.display = "";
	     document.getElementById("detailGame").innerHTML = xhttp.responseText;
	     document.getElementById("mainSection").style.display = "none";
	
	     document.getElementById("dark_cover").style.display = "none";
	   
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
	      if (i >= degs)
	      {
	    	  i = degs;
	    	  prec = (100*i)/3600;   
		      $("#prec").html(parseFloat(prec).toFixed(1));
	    	  clearTimeout(global_timeout3);
	    	  return;
	      }
	      prec = (100*i)/3600;   
	      $("#prec").html(parseFloat(prec).toFixed(1));
	      
	      if (i<180){
	          activeBorder.css('background-image','linear-gradient(' + (90+i) + 'deg, transparent 50%, #A2ECFB 50%),linear-gradient(90deg, #A2ECFB 50%, transparent 50%)');
	      }
	      else{
	          activeBorder.css('background-image','linear-gradient(' + (i-90) + 'deg, transparent 50%, #39B4CC 50%),linear-gradient(90deg, #A2ECFB 50%, transparent 50%)');
	      }
	      
	      
	      global_timeout3=setTimeout(function(){
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
	      if (j >= degs1)
	      {
	    	  j = degs1;
	    	  prec1 = (100*j)/3600;   
		      $("#prec1").html(parseFloat(prec1).toFixed(1));
	    	  clearTimeout(global_timeout4);
	    	  return;
	      }
	    
	     
	      if (j<180){
	          activeBorder1.css('background-image','linear-gradient(' + (90+j) + 'deg, transparent 50%, #A2ECFB 50%),linear-gradient(90deg, #A2ECFB 50%, transparent 50%)');
	      }
	      else{
	          activeBorder1.css('background-image','linear-gradient(' + (j-90) + 'deg, transparent 50%, #39B4CC 50%),linear-gradient(90deg, #A2ECFB 50%, transparent 50%)');
	      }
	      
	      
	      global_timeout4=setTimeout(function(){
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
	  xhttp2.open("GET", "getPrezzi.php?id="+idGame, true);
	  xhttp2.send();
	    }
	  };
	  
	  xhttp.open("GET", "getGame.php?name="+nameGame, true);
	  xhttp.send();
}

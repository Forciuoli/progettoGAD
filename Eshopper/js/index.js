
function getDetailGame(idGame)
{
	var xhttp = new XMLHttpRequest();
	  xhttp.onreadystatechange = function() {
	    if (xhttp.readyState == 4 && xhttp.status == 200) {
	     document.getElementById("detailGame").innerHTML = xhttp.responseText;
	     document.getElementById("mainSection").style.display = "none";
	     //cocc();
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
	  
	    }
	  };
	  xhttp.open("GET", "getDetail.php?id="+idGame, true);
	  xhttp.send();
}




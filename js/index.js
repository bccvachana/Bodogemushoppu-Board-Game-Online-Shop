window.onload = pageLoad;

function getParams() {
  	var idx = document.URL.indexOf('?');
  	var params = new Array();
  	if (idx != -1) {
  		var pairs = document.URL.substring(idx+1, document.URL.length).split('&');
  		for (var i=0; i<pairs.length; i++) {
  			nameVal = pairs[i].split('=');
  			params[nameVal[0]] = nameVal[1];
  		}
 	}
  	return params;
 }

 function pageLoad(){
	var para = getParams();
	if(Object.keys(para).length >0){
		if (para["register"]==1){
			$("#signin_modal").modal('show');
		}
		if (para["error"]==1){
			document.getElementById('errordisplay').innerHTML = "Incorrect Username or Password";
			$("#signin_modal").modal('show');
		}
	}
}
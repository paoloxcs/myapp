function lconverter() {
		var nro1 = document.getElementById('longitud').value;
		var select = document.getElementById('length').value;
		var result = 0;
		if(select==1){
			result = `${(nro1 * 25.4).toFixed(1)} mm`;
		}
		else if(select==2){
			result = `${(nro1 / 25.4).toFixed(1)} mm`;
		}
		else if(select==3){
			result = `${(nro1 * 1000).toFixed(1)} m`;
		}
		else if(select==4){
			result = `${(nro1 / 304.8).toFixed(8)} ft`;
		}
		else if(select==5){
			result = `${(nro1 * 1000).toFixed(2)} μm`; 
		}
		// if (select==1){
		// 	result = `${(nro1 * 25.4).toFixed(1)} mm`;			
		// }else{
		// 	result = `${(nro1 / 25.4).toFixed(3)} "`;
		// }
		document.getElementById('lresult').innerText='= ' + result;
		//console.log(result);
	}

	function sconverter() {
		var nro1 = document.getElementById('velocidad').value;
		var select = document.getElementById('speed').value;
		var result = 0;
		if (select==1){			
			result = `${(nro1 / 3.28084).toFixed(2)} m/seg`;
		}else{
			result = `${(nro1 * 3.28084).toFixed(2)} ft/seg`;
		}
		document.getElementById('sresult').innerText='= ' + result;
		//console.log(result);
	}

	function tconverter() {
		var nro1 = document.getElementById('temperatura').value;
		var select = document.getElementById('temp').value;
		var result = 0;
		if (select==1){			
			result = `${((nro1 / 1.8)/32).toFixed(1)} °F`;
		}else{
			result = `${((nro1 * 1.8)+32).toFixed(1)} °C`;
		}
		document.getElementById('tresult').innerText='= ' + result;
		//console.log(result);
	}

function pconverter() {
	var nro1 = document.getElementById('presion').value;
	var select = document.getElementById('pressure').value;
	var select2 = document.getElementById('pressure2').value;
	var result = 0;
	if (select==1 && select2==1){
		result = `${(nro1 * 1).toFixed(0)}`;
	}else if(select==1 && select2==2){
		result = `${(nro1 / 0.06895).toFixed(2)}`;
	}else if(select==1 && select2==3){
		result = `${(nro1 / 10).toFixed(2)}`;
	}else if(select==1 && select2==4){
		result = `${(nro1 * 100).toFixed(2)}`;
	}else if(select==2 && select2==1){
		result = `${(nro1 * 0.06895).toFixed(2)}`;
	}else if(select==2 && select2==2){
		result = `${(nro1 * 1).toFixed(0)}`;
	}else if(select==2 && select2==3){
		result = `${(nro1 * 0.00689476).toFixed(2)}`;
	}else if(select==2 && select2==4){
		result = `${(nro1 * 6.8948).toFixed(2)}`;
	}else if(select==3 && select2==1){
		result = `${(nro1 * 10).toFixed(1)}`;
	}else if(select==3 && select2==2){
		result = `${(nro1 / 0.00689476).toFixed(1)}`;
	}else if(select==3 && select2==3){
		result = `${(nro1 * 1).toFixed(0)}`;
	}else if(select==3 && select2==4){
		result = `${(nro1 * 1000).toFixed(0)}`;
	}else if(select==4 && select2==1){
		result = `${(nro1 / 100).toFixed(4)}`;
	}else if(select==4 && select2==2){
		result = `${(nro1 / 6.8948).toFixed(4)}`;
	}else if(select==4 && select2==3){
		result = `${(nro1 / 1000).toFixed(4)}`;
	}else if(select==4 && select2==4){
		result = `${(nro1 * 1).toFixed(0)}`;
	}
	document.getElementById('presult').innerText='= ' + result;
	console.log(result);
}
function permitir(elEvento, permitidos) {
    // Variables que definen los caracteres permitidos
        var numeros = "0123456789";
        var caracteres = "abcdefghijklmnñopqrstuvwxyzABCDEFGHIJKLMNÑOPQRSTUVWXYZ";
		var noCaracteresEspeciales = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ"
        var numeros_caracteres = numeros + caracteres;
        var teclas_especiales = [8, 9,127,17,18,19,20,37,38,39,40];  
        var correo = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ@_.-0123456789";
        var direccion=" abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ.,-#0123456789º";
		var dirPasarela=" abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ.,-0123456789";
        var pass="abcdefghijklmnñopqrstuvwxyzABCDEFGHIJKLMNÑOPQRSTUVWXYZ0123456789"
		var space=" ";
        switch(permitidos) {
            case 'num':
            permitidos = numeros;
            break;
            case 'car':
            permitidos = caracteres + " ";
            break;
            case 'num_car':
            permitidos = numeros_caracteres;
            break;
            case 'e-mail':
            permitidos = correo;
            break;
            case 'direccion':
            permitidos = direccion;
            break;
            case 'pass':
            permitidos = pass;
            break;
			case 'num_carSsp':
            permitidos = numeros_caracteres + " ";
            break;
            case 'car_Nsp':
            permitidos = caracteres ;
            break;
            case 'nan':
            return false;
            break;
			case 'noCarEsp':
            permitidos = noCaracteresEspeciales + space;
            break;
			case 'noCarEsp_Nsp':
            permitidos = noCaracteresEspeciales;
            break;
			case 'noCarEsp_Dir':
            permitidos = dirPasarela;
            break;
          }

        var evento = elEvento || window.event;
        var codigoCaracter = evento.charCode || evento.keyCode;
        var caracter = String.fromCharCode(codigoCaracter);

        var tecla_especial = false;
        for(var i in teclas_especiales) {
            if(codigoCaracter == teclas_especiales[i]) {
            tecla_especial = true;
            break;
        }
        }
        return permitidos.indexOf(caracter) != -1 || tecla_especial;
        }
function keyAlloy(){
    $('.num').keypress(function(event){        
        return permitir(event,'num');
    });
    $('.car').keypress(function(event){        
        return permitir(event,'car');
    }); 
    $('.num_car').keypress(function(event){        
        return permitir(event,'num_car');
    }); 
    $('.e-mail').keypress(function(event){        
        return permitir(event,'e-mail');
    }); 
    $('.direccion').keypress(function(event){        
        return permitir(event,'direccion');
    }); 
    $('.pass').keypress(function(event){        
        return permitir(event,'pass');
    }); 
    $('.num_carSsp').keypress(function(event){        
        return permitir(event,'num_carSsp');
    }); 
    $('.car_Nsp').keypress(function(event){        
        return permitir(event,'car_Nsp');
    }); 
    $('.nan').keypress(function(event){        
        return permitir(event,'nan');
    }); 
	$('.noCarEsp').keypress(function(event){        
        return permitir(event,'noCarEsp');
    });
	 $('.noCarEsp_Nsp').keypress(function(event){        
        return permitir(event,'noCarEsp_Nsp');
    }); 
	 $('.noCarEsp_Dir').keypress(function(event){        
        return permitir(event,'noCarEsp_Dir');
    });
}			
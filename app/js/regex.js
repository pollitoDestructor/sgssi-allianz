function validarFormulario() {
            const nombre = document.getElementById("nombre").value.trim();
            const apellidos = document.getElementById("apellidos").value.trim();
            const dni = document.getElementById("dni").value.trim();
            const fecha_nac = document.getElementById("fecha_nac").value;
            const telefono = document.getElementById("telefono").value.trim();
            const email = document.getElementById("email").value.trim();
            const fecha = document.getElementById("fecha").value.trim();
            const contra = document.getElementById("contra").value.trim();
		
	    // ============= Esto para verificar o validar los campos =============
            if (!nombre || !apellidos || !dni || !fecha_nac || !telefono || !email || !contra) {
                alert("Por favor, completa todos los campos.");
                return false;
            }
            
            // Regex para DNI
            const dniRegex = /^[0-9]{8}[A-Z]$/;  //Se coge cualquier digito de 0-9 8 veces y luego una letra de la A-Z
            if (!dniRegex.test(dni)) {
                alert("DNI inválido, formato incorrecto.");
                return false;
            } else {    //Si cumple el formato, se comprueba la letra
                let cadena = "TRWAGMYFPDXBNJZSQVHLCKET";
                let dniNumeros = parseInt(dni.substring(0, dni.length - 1));
                let posicion = dniNumeros % (cadena.length - 1);
                if (dni[dni.length - 1].toLowerCase() != cadena[posicion].toLowerCase()) {
                    alert("DNI inválido, la letra no coincide.");
                    return false;
                }
            }
            
	   // Regex para email
            const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;    //Coge cualquier carácter que no sea una @ 1 o mas veces, luego una @, después otra cadena de 1 o más caracteres que no sean @, un '.' y por último una última cadena de 1 o más sin @
            if (!emailRegex.test(email)) {
                alert("Correo electrónico inválido.");
                return false;
            }
            
	    // Regex para telefono
            const telefonoRegex = /^[0-9]{9}$/;        //9 digitos de 0-9
            if (!telefonoRegex.test(telefono)) {
                alert("Número de teléfono inválido (9 dígitos).");
                return false;
            }
            
        //Regex para contraseña
            const contraLengthRegex = /^.{10,}$/;           //10 caracteres o más
            if (!contraLengthRegex.test(contra)) { 
                alert("La contraseña debe tener al menos 10 caracteres.");
                return false;
            } 
            const numerosRegex = /.*\d.*/                   //Contenga al menos un número
            if (!numerosRegex.test(contra)) {
                alert("La contraseña debe contener al menos un número.");
                return false;
            }
            const caracterEspecialRegex = /.*[^a-zA-Z0-9].*/    //Contenga al menos un carácter especial
            if (!caracterEspecialRegex.test(contra)) {
                alert("La contraseña debe contener al menos un carácter especial.");
                return false;
            }
            
        // Regex para fecha
            const fechaRegex = /^[0-9]{1,2}\/[0-9]{1,2}\/[0-9]{4}$/;
            if (!fechaRegex.test(fecha)) {
                alert("Fecha inválida (formato incorrecto).");
                return false;
            } else {
                let dia = parseInt(fecha.substring(0,fecha.indexOf('/')));
                let mes = parseInt(fecha.substring(fecha.indexOf('/')+1,fecha.lastIndexOf('/')));
                let ano = parseInt(fecha.lastIndexOf('/')+1));
                const mes31 = [];
                const mes30 = [];
                mes31.push(1,3,5,7,8,10,12);
                mes30.push(4,6,9,11);
                if(mes < 1 || mes > 12){
                    alert("Fecha inválida (mes incorrecto).");
                    return false;
                }
                if(mes31.includes(mes)){
                    if(dia < 1 || dia > 31){
                        alert("Fecha inválida (día incorrecto).");
                        return false;
                    }
                } else if(mes30.includes(mes)){
                    if(dia < 1 || dia > 30){
                        alert("Fecha inválida (día incorrecto).");
                        return false;
                    }
                } else {
                    if(ano % 4 === 0 && ano % 100 !== 0){
                        if(dia < 1 || dia > 29){
                            alert("Fecha inválida (día incorrecto).");
                            return false;
                        }
                    } else {
                        if(dia < 1 || dia > 28){
                            alert("Fecha inválida (día incorrecto).");
                            return false;
                        }
                    }
                }
            }
            return true;
}

function validarModifyItem() {
            const nombre = document.getElementById("nombre").value.trim();
            const color = document.getElementById("color").value.trim();
            const estado = document.getElementById("estado").value;
            const descr = document.getElementById("descr").value.trim();
            const precio = document.querySelector("input[name='precio']").value.trim();

            // ============= Esto para verificar o validar los campos =============
            if (!nombre || !color || !estado || !descr || !precio) {
                alert("Por favor, completa todos los campos.");
                return false;
            }

            // ============= Esto para verificar el color =============
            const colorRegex = /^[A-Za-zÁÉÍÓÚáéíóúÑñ\s]+$/; //Cualquier carácter, mayúscula, minúscula o especial
            if (!colorRegex.test(color)) {
                alert("Color inválido, solo se permiten letras.");
                return false;
            }

            // ============= Esto para verificar el precio =============
            const precioNum = parseFloat(precio);
            if (isNaN(precioNum) || precioNum <= 0 || precioNum >= 999.99) {
              alert("Precio inválido, debe ser un valor positivo y menor que 999.99.");
              return false;
            }


            return true; // Correcto
}

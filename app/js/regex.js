function validarFormulario() {
            const nombre = document.getElementById("nombre").value.trim();
            const apellidos = document.getElementById("apellidos").value.trim();
            const dni = document.getElementById("dni").value.trim();
            const fecha_nac = document.getElementById("fecha_nac").value;
            const telefono = document.getElementById("telefono").value.trim();
            const email = document.getElementById("email").value.trim();
            const fecha = document.getElementById("fecha").value.trim();
		
	    // ============= Todo esto para verificar o validar los campos =============
            if (!nombre || !apellidos || !dni || !fecha_nac || !telefono || !email) {
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
            const fechaRegex = /^[0-9]{1,2}\/[0-9]{1,2}\/[0-9]{4}$/;
            if (!fechaRegex.test(tfecha)) {
                alert("Fecha inválida (formato incorrecto).");
                return false;
            } else {
                let dia = parseInt(telefono.substring(0,fecha.indexOf('/')));
            }
            return true;
}

function validarModifyItem() {
            const nombre = document.getElementById("nombre").value.trim();
            const color = document.getElementById("color").value.trim();
            const estado = document.getElementById("estado").value;
            const descr = document.getElementById("descr").value.trim();
            const precio = document.querySelector("input[name='precio']").value.trim();

            // ============= Todo esto para verificar o validar los campos =============
            if (!nombre || !color || !estado || !descr || !precio) {
                alert("Por favor, completa todos los campos.");
                return false;
            }

            // ============= Todo esto para verificar el color =============
            const colorRegex = /^[A-Za-zÁÉÍÓÚáéíóúÑñ\s]+$/; //Cualquier carácter, mayúscula, minúscula o especial
            if (!colorRegex.test(color)) {
                alert("Color inválido, solo se permiten letras.");
                return false;
            }

            // ============= Todo esto para verificar el precio =============
            const precioNum = parseFloat(precio);
            if (isNaN(precioNum) || precioNum <= 0 || precioNum >= 999.99) {
              alert("Precio inválido, debe ser un valor positivo y menor que 999.99.");
              return false;
            }


            return true; // Todo correcto
}

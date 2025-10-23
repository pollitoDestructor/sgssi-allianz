function validarFormulario() {
            const nombre = document.getElementById("nombre").value.trim();
            const apellidos = document.getElementById("apellidos").value.trim();
            const dni = document.getElementById("dni").value.trim();
            const fecha_nac = document.getElementById("fecha_nac").value;
            const telefono = document.getElementById("telefono").value.trim();
            const email = document.getElementById("email").value.trim();
		
	    // ============= Todo esto para verificar o validar los campos =============
            if (!nombre || !apellidos || !dni || !fecha_nac || !telefono || !email) {
                alert("Por favor, completa todos los campos.");
                return false;
            }
            
            // Regex para DNI
            const dniRegex = /^[0-9]{8}[A-Z]$/;
            if (!dniRegex.test(dni)) {
                alert("DNI inválido, formato incorrecto.");
                return false;
            } else {
                let cadena = "TRWAGMYFPDXBNJZSQVHLCKET";
                let dniNumeros = parseInt(dni.substring(0, dni.length - 1));
                let posicion = dniNumeros % (cadena.length - 1);
                if (dni[dni.length - 1].toLowerCase() != cadena[posicion].toLowerCase()) {
                    alert("DNI inválido, la letra no coincide.");
                    return false;
                }
            }
            
	   // Regex para email
            const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
            if (!emailRegex.test(email)) {
                alert("Correo electrónico inválido.");
                return false;
            }
            
	    // Regex para telefono
            const telefonoRegex = /^[0-9]{9}$/;
            if (!telefonoRegex.test(telefono)) {
                alert("Número de teléfono inválido (9 dígitos).");
                return false;
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
            const colorRegex = /^[A-Za-zÁÉÍÓÚáéíóúÑñ\s]+$/;
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

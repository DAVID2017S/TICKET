document.addEventListener("DOMContentLoaded", () => {
    const numEmpleadoInput = document.getElementById("numEmpleado");
    const nombreInput = document.getElementById("nombre");
    const emailInput = document.getElementById("email");
    const extensionInput = document.getElementById("extension");
    const departamentoInput = document.getElementById("departamento");
    const anydeskInput = document.getElementById("anydesk");

    numEmpleadoInput.addEventListener("keydown", (event) => {
        // Verificar si la tecla presionada es "Enter"
        if (event.key === "Enter") {
            event.preventDefault(); // Evitar que el formulario se envíe (si está dentro de un formulario)
            const numEmpleado = numEmpleadoInput.value;

            if (numEmpleado) {
                fetch(`consultar_empleado.php?num_empleado=${numEmpleado}`)
                    .then(response => response.json())
                    .then(data => {
                        if (data.error) {
                            alert(data.error);
                        } else {
                            nombreInput.value = data.nombre;
                            emailInput.value = data.email;
                            extensionInput.value = data.extension;
                            departamentoInput.value = data.departamento;
                            anydeskInput.value = data.anydesk;
                        }
                    })
                    .catch(error => console.error('Error:', error));
            } else {
                nombreInput.value = "";
                emailInput.value = "";
                extensionInput.value = "";
                departamentoInput.value = "";
                anydeskInput.value = "";
            }
        }
    });
});
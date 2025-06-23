// Función para manejar el login
async function Login(e) {
    e.preventDefault();

    const logina = $("#correoa").val().trim();
    const clavea = $("#clavea").val().trim();

    /*
    try {
        console.log("Iniciando solicitud de login...");
    } catch (error) {
        console.log("Error al iniciar la solicitud de login:", error);
    }*/
    Swal.fire({
        icon: 'success',
        title: '¡EXITO!',
        text: "Acceso exitoso",
        timer: 3000,
        showConfirmButton: false
    });
}

// Asignación de eventos
$(document).ready(function () {
    $("#frmAcceso").on('submit', Login);
});


// Función para mostrar errores
function mostrarError(mensaje) {
    Swal.fire({
        icon: 'error',
        title: '¡ERROR!',
        text: mensaje,
        timer: 3000,
        showConfirmButton: false
    });
}


function verContra2() {
    const passwordInput = document.getElementById('clavea');

    if (passwordInput.type === 'password') {
        passwordInput.type = 'text';
    } else {
        passwordInput.type = 'password';
    }
}
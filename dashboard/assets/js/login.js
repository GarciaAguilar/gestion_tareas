// Función para manejar el login
async function Login(e) {
    e.preventDefault();

    const logina = $("#correoa").val().trim();
    const clavea = $("#clavea").val().trim();

    try {
        const response = await $.ajax({
            url: '../backend/api/login.php',
            type: 'POST',
            dataType: 'json',
            contentType: 'application/json',
            data: JSON.stringify({
                email: logina,
                password: clavea
            })
        });

        if (response.data && response.data.token) {
            const rol = response.data.user.role;

            if (rol === 2) {
                // Ejecutores: guardar token y permitir acceso
                localStorage.setItem('token', response.data.token);
                localStorage.setItem('user', JSON.stringify(response.data.user));
                document.cookie = `token=${response.data.token}; path=/; max-age=86400`;

                Swal.fire({
                    icon: 'success',
                    title: '¡Éxito!',
                    text: 'Inicio de sesión correcto',
                    timer: 2000,
                    showConfirmButton: false
                });

                setTimeout(() => {
                    window.location.href = 'dashboard.php';
                }, 2000);
            } else {
                // Admin u otro: bloquear acceso y mostrar alerta
                Swal.fire({
                    icon: 'warning',
                    title: 'Acceso restringido',
                    text: 'Usted no es un ejecutor',
                    timer: 3000,
                    showConfirmButton: false
                });

                // Limpiar datos
                localStorage.removeItem('token');
                localStorage.removeItem('user');
                document.cookie = "token=; path=/; max-age=0";
            }
        } else {
            mostrarError(response.message || 'Credenciales incorrectas');
        }
    } catch (error) {
        mostrarError('Error de conexión o credenciales inválidas');
    }
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
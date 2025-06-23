<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <title>Inicio de Sesión</title>
    <!-- CDN Bootstrap v.5.3.7 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- CDN Bootstrap Icons v1.11.3 -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <!-- Mis estilos -->
    <link rel="stylesheet" href="assets/css/login.css">
</head>

<body>
    <div class="contenedor">
        <hr style="border-top: 2px solid white; margin: 1px 1% 1px 1%; width: 98%;">
        <div class="card-header" style="text-align: center;">
            <h2 style="color: #f9b757; margin-bottom: 0px;">T A R E A S</h2>
        </div>
        <hr style="border-top: 2px solid white; margin: 1px 1% 1px 1%; width: 98%;">
        <h2 style="color: aqua;margin-top: 30px;">Inicio de sesión</h2>
        <form method="post" id="frmAcceso" class="button-container">
            <div class="usuario">
                <input type="text" id="correoa" name="correoa" class="form-control" required autocomplete="off">
                <span class="bi bi-envelope-fill form-control-feedback" style="color: aqua;"></span>
                <label>Correo</label>
            </div>
            <div class="usuario">
                <input type="password" id="clavea" name="clavea" class="form-control" required autocomplete="off">
                <span class="bi bi-eye-fill form-control-feedback" onclick="verContra()" style="color: aqua;"></span>
                <label>Contraseña</label>
            </div>
            <div>
                <button type="submit" style="color: white;" id="btnIngresar">
                    <span></span>
                    <span></span>
                    <span></span>
                    <span></span>
                    <b>INGRESAR</b>
                </button>
            </div>
        </form>
    </div>
    <!-- jQuery v3.7.1 -->
    <script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>
    <!-- CDN Bootstrap 5.3.7 -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js"></script>
    <!--SweetAlert2-->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <!-- Login -->
    <script src="assets/js/login.js"></script>
</body>
</html>
# Gestión de Tareas

Proyecto Full Stack que permite la gestión de tareas asignadas a usuarios mediante una API REST desarrollada en PHP y una interfaz móvil en Ionic/Angular, junto a un dashboard web administrativo.

## 📋 Requisitos del entorno

- PHP >= 8.0
- MariaDB
- XAMPP
- Node.js >= 18
- Angular CLI >= 17
- Ionic CLI (`npm install -g @ionic/cli`)
- Capacitor (`npm install @capacitor/core @capacitor/cli`)
- Composer (para instalar dependencias de PHP)
- Navegador utilizado Google Chrome Versión 137.0.7151.120 (para dashboard)

##  Instrucciones para crear y poblar la base de datos

1. Crear la base de datos en MariaDB
   CREATE DATABASE gestion_tareas;

2. Importa el archivo gestion_tareas.sql incluido en la raíz del backend

## Como ejecutar el backend
1. Coloca la carpeta del raiz en el directorio htdocs de XAMPP.

2. Inicia Apache y MySQL desde el panel de XAMPP.

3. Verificar que el archivo database.php que esta en backend/config esté correctamente configurado.

4. Accede desde el navegador o realiza pruebas con Postman:
http://localhost/gestion_tareas/backend/api/

## Como ejecutar el frontend

1. Instalar dependecias
npm install

2. Ejecutar el proyecto ng serve


## Como acceder al dashboard 

1. Abrir el navegador y dirígete a: 
http://localhost/gestion_tareas/dashboard/login.php






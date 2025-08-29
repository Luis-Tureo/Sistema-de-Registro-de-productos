# Sistema-de-Registro-de-productos
Se deberá desarrollar un Sistema de Registro de productos. La interfaz deberá validar y guardar los datos del formulario en una base de datos.

Instrucciones:

1. Servidor de Base de Datos
- MariaDB 10.4.32
- Servidor: 127.0.0.1
- Usuario: root@localhost
- Charset: UTF-8 (utf8mb4)
- SSL: no

2. Servidor Web
- Apache 2.4.58 (Win64)
- PHP 8.2.12
- Extensiones: mysqli, curl, mbstring

3. phpMyAdmin
- Versión: 5.2.1 (última estable: 5.2.2)

4. Instalación
  1. Instalar XAMPP de escritorio.
  2. Iniciar Apache y MySQL.
  3. Colocar carpeta "proyecto" en C:\xampp\htdocs.
  4. Importar database.sql en phpMyAdmin y ejecutar.

5. Para probar
- Ejectura la siguiente ruta: http://localhost/proyecto/index.php

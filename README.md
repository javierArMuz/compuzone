# Proyecto: Módulo Web en PHP MVC
## Evidencia: GA7-220501096-AA2-EV02
### Aprendiz: Javier Ariza.
### Programa: Análisis y Desarrollo de Software – SENA.
### Fase del proyecto: Ejecución.
### Fecha: [Fecha de entrega]

## Descripción del proyecto
Este módulo web ha sido desarrollado bajo el paradigma de programación orientada a objetos utilizando PHP con arquitectura MVC. El objetivo es implementar funcionalidades CRUD (crear, leer, actualizar, eliminar) para la gestión de productos, cumpliendo con los estándares de codificación y los artefactos definidos en el ciclo de vida del software.

## Tecnologías utilizadas
- Lenguaje de programación: PHP 8.2.12 
- Arquitectura: MVC (Modelo-Vista-Controlador)
- Servidor web: Apache/2.4.58 (Win64)
- Sistema gestor de bases de datos: MariaDB 10.4.32
- Cliente de base de datos: libmysql - mysqlnd 8.2.12
- Extensiones PHP: mysqli, curl, mbstring
- Entorno local: XAMPP
- Interfaz de administración de BD: phpMyAdmin 5.2.1
- Codificación de caracteres: UTF-8 Unicode (utf8mb4)
- HTML5
- Versionamiento: Git + GitHub

## Estructura del proyecto
```plaintext
/compuzone/
├── controllers/
│   └── ProductController.php
├── models/
│   └── Product.php
├── views/
│   └── products/
│       ├── crear.php
│       ├── editar.php
│       ├── listar.php
│       └── eliminar.php
├── config/
│   └── db.php
├── public/
│   └── index.php
├── assets/
│   └── css/, js/, img/
├── README.md
```

## Instrucciones de instalación
[git clone](https://github.com/javierArMuz/compuzone.git)

## Configurar entorno local
- Instalar XAMPP
- Copiar el proyecto en la carpeta htdocs
- Importar el archivo order_management.sql desde la carpeta /config.

## Configurar conexión a la base de datos
### Editar el archivo config/database.php:
- define('DB_HOST', 'localhost');
- define('DB_USER', 'root');
- define('DB_PASS', '');
- define('DB_NAME', 'order_management');

## Ejecutar el proyecto
**Abrir navegador y acceder a:**
http://localhost/compuzone/public/index.php

# KeepMoments 📸

**Sistema gestor de álbumes de fotos multi-usuario**

Sistema web completo para la gestión de álbumes de fotos que permite a múltiples usuarios crear, organizar y compartir sus colecciones fotográficas. Proyecto desarrollado para la asignatura de Desarrollo de Aplicaciones Web (DAW) del Grado en Ingeniería Multimedia de la Universidad de Alicante.

## 🛠️ Tecnologías Utilizadas

### Backend
- **PHP 8.2+** - Lenguaje de programación del servidor
- **MySQL/MariaDB** - Sistema de gestión de bases de datos
- **Sesiones PHP** - Gestión de autenticación
- **Cookies** - Persistencia de preferencias

### Frontend
- **HTML5** - Estructura semántica
- **CSS3** - Estilos y diseño responsive
- **JavaScript (ES6+)** - Validación de formularios e interactividad

### Base de Datos
- **MySQL/MariaDB** con 6 tablas principales:
  - `usuarios` - Información de usuarios
  - `albumes` - Álbumes de fotos
  - `fotos` - Metadatos de las fotos
  - `paises` - Catálogo de países
  - `estilos` - Estilos de accesibilidad
  - `solicitudes` - Solicitudes de álbumes impresos

## 📋 Requisitos del Sistema

- **Servidor web**: Apache 2.4+ o Nginx
- **PHP**: 8.2 o superior
- **Base de datos**: MySQL 10.4+ o MariaDB equivalente
- **Extensiones PHP requeridas**:
  - `mysqli`
  - `session`
  - `json`
  - `gd` (para procesamiento de imágenes)

## 🚀 Instalación

### 1. Clonar el repositorio

```bash
git clone https://github.com/danilokev/daw24-25.git
cd daw24-25
```

### 2. Configurar la base de datos

1. Importar el archivo SQL en tu servidor MySQL:
```bash
mysql -u root -p < db/pibd.sql
```

2. O ejecutar el script SQL desde phpMyAdmin o tu cliente MySQL preferido.

### 3. Configurar la conexión a la base de datos

Edita el archivo `inc/conexion-db.php` con tus credenciales:

```php
$host       = "localhost";
$dbUserName = "wwwdata";
$dbPassword = "daw";
$dbName     = "pibd";
```

### 4. Configurar permisos

Asegúrate de que el directorio `fotos/` tenga permisos de escritura:

```bash
chmod 755 fotos/
```

### 5. Configurar el servidor web

#### Apache
Configura un VirtualHost apuntando al directorio del proyecto o coloca los archivos en `htdocs/` o `www/`.

#### Desarrollo local con PHP built-in server
```bash
php -S localhost:8000
```

Luego accede a `http://localhost:8000` en tu navegador.

## ✒️ Autores

* **Marcos López Mira** - [MarcosLopezMira](https://github.com/MarcosLopezMira)
* **Kevin D. Analuisa Ortiz** - [danilokev](https://github.com/danilokev)

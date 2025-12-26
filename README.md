# KeepMoments 📸

**Sistema gestor de álbumes de fotos multi-usuario**

Sistema web completo para la gestión de álbumes de fotos que permite a múltiples usuarios crear, organizar y compartir sus colecciones fotográficas. Proyecto desarrollado para la asignatura de Desarrollo de Aplicaciones Web (DAW) del Grado en Ingeniería Multimedia de la Universidad de Alicante.

## 🎯 Características Principales

### Gestión de Usuarios
- **Registro e inicio de sesión** con validación de formularios
- **Autenticación segura** con sesiones y cookies
- **Perfil de usuario** personalizable con foto de perfil
- **Gestión de datos personales** (email, fecha de nacimiento, ubicación)
- **Sistema de baja de usuarios**

### Gestión de Álbumes y Fotos
- **Creación y edición de álbumes** personalizados
- **Subida de fotos** con metadatos (título, descripción, fecha, país)
- **Visualización de álbumes** y fotos individuales
- **Organización** de fotos por álbumes
- **Galería personal** de cada usuario

### Búsqueda y Exploración
- **Búsqueda avanzada** de fotos por título, fecha y país
- **Página principal** con últimas fotos subidas
- **Sistema de fotos destacadas** con críticas y comentarios
- **Consejos fotográficos** aleatorios en la página principal

### Accesibilidad
- **Múltiples estilos visuales** personalizables:
  - Modo noche
  - Modo letra grande
  - Modo alto contraste
  - Modo alto contraste con letra grande
- **Etiquetado semántico HTML5**
- **Texto alternativo** para todas las imágenes
- **Esquema de colores** con buen contraste
- **Diseño responsive**

### Funcionalidades Adicionales
- **Solicitud de álbumes impresos** con formulario completo
- **Sistema de estilos** persistente por usuario
- **Validación de formularios** en cliente (JavaScript) y servidor (PHP)
- **Gestión de cookies** para recordar preferencias
- **Estilos de impresión** optimizados

## 🛠️ Tecnologías Utilizadas

### Backend
- **PHP 8.2+** - Lenguaje de programación del servidor
- **MySQL/MariaDB** - Sistema de gestión de bases de datos
- **Sesiones PHP** - Gestión de autenticación
- **Cookies** - Persistencia de preferencias

### Frontend
- **HTML5** - Estructura semántica
- **CSS3** - Estilos y diseño responsive
- **JavaScript (ES6+)** - Validación de formularios y interactividad

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

## 📁 Estructura del Proyecto

```
daw24-25/
├── db/
│   └── pibd.sql              # Script de creación de la base de datos
├── inc/                      # Archivos PHP incluidos
│   ├── auth.php              # Control de autenticación
│   ├── cabecera.php          # Cabecera común
│   ├── conexion-db.php       # Configuración de BD
│   ├── html-start.php        # Inicio del HTML
│   ├── html-end.php          # Cierre del HTML
│   ├── pie.php               # Pie de página
│   └── ...
├── css/                      # Hojas de estilo
│   ├── styles.css            # Estilo principal
│   ├── estilo1.css           # Modo noche
│   ├── estilo2.css           # Letra grande
│   ├── estilo3.css           # Alto contraste
│   ├── estilo4.css           # Alto contraste + letra grande
│   ├── print.css             # Estilos de impresión
│   └── fontello.css          # Iconos
├── scripts/                  # JavaScript
│   ├── validar-login.js      # Validación de login
│   ├── validar-registro.js   # Validación de registro
│   └── tabla.js              # Funcionalidad de tablas
├── fotos/                    # Directorio de imágenes subidas
├── img/                      # Imágenes estáticas del sitio
├── font/                     # Fuentes personalizadas
├── index.php                 # Página principal
├── login.php                 # Inicio de sesión
├── registro.php              # Registro de usuarios
├── menu-usuario.php          # Menú principal del usuario
├── mis-albumes.php           # Gestión de álbumes
├── mis-fotos.php             # Galería de fotos
├── subir-foto.php            # Subida de fotos
├── crear-album.php           # Creación de álbumes
├── busqueda.php              # Búsqueda avanzada
├── resultado.php             # Resultados de búsqueda
├── configurar.php            # Configuración de estilos
├── accesibilidad.php         # Declaración de accesibilidad
└── README.md                 # Este archivo
```
## 🔒 Seguridad

- **Prepared statements** para prevenir inyección SQL
- **Validación de entrada** en cliente y servidor
- **Sanitización de salida** con `htmlspecialchars()`
- **Control de sesiones** para autenticación
- **Protección CSRF** en formularios críticos
- **Validación de tipos de archivo** en subidas

## ✒️ Autores

* **Marcos López Mira** - [MarcosLopezMira](https://github.com/MarcosLopezMira)
* **Kevin D. Analuisa Ortiz** - [danilokev](https://github.com/danilokev)

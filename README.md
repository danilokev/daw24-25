# KeepMoments

_Sistema gestor de albumes de fotos multi-usuario. Aplicacion web completa que permite a multiples usuarios crear, organizar y compartir sus colecciones fotograficas. Proyecto desarrollado para la asignatura de Desarrollo de Aplicaciones Web (DAW) del Grado en Ingenieria Multimedia de la Universidad de Alicante._

| Ruta                      | Descripcion                                              |
| :------------------------ | :------------------------------------------------------- |
| /                         | Pagina principal con las ultimas fotos subidas.          |
| /login.php                | Formulario de inicio de sesion.                          |
| /control-acceso.php       | Procesa las credenciales de inicio de sesion.            |
| /registro.php             | Formulario de registro de nuevo usuario.                 |
| /respuesta-registro.php   | Procesa y almacena el nuevo usuario en la base de datos. |
| /subir-foto.php           | Formulario para subir una nueva foto.                    |
| /respuesta-subir-foto.php | Procesa y almacena la foto subida.                       |
| /busqueda.php             | Pagina de busqueda de fotos por titulo, fecha y pais.    |

## Comenzando

_Estas instrucciones te permitiran obtener una copia del proyecto en funcionamiento en tu maquina local para propositos de desarrollo y pruebas._

### Pre-requisitos

_Se debe tener instalado **PHP** y un servidor web en el equipo de desarrollo. Las siguientes lineas muestran como hacerlo con comandos para **Ubuntu 22.04**:_

```sh
sudo apt update
sudo apt install apache2 mysql-server php php-mysqli php-gd
sudo systemctl start apache2
sudo systemctl start mysql
```

_Igualmente se debe tener instalada la base de datos **MySQL/MariaDB** y asegurarnos de que esta lanzada..._

```sh
sudo apt update
sudo apt install mysql-server
sudo systemctl start mysql
```

### Instalacion

_En esta seccion veremos como instalar y configurar el entorno de desarrollo para trabajar con el proyecto._

_En primer lugar, debemos clonar el proyecto desde nuestro repositorio._

```sh
git clone https://github.com/danilokev/daw24-25.git
```

_Una vez clonado el repositorio, debemos importar la base de datos y configurar la conexion._

```sh
cd daw24-25
mysql -u root -p < db/pibd.sql
```

_Para poner el proyecto en marcha, ejecutaremos el siguiente comando:_

```sh
php -S localhost:8000 -t public
```

## Construido con

- [PHP](https://www.php.net/) - Lenguaje de programacion del servidor ampliamente utilizado.
- [MySQL](https://www.mysql.com/) - Sistema de gestion de bases de datos relacional open-source.
- [Apache HTTP Server](https://httpd.apache.org/) - Servidor web HTTP multiplataforma.
- [CSS](https://developer.mozilla.org/es/docs/Web/CSS) - Lenguaje de estilos para el diseño visual de la aplicacion.
- [JavaScript](https://developer.mozilla.org/es/docs/Web/JavaScript) - Lenguaje de programacion para dinamismo e interactividad en el cliente.

## Autores

- **Marcos Lopez Mira** - _Desarrollo y documentacion_ - [MarcosLopezMira](https://github.com/MarcosLopezMira)
- **Kevin D. Analuisa Ortiz** - _Desarrollo y documentacion_ - [danilokev](https://github.com/danilokev)

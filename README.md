Instalación
===========

1. Clonar este respositorio en **/xampp/htdocs**

   `git clone https://github.com/diegous/CouchInn/`

2. En **/xampp/Apache/conf/httpd.conf** en las lineas 244 y 245 cambiar "*/xampp/htdocs*" por "*/xampp/htdocs/couchinn/app/controllers*"

3. Iniciar Apache y MySQL desde el menu de Xampp

4. Entrar a **http://localhost/phpmyadmin**, crear una nueva base de datos con el nombre **"couchinn"**

5. Entrar a la BD reien creada, ir a Importar. En la sección "*Archivo a importar*" apretar el boton Examinar y seleccionar el archivo "**/xampp/htdocs/couchinn/couchinn.sql**".

6. Probar la url "**http://localhost/**", debería mostrar un texto donde indica que la cantidad de usuarios registrados en el sistema es 1.

Comandos de GIT
===============

##### Bajar cambios nuevos
`git pull`

##### Ver estado
`git status`

##### Agregar cambios a un commit
`git add [nombre_de_archivo]`

##### Crear nuevo commit (un grupo de cambios)
`git commit -m "[descripcion_de_cambios_hechos]"`

##### Subir commit a GitHub
`git push`

Distribución de archivos
========================

En la carpeta **app/** se encuentra el sistema. Dentro de esa carpeta están las siguientes carpetas:

#### controllers/
Contiene los controladores. Cuando son referidos a objetos del modelo (por ejemplo User o CouchType) el nombre debe ir seguido de uno de los siguientes términos:
* **list**: muestra un listados de todos los objetos
* **new**: muestra un formulario a completar con los datos del objeto, al presionar el botón "Guardar" envía los datos al **_create**.
* **create**: recibe por POST los campos del objeto, lo guarda en la base de datos con el mensaje save_new() y hace una redirección.
* **edit**: recibe por GET un id y muestra un formulario con los datos a modificar, al presionar el botón "Guardar" envía los datos al **_update**.
* **update**: recibe por POST los campos del objeto, lo actualiza en la base de datos con el mensaje update() y hace una redirección.
* **delete**: recibe por GET un id, elimina ese objeto de la base de datos y hace una redirección.

#### model/
Contiene las clases del modelo. Todas las clases heredan de GenericModel que contiene consultas a la base de datos comunes a todas las clases.

#### views/
Contiene las vistas. Un archivo de vista específico a un controlador debe tener el mismo nombre que el controlador seguido de **"_view"**, por ejemplo la vista del controlador **couch_list.php** debe llamarse **couch_list_view.php**

# Configuración para Sublime Text
**Agregar las siguientes líneas en preferences > Settings - User**
```
   "tab_size": 2,
   "translate_tabs_to_spaces": true,
   "trim_trailing_white_space_on_save": true,
   "ensure_newline_at_eof_on_save": true
```

#Configuración de php necesaria para subir archivos grandes
PHP por defecto no esta configurado para subir imagenes de tamaño promedio por lo que hay que cambiar estos atributos en ini.php
```
  upload_max_filesize=30M
  post_max_size=30M
  max_input_time=1000
  max_execution_time=1000
```

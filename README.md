Instalación
===========

1. Clonar este respositorio en **/xampp/htdocs**

   `git clone https://github.com/diegous/CouchInn/`

2. En **/xampp/Apache/conf/httpd.conf** en las lineas 244 y 245 cambiar "*/xampp/htdocs*" por "*/xampp/htdocs/couchinn/app*"

3. Iniciar Apache y MySQL desde el menu de Xampp

4. Entrar a **http://localhost/phpmyadmin**, crear una nueva base de datos con el nombre **"couchinn"**

5. Entrar a la BD reien creada, ir a Importar. En la sección "*Archivo a importar*" apretar el boton Examinar y seleccionar el archivo "**/xampp/htdocs/couchinn/couchinn.sql**".

6. Probar la url "**http://localhost/**", debería mostrar un texto donde indica que la cantidad de usuarios registrados en el sistema es 1.

Comandos de GIT
===============

Bajar cambios nuevos
`git pull`

Ver estado
`git status`

Agregar cambios a un commit
`git add [nombre_de_archivo]`

Crear nuevo commit (un grupo de cambios)
`git commit -m "[descripcion_de_cambios_hechos]"`

Subir commit a GitHub
`git push`

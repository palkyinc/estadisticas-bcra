# Estadisticas BCRA
Aplicación que descargar todos los datos del sitio [Estadisticas BCRA](https://www.estadisticasbcra.com/) mediante su API Web y guarda los datos en una base de datos local de MySQl. Si se corre el script diariamente se actualizarán los datos no descargados.
## Tabla de Contenidos
- [Info General](#Info-General)
- [Tecnologías](#tecnologias)
- [Instalación](#instalacion)
- [Info de las Tablas](#Info-de-las-Tablas)
- [Estado](#estado)
- [Colaboraciones](#colaboraciones)
- [Contacto](#Contacto)
## Info General
La API Web ***Estadisticas BCRA*** brinda información financiera y económica de la Republica Argentina. La API web tiene una limitación de 100 consultas diarias. Si se desea realizar estudios complejos con los datos la API tendrá mucha demora en la descarga de los datos y se llegará rápidamente al limite de consultas. Tener los datos en una Base de datos local es el problema a resolver por la aplicación.  
## Tecnologías
- XAMPP
- MySQL
- PHP
## Instalación
1. Instalar [XAMPP](https://www.apachefriends.org/download.html). Omitir si ya lo tienes instalado.
1. En XAMPP, los servicios de MySQL y Apache deben estar iniciados.  
2. Cambiar la contraseña del usuario ***root*** de mysql. Si ya no lo conoces omitir este punto.  
    - Abrir el Panel de Control de XAMPP.  
    - Click en el boton "Shell", se abrirá una ventana de comandos.
    - Escribir en la ventana de comandos:  
        > mysqladmin -u root password  
    - Escribir la contraseña nueva y mantenerla en resguardo.
    - Cerrar la ventana de Shell.  
3. Descargar este proyecto:  
    ### Opción: con GIT instalado en su PC.
    - Abrir una ventana de Símbolo del sistema  
    - Tipear:  
        > cd C:\xampp\htdocs  
    - Luego tipear:
        > git clone  <https://github.com/palkyinc/estadisticas-bcra.git>  
    - Cerrar la ventana de Símbolo de Sistema.
    ### Opción: sin GIT instalado en su PC
    - Descargar el archivo zip con el proyecto desde:  
        > https://github.com/palkyinc/estadisticas-bcra/archive/refs/heads/master.zip  
    - Descomprimirlo en la carpeta:
        > cd C:\xampp\htdocs  
    - Renombrar la carpeta ***estadisticas-bcra-master*** como ***estadisticas-bcra***  
3. Generar token de la API Web.  
    - Dirigirse al [sitio de registro](https://www.estadisticasbcra.com/api/registracion):  
    - Completar con el mail y obtener el Token.
3. Agregar contraseña de MySQL y el Token en database.php.
    - Dirigirse a la carpeta
        > C:\xampp\htdocs\estadisticas-bcra
    - Abrir con Notepad el archivo dataBase.php y editar la linea:
        > define('PASSWORD_DB', 'PassMySQL');  
    - Reemplazar ***PassMySQL*** por la contraseña del punto 3.
    - En la linea:
        > define('TOKEN', 'BEARER KEY');
    - Reemplazar la palabra ***KEY*** por la llave obtenida en el punto 5.  
    - Guardar los cambios y cerrar el Notepad.  
4. Debido a que el script puede demorar por la gran cantidad de datos a descargar, sumado al guardado en MySQL; debemos modificar el tiempo de ejecución maximo en PHP.  
    - Dirigirse a:  
        > C:\xampp\php
    - Con Notepad abrir el archivo ***php.ini***.  
    - Buscar la entrada:  
        > max_execution_time  
    - Reemplazar 120 por 360.  
    - Guardar los cambios y cerrar el Notepad.
3. Abrir su navegador preferido y copiar en la barra de direcciones:  
    > <http://127.0.0.1/estadisticas-bcra/>
# Info de las Tablas
1. Nombre de la Base de Datos: ***estadisticas_bcra***  
2. Detalle nombres de las tablas y su contenido:
- milestones : eventos relevantes (presidencia, ministros de economía, presidentes del BCRA, cepo al dólar)  
- base : base monetaria  
- base_usd: base monetaria dividida USD  
- base_usd_of: base monetaria dividida USD Oficial  
- reservas : reservas internacionales  
- base_div_res : base monetaria dividida reservas internacionales  
- usd : cotización del USD  
- usd_of : cotización del USD Oficial  
- usd_of_minorista : cotización del USD Oficial (Minorista)  
- var_usd_vs_usd_of : porcentaje de variación entre la cotización del USD y el USD oficial  
- circulacion_monetaria : circulación monetaria  
- billetes_y_monedas : billetes y monedas  
- efectivo_en_ent_fin : efectivo en entidades financieras  
- depositos_cuenta_ent_fin : depositos de entidades financieras en cuenta del BCRA  
- depositos : depósitos  
- cuentas_corrientes : cuentas corrientes  
- cajas_ahorro : cajas de ahorro  
- plazo_fijo : plazos fijos  
- tasa_depositos_30_dias : tasa de interés por depósitos  
- prestamos : prestamos  
- tasa_prestamos_personales : tasa préstamos personales  
- tasa_adelantos_cuenta_corriente : tasa adelantos cuenta corriente  
- porc_prestamos_vs_depositos : porcentaje de prestamos en relación a depósitos  
- lebac : LEBACs  
- leliq : LELIQs  
- lebac_usd : LEBACs en USD  
- leliq_usd : LELIQs en USD  
- leliq_usd_of : LELIQs en USD Oficial  
- tasa_leliq : Tasa de LELIQs  
- m2_privado_variacion_mensual : M2 privado variación mensual  
- cer : CER  
- uva : UVA  
- uvi : UVI  
- tasa_badlar : tasa BADLAR  
- tasa_baibar : tasa BAIBAR  
- tasa_tm20 : tasa TM20  
- tasa_pase_activas_1_dia : tasa pase activas a 1 día  
- tasa_pase_pasivas_1_dia : tasa pase pasivas a 1 día  
- inflacion_mensual_oficial : inflación mensual oficial  
- inflacion_interanual_oficial : inflación inteanual oficial  
- inflacion_esperada_oficial : inflación esperada oficial  
- dif_inflacion_esperada_vs_interanual : diferencia entre inflación interanual oficial y esperada  
- var_base_monetaria_interanual : variación base monetaria interanual  
- var_usd_interanual : variación USD interanual  
- var_usd_oficial_interanual : variación USD (Oficial) interanual  
- var_merval_interanual : variación merval interanual  
- var_usd_anual : variación anual del dólar (porcentaje de variación de la cotización del dólar un año despues a la cotización de la fecha indicada)  
- var_usd_of_anual : variación anual del dólar oficial (porcentaje de variación de la cotización del dólar oficial un año despues a la cotización de la fecha indicada)  
- var_merval_anual : variación anual del MERVAL (porcentaje de variación del MERVAL un año despues al la cotización de la fecha indicada)  
- merval : MERVAL  
- merval_usd : MERVAL dividido cotización del USD  
***
Mas información sobre estos indices y reportes en: [Estadisticas BCRA](https://www.estadisticasbcra.com/)  
## Estado
El proyecto se encuentra terminado.
## Colaboraciones
Realizando un Fork en el proyecto.
## Contacto
Puedes escribirme a migvicpereyra@gmail.com.  
Mas sobre mi en mi [Portfolio](https://palkyinc.github.io/portfolio/).  

Randock
=======

Instrucciones:
- Descargar: https://github.com/rfuente-randock/randhash.git
- Restaurar la base de datos database.sql
- Actualizar con composer update.
- Composer pedirá los parámetros, incluídos nombre de usuario
y contraseña de la API.
- El proceso del servidor necesitará permiso de escritura en:
    var/cache
    var/log
    var/sessions
- Configurar apache (apache_randock.conf).

Notas:
- He seleccionado Symfony, ya que parece que es el que usan allí.
Los frameworks con los que tengo más experiencia son Zend y Yii.
- He descargado un «bundle» para la autentificación por formularios.
La tabla de «hashes» es independiente de la de autenticación.
- Hay dos usuarios: admin/admin y user/user. Admin puede editar
y borrar.
- He usado un «factory method» en la API para minimizar
los efectos de los cambios que pueda sufrir la API.

Versión 2:
- He mejorado el desacople de las llamadas a la API.
- Diagrama PlantUML en src/AppBundle/HashTest/diagram.puml
- La imagen del diagrama se puede ver en /diagram.png
- Añado un discreto «test» de PHPUnit para comprobar la API.

Versión 3:
- Ahora la API se accede a través de un servicio de Symfony.
- El nombre de usuario y la contraseña de la API ya no están
«hardcodeados» en el código. Ahora son parámetros que serán
solicitados durante la configuración de Composer.
- El proyecto vuelve a estar en github:
    https://github.com/rfuente-randock/randhash.git
- Las pantallas de excepciones personalizadas habían dejado
de funcionar en la versión 2. Ya vuelven a funcionar.
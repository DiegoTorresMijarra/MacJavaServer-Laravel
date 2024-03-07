# MacJavaServer-Laravel

Bienvenidos a MacJava, una solución integral de Laravel desarrollada por Jaime Lozano, Diego Torres, Oscar Encabo, y Raúl Rodríguez para la administración eficaz de restaurantes online. A través de nuestra API, ofrecemos una plataforma segura, eficiente y escalable para la gestión de bases de datos en el sector de la hostelería.

## Equipo de Desarrollo

- [Jaime Lozano](https://github.com/jaime9lozano)
- [Oscar Encabo](https://github.com/Diokar017)
- [Diego Torres Mijarra](https://github.com/DiegoTorresMijarra)
- [Raul Rodriguez Luna](https://github.com/raulrz11)

## Recursos

- [Documentación](https://github.com/DiegoTorresMijarra/MacJavaServer-Laravel/tree/master/pdf/MacJava-Laravel.pdf)
- [Video de Presentación](https://www.youtube.com/watch?v=vtqjlQRBHZ4&ab_channel=OscarEncabo )
- [Guía de Laravel](https://github.com/DiegoTorresMijarra/MacJavaServer-Laravel/tree/master/README_LARAVEL.md)

## Contenido

1. [Introducción](#introducción)
2. [Gitflow](#gitflow)
3. [Tecnologías](#tecnologías)
4. [Bases de datos](#bases-de-datos)
5. [Características comunes de los endpoints](#características-comunes-de-los-endpoints)
6. [Categoría](#categoría)
7. [Trabajadores, clientes y proveedores](#trabajadores-clientes-y-proveedores)
8. [Restaurantes y productos](#restaurantes-y-productos)
9. [Autenticación](#autenticación)
10. [Usuarios](#usuarios)
11. [Pedidos](#pedidos)
12. [Despliegue](#despliegue)
13. [Tests](#tests)
14. [Conclusión y presupuesto](#conclusión-y-presupuesto)

## 1. Introducción <a name="introducción"></a>
   La API MacJavaLaravel proporciona una solución segura, integral y escalable para la gestión de bases de datos de un restaurante online desarrollada con Laravel, esta API se destaca por su uso de PHP moderno y su arquitectura MVC, que promueve un desarrollo ágil y modular.

## 2. Gitflow <a name="gitflow"></a>
   Para la gestión del proyecto, hemos adoptado la metodología Gitflow, estableciendo ramas para características específicas que luego se integran en una rama de desarrollo para pruebas, y finalmente se unen a la rama principal para su implementación.

## 3. Tecnologías <a name="tecnologías"></a>
   Nuestro proyecto se apoya en Laravel como el framework principal, aprovechando sus capacidades para escribir código PHP estructurado y mantenible. Además, utilizamos Eloquent ORM para la interacción con bases de datos, Sanctum para la autenticación y PHPUnit para las pruebas.

## 4. Bases de datos <a name="bases-de-datos"></a>
   Utilizamos MySQL para el almacenamiento de datos estructurados, dada su compatibilidad y rendimiento óptimo con Laravel. Esta elección nos permite gestionar de manera eficiente tanto las operaciones CRUD básicas como las transacciones más complejas requeridas por la aplicación.

## 5. Características comunes de los endpoints <a name="características-comunes-de-los-endpoints"></a>
   Nuestros endpoints comparten varias características, incluyendo el uso de Migrations y Seeders para la gestión de bases de datos, el empleo de UUIDs para identificadores únicos, y la implementación de DTOs (Data Transfer Objects) y Resources para la transferencia y respuesta de datos, junto con los métodos habituales como findAll, findById, create, update, y delete.

## 6. Categoría <a name="categoría"></a>
   El endpoint de categoría administra las diferentes categorías dentro del restaurante, permitiendo clasificar productos o servicios ofrecidos, con atributos como nombre y descripción.

## 7. Trabajadores, clientes y proveedores <a name="trabajadores-clientes-y-proveedores"></a>
   Mediante estos endpoints se facilita la administración de trabajadores, clientes y proveedores del restaurante. La modificación de estos datos está restringida a usuarios con roles de administrador.

## 8. Restaurantes y productos <a name="restaurantes-y-productos"></a>
   Estos endpoints permiten un control detallado sobre la información de restaurantes y los productos ofrecidos, con acciones disponibles para todos los usuarios y otras exclusivas para administradores, asegurando la integridad y la privacidad de los datos.

## 9. Autenticación <a name="autenticación"></a>
   Para el registro y el inicio de sesión de usuarios, utilizamos Laravel Sanctum, que proporciona un sistema de autenticación robusto basado en tokens API y sesiones para la seguridad de los usuarios.

## 10. Usuarios <a name="usuarios"></a>
    El manejo de usuarios se lleva a cabo a través de un endpoint específico, que administra la información del usuario y ofrece seguridad mediante el uso de hash de contraseñas con Bcrypt.

## 11. Pedidos <a name="pedidos"></a>
    El sistema de pedidos, uno de los componentes más complejos de nuestra API, gestiona los pedidos realizados por clientes y procesados por el restaurante, utilizando Eloquent para interactuar con la base de datos MySQL y ofreciendo funcionalidades completas para el manejo de pedidos.

## 12. Despliegue <a name="despliegue"></a>
    El despliegue de nuestra aplicación se simplifica gracias al uso de Docker, lo que permite una fácil configuración y mantenimiento de los entornos de desarrollo y producción a través de archivos docker-compose.

## 13. Tests <a name="tests"></a>
    Hemos desarrollado pruebas unitarias y de integración utilizando PHPUnit para asegurar la calidad y el correcto funcionamiento de nuestra aplicación, empleando mocks y factories para simular y testear diversos escenarios.

## 14. Conclusión y presupuesto <a name="conclusión-y-presupuesto"></a>
    El proyecto MacJavaLaravel representa un compromiso significativo con la calidad y la eficiencia, logrando sus objetivos dentro de los dos meses previstos gracias a una planificación cuidadosa y una ejecución eficiente. La inversión en recursos técnicos, humanos y de marketing subraya la dedicación del equipo hacia el éxito y la innovación del proyecto.
¡Gracias por visitar nuestro proyecto! Para cualquier consulta o sugerencia, no dudes en ponerte en contacto con nosotros. Esperamos que encuentres útil la APP MacJavaNest para la gestión de tu restaurante online.

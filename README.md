# Certificados-Reframeworked
Sistema de gestión de certificados, ahora en Laravel.

## Instalación
Una vez clonado el repositorio:  
1- Copiar el archivo .env.example como .env y configurar a gusto.  
2- Ejecutar el siguiente comando para crear las tablas en la base de datos:  
    ```
    php artisan migrate
    ```  
3- Ejecutar el script setup-linux.sh provisto en la raíz del proyecto.  
4- Ejecutar el siguiente comando para poblar la base de datos con las provincias y ciudades de Argentina, como a su vez crear un usuario administrador por defecto:
    ```
    php artisan db:seed
    ```  
El mail del nuevo administrador es 'administrador@ficertif.com' y su contraseña es 'admin'. Se recomienda modificar estos valores.

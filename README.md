# Dental Ramos

> **Sistema de gestión médica y administrativa diseñado para optimizar el control de pacientes, agendas, expedientes e historiales clínicos en el Consultorio Dental Ramos.**

Este proyecto surge como una solución tecnológica para reemplazar el manejo manual de legajos y registros escritos, mitigando errores humanos, reduciendo tiempos muertos en la búsqueda de documentación y centralizando datos esenciales de salud (alergias, enfermedades preexistentes, presión arterial, etc.).

---

## Stack Tecnológico

El sistema utiliza una arquitectura basada en tecnologías web estándar para una ejecución e instalación local eficiente:

* **Frontend / Interfaz:** HTML5, CSS3, JavaScript (Sintaxis nativa moderna).
* **Backend / Lógica:** PHP (Versión 7.4 o superior).
* **Base de Datos:** MySQL / MariaDB.
* **Servidor Local & Administración:** XAMPP y phpMyAdmin.
* **IDE de Desarrollo:** Visual Studio Code.

---

## Requisitos del Sistema

### Hardware Mínimo
* **Procesador:** Mínimo de 2 núcleos (Intel i3 o AMD Ryzen 3 o superior).
* **Memoria RAM:** Al menos 4 GB (8 GB recomendados para un rendimiento fluido).
* **Almacenamiento:** 20 GB de espacio libre en el disco (Preferiblemente SSD).
* **Resolución de Pantalla:** Mínima de 1366 x 768 para el uso cómodo de las herramientas.

### Software Soportado
* Windows 10/11, macOS, o distribuciones Linux compatibles con el entorno XAMPP.

---

## Guía de Instalación y Configuración

### 1. Servidor Local (XAMPP)
1. Descarga **XAMPP** (con PHP 7.4 o superior) desde la página oficial de Apache Friends.
2. Ejecuta el instalador `.exe` e instala los componentes estándar (`Apache`, `MySQL`, `phpMyAdmin`).
3. Durante el diálogo de configuración del Firewall, permite la comunicación del servidor Apache únicamente en **redes privadas o domésticas**.
4. Abre el panel de control de XAMPP e inicia (`Start`) los módulos de **Apache** y **MySQL**.

### 2. Configuración de Visual Studio Code
Para vincular correctamente el intérprete de PHP con tu editor de código:

1. Abre los Ajustes de VS Code (`File -> Preferences -> Settings` o con el atajo `Ctrl + ,`).
2. En la barra de búsqueda superior escribe `php` para filtrar las opciones.
3. Asegúrate de mantener activadas las casillas de `PHP › Validate: Enable` y `PHP › Validate: Run` (en `onSave`).
4. Abre o modifica el archivo de configuración `settings.json` e incluye la ruta exacta al ejecutable de PHP instalado en tu ordenador:

```json
{
  "php.validate.executablePath": "C:\\xampp\\php\\php.exe"
}
```
### 3. Despliegue de la Base de Datos
1. Dirígete en tu navegador local a http://localhost/phpmyadmin/.
2. Genera una base de datos con el nombre del proyecto.
3. Importa el archivo .sql para habilitar el almacenamiento y manejo de información.
   
### Estructura de la Base de Datos
La base de datos relacional está estructurada siguiendo principios de diseño que eliminan la redundancia, aplicando hasta la Segunda Forma Normal (2NF). Está conformada por las siguientes tablas y relaciones principales:

<img src="https://example.com" alt="Company Logo" width="300" height="150">

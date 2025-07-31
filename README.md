# Prueba Técnica de Maquetación WordPress/WooCommerce - [Tu Nombre]

Este repositorio contiene el tema hijo (`storefront-child`) desarrollado para la prueba técnica de maquetación de una página de inicio de e-commerce de cotillón, basada en el diseño de Adobe XD proporcionado.

## Requisitos Previos

* WordPress 6.0 o superior
* Plugin WooCommerce (activo)
* Tema Storefront (activo como tema padre)
* PHP 7.4 o superior
* MySQL 5.6 o superior

## Instalación y Configuración

1.  Clona este repositorio: `git clone https://github.com/gosh19/seocom.git`
2.  Copia la carpeta `storefront-child` a `wp-content/themes/` en tu instalación local de WordPress.
3.  Accede al panel de administración de WordPress.
4.  En "Apariencia > Temas", activa el tema **"Storefront Child"**.
5.  Asegúrate de que el plugin WooCommerce está activo.

## Configuración de Contenido para Visualización de la Página de Inicio

Para una correcta visualización de la página de inicio maquetada, se recomienda:

### 1. Configurar la Página de Inicio Estática:

* Crea una nueva página de WordPress (ej. "Inicio").
* Ve a "Ajustes > Lectura":
    * Establece "Una página estática".
    * "Página de inicio": Selecciona "Inicio".


### 2. Creación de Contenido Necesario:

* **Productos:** Crea al menos 3 productos de ejemplo con imágenes (por ejemplo, Kit de Decoración, Vasos Reutilizables, Piñata). Asigna precios.
* **Categorías de Producto:** Crea al menos 3 categorías de producto (por ejemplo, "Decoración Temática", "Menaje y Vajilla", "Juegos y Entretenimiento") y asigna tus productos a estas categorías.

### 3. Estructura de la Página de Inicio (Gutenberg):

La página "Inicio" está maquetada utilizando los siguientes bloques de Gutenberg y **clases CSS personalizadas** aplicadas a los bloques principales para el estilizado:

* **Bloque de Portada (Banner Principal):**
    * Clase CSS Adicional: `banner-ppal`
    * Contiene un encabezado (`h1`) y un botón de acción (`a`).
* **Bloque de Encabezado:** Para el título "CETEGORIAS DESTACADAS".
    * Clase CSS Adicional: `category-title`
    * Contiene un encabezado (`h1`) y un botón de acción (`a`).
* **Bloque de Encabezado:** Para el texto descriptivo".
    * Clase CSS Adicional: `category-text`
* **Bloque "Lista de categorías de producto":**
    * Clase CSS Adicional: `categories-list`
    * Componente utilizado "Product Categories List"
    * Configurado para mostrar 3 columnas de categorías.
    * *(Nota: Asegúrate de desmarcar "Ocultar categorías vacías" en los ajustes del bloque si tus categorías no tienen productos aún).*
* **Bloque "Productos por categoría":**
    * Configurado para mostrar productos de las categorías.
    * Clase CSS Adicional: `product-section`
    * Titulo con etiqueta (`h2`)
    * Componente utilizado "Product Collection"
* **Bloque "Productos destacados":**
    * Configurado para mostrar productos destacados.
    * Clase CSS Adicional: `featured-product-section`
    * Titulo con etiqueta (`h2`)
    * Componente utilizado "Product Collection"
* **Banner informativo:** 
    * Clase CSS Adicional: `banner-media`
    * Titulo con etiqueta (`h2`)
    * Texto descriptivo (`p`)
    * boton de acción (`a`)
    * Contiene bloques de párrafo y columnas para el contenido.
    * Componente utilizado "media & Text"


### 4. Personalización del Header:

* El archivo `header.php` en el tema hijo ha sido modificado para incluir la barra superior y reorganizar los elementos de la barra principal (logo, navegación, búsqueda, iconos) utilizando Flexbox.
* Las funciones predeterminadas de Storefront para el header han sido desenganchadas en `functions.php` para permitir esta reconstrucción.


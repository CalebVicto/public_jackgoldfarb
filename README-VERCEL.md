Objetivo

Instrucciones para desplegar este proyecto en Vercel como sitio estático.

Resumen rápido

- Este repositorio contiene páginas HTML, CSS, imágenes y algunos scripts PHP en el servidor (por ejemplo `correo.php`, `inscripcion-concurso.php`). Vercel sirve bien contenido estático (HTML/CSS/JS/imagenes). PHP no se ejecuta en Vercel por defecto.

Pasos para desplegar (rápido)

1) Instalar la CLI de Vercel (si no la tienes):

```bash
npm i -g vercel
```

2) Autenticarte:

```bash
vercel login
```

3) Desde la raíz del proyecto (donde está este `README-VERCEL.md`) ejecuta:

```bash
vercel --prod
```

Notas y consideraciones importantes

- PHP: Los archivos PHP no se ejecutarán en Vercel. Si tu sitio depende de `correo.php`, `postular.php` u otros scripts PHP para formularios o envío de correo, deberás:
  - Migrar la lógica a funciones serverless (Node / Vercel Functions), o
  - Usar un servicio externo para formularios (Formspree, Netlify Forms, Google Forms), o
  - Mantener esos endpoints en un hosting con PHP (por ejemplo un VPS, DigitalOcean, o un proveedor especializado) y actualizar los `action` de los formularios para apuntar a esas URL.

- Privacidad / uploads: En este repo hay muchos archivos en `uploads/` (CVs y documentos). Por defecto he añadido `uploads/` a `.vercelignore` para proteger datos sensibles. Si quieres servir esos archivos públicamente, borra la entrada `uploads/` en `.vercelignore`.

- Rutas bonitas: El `vercel.json` incluido está configurado para servir los archivos estáticos tal como están en el repo.

Siguientes pasos (opcional)

- Si quieres, puedo:
  - Ajustar formularios para usar una función serverless en Node que replique la funcionalidad PHP mínima (envío de correo vía API).  
  - Preparar funciones API para enviar correo usando un servicio (SendGrid, Mailgun) y una ruta segura.  
  - Quitar `uploads/` de `.vercelignore` y asegurar que los archivos que subas no contienen datos sensibles.

Si quieres que yo despliegue directamente desde este workspace (ejecutando la CLI), dime y lo hago desde aquí.



# Imagen oficial de PHP CLI (con servidor embebido)
FROM php:8.3-cli

# Carpeta de trabajo dentro del contenedor
WORKDIR /app

# Copiamos TODO el proyecto dentro del contenedor
COPY . /app

# Arrancamos el servidor embebido de PHP:
# - Escucha en 0.0.0.0 (necesario para que se vea desde fuera del contenedor)
# - Usa el puerto $PORT si existe (Render lo pone); si no, 8080 por defecto
# - Usa router.php para reenviar las rutas a index.php
CMD ["sh", "-c", "php -S 0.0.0.0:${PORT:-8080} -t /app /app/router.php"]


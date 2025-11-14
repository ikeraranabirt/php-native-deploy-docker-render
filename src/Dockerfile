FROM php:8.3-cli

WORKDIR /app

# Copiamos todo el proyecto dentro del contenedor
COPY . /app

# Servimos la carpeta public con router.php
# - 0.0.0.0 para que se pueda acceder desde fuera del contenedor
# - PORT (Render la pone); localmente usaremos 8080
CMD ["sh", "-c", "php -S 0.0.0.0:${PORT:-8080} -t /app/src/public /app/router.php"]

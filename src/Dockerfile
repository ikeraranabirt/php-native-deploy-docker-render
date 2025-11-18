FROM php:8.3-cli

WORKDIR /app

# El contexto de build será ./src, así que esto copia TODO el contenido de src/ a /app
COPY . /app

# Servimos /app/public usando /app/router.php
CMD ["sh", "-c", "php -S 0.0.0.0:${PORT:-8080} -t /app/public /app/router.php"]

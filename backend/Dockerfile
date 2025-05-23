FROM php:8.2-cli

# Instala extensiones necesarias y composer
RUN apt-get update && apt-get install -y unzip zip curl && \
    curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Setea el directorio de trabajo
WORKDIR /app

# Copia todo el proyecto
COPY . .

# Instala dependencias de Slim
RUN composer install

# Expone el puerto de Slim
EXPOSE 3000

# Comando para correr el servidor Slim
CMD ["php", "-S", "0.0.0.0:3000", "index.php"]

# Use the official PHP image as the base image
FROM php:latest

# Install any PHP extensions and other dependencies your application requires
RUN docker-php-ext-install pdo_mysql

# Set the working directory in the container
WORKDIR /var/www/html

# Copy the PHP files from your host to the container
COPY . /var/www/html

# Expose port 80 to allow outside access to your application
EXPOSE 80

# Start the PHP built-in web server
CMD ["php", "-S", "0.0.0.0:80"]

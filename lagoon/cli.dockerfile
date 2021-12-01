FROM testlagoon/php-8.0-cli-drupal:pr-353

COPY composer.* /app/
COPY assets /app/assets
COPY patches /app/patches
RUN COMPOSER_MEMORY_LIMIT=-1 composer install --no-dev
COPY . /app
RUN mkdir -p -v -m775 /app/web/sites/default/files

# Define where the Drupal Root is located
ENV WEBROOT=web

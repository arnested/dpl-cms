ARG CLI_IMAGE
FROM ${CLI_IMAGE} as cli

FROM testlagoon/php-8.0-fpm:pr-353

COPY --from=cli /app /app

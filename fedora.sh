#!/usr/bin/env sh
#
#   Lancia un ambiente di sviluppo su Fedora linux
#
# Avvio del server
#   ./fedora.sh up
# Spegnimento del server
#   ./fedora.sh down
# Accedere ai servizi
#   http://127.0.0.1:80     Progetto
#   http://127.0.0.1:8000   Adminer
#   http://127.0.0.1:8888   Validatore HTML
#   127.0.0.1:3306          MySQL

case "$1" in  # In base al primo argomento del programma
  u|up|U|UP)
    sudo podman run \
      --name webserver \
      --detach \
      --net host \
      --volume "${PWD}/:/var/www/:z" \
      --entrypoint /bin/sh \
      php:apache \
      -c 'docker-php-ext-install pdo_mysql && docker-php-entrypoint apache2-foreground'
    sudo podman run \
      --name adminer \
      --detach \
      --net host \
      --env ADMINER_DEFAULT_SERVER='127.0.0.1' \
      adminer
    sudo podman run \
      --name sqldb \
      --detach \
      --net host \
      --env MYSQL_ROOT_PASSWORD='saw' \
      --env MYSQL_DATABASE='saw' \
      --env MYSQL_USER='saw' \
      --env MYSQL_PASSWORD='saw' \
      mariadb:latest
    sudo podman run \
      --name validator \
      --detach \
      --net host \
      validator/validator java -cp /vnu.jar nu.validator.servlet.Main 8888
    ;;
  d|down|D|DOWN)
    #
    #   Spegnimento
    #
    sudo podman rm -f webserver || true
    sudo podman rm -f adminer || true
    sudo podman rm -f sqldb || true
    sudo podman rm -f validator || true
    ;;
  *)
    #
    #   Comando sbagliato
    #
    printf 'Comando sconosciuto %s\n' "$1" > /dev/stderr # Stampa su standard error
    exit 1 # Esci con error code
    ;;
esac

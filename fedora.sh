#!/usr/bin/env sh
#
#   Lancia un ambiente di sviluppo su Fedora linux
#
# Avvio del server
#   ./fedora.sh up
# Spegnimento del server
#   ./fedora.sh down
# Accedere ai servizi
#   http://127.0.0.1:8080   Progetto
#   http://127.0.0.1:8000   Adminer
#   http://127.0.0.1:8888   Validatore HTML

case "$1" in  # In base al primo argomento del programma
  u|up|U|UP)
    #
    #   Avvio
    #

    # Crea un gruppo di container
    sudo podman pod create --name "SAW" \
      --publish 127.0.0.1:8080:80 \
      --publish 127.0.0.1:8000:8080 \
      --publish 127.0.0.1:8888:8888
    sudo podman run --pod SAW \
      --name webserver \
      --detach \
      --volume "${PWD}/public_html:/var/www/html/:ro" \
      php:apache
    sudo podman run --pod SAW \
      --name adminer \
      --detach \
      --env ADMINER_DEFAULT_SERVER='127.0.0.1' \
      adminer
    sudo podman run --pod SAW \
      --name sqldb \
      --detach \
      --env MYSQL_ROOT_PASSWORD='saw' \
      --env MYSQL_DATABASE='saw' \
      --env MYSQL_USER='saw' \
      --env MYSQL_PASSWORD='saw' \
      mariadb:latest
    sudo podman run --pod SAW \
      --name validator \
      --detach \
      validator/validator java -cp /vnu.jar nu.validator.servlet.Main 8888
    ;;
  d|down|D|DOWN)
    #
    #   Spegnimento
    #
    sudo podman pod rm --all --force
    ;;
  *)
    #
    #   Comando sbagliato
    #
    printf 'Comando sconosciuto %s\n' "$1" > /dev/stderr # Stampa su standard error
    exit 1 # Esci con error code
    ;;
esac

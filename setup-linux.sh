#!/bin/bash

RUTA_SCRIPT=$(dirname `which $0`)
STORAGE_PUBLIC="$RUTA_SCRIPT/storage/app/public"

# Crea la estructura de directorios necesaria del storage
if [ ! -d "$STORAGE_PUBLIC/certificados" ]; then
    mkdir "$STORAGE_PUBLIC/certificados"
fi
if [ ! -d "$STORAGE_PUBLIC/media" ]; then
    mkdir "$STORAGE_PUBLIC/media"
    mkdir "$STORAGE_PUBLIC/media/portadas-eventos"
fi
if [ ! -d "$STORAGE_PUBLIC/templates" ]; then
    mkdir "$STORAGE_PUBLIC/templates"
fi
if [ ! -d "$STORAGE_PUBLIC/tmp" ]; then
    mkdir "$STORAGE_PUBLIC/tmp"
fi

# Crea un enlace simbólico al storage publico para acceder desde public
php "$RUTA_SCRIPT/artisan" storage:link

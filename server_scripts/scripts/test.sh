#!/bin/bash
#################################
#Скрипт контроля учетных записей#
#################################
### Подключаем конфиг файл
source "../scripts.conf"
### Подключаем Функции
source "../functions"

#Дебаг
DEBUG="true"
##log - обычный лог
##log_e - ошибка
###

PRIVATE_KEY=`${TUNSAFE} genkey`
PUBLIC_KEY=`echo ${PRIVATE_KEY} | ${TUNSAFE} pubkey`
#${TUNSAFE} genkey | ${TEE} private_key # | ${TUNSAFE} pubkey > public_key
echo ${PRIVATE_KEY} ${PUBLIC_KEY}

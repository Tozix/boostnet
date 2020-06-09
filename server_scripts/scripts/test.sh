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

mysql_array "SELECT id,name,tarif_id,balance FROM users where active_vpn=0 and server_id=1 ORDER BY updated_at" | while read i; do
ID=($i)
echo "${ID[0]} ${ID[1]}"
done

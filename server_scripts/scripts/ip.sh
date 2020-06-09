#!/bin/bash
#################################
#Скрипт добавления ip в таблицу #
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

while read IPS
do 
echo "Адрес епта: $IPS!"
mysql_one "INSERT INTO accounts(user_id,ipAddress) VALUES ('0', '${IPS}');"
done < ips

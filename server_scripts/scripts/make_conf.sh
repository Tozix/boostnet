#!/bin/bash
####################################
#Ежедневное создание конфига из БД #
####################################
### Подключаем конфиг файл
source "../scripts.conf"
### Подключаем Функции
source "../functions"

#Дебаг
DEBUG="true"
##log - обычный лог
##log_e - ошибка
###

log "Бэкапим старый конфиг"

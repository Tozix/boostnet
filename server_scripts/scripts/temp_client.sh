#!/bin/bash
#################################
#Скрипт контроля учетных записей#
#################################
#Контроль баланса юзеров	#
### Подключаем конфиг файл
source "../scripts.conf"
### Подключаем Функции
source "../functions"
#Дебаг
DEBUG="true"
##log - обычный лог
##log_e - ошибка
###



mysql_array "SELECT id,user_id,ipAddress,public_key FROM new_accounts WHERE server_id=${SERVER_ID}" | while read i; do
ACCOUNT=($i)
#Получаем имя пользователя и ID тарифа
USER=(`mysql_one "SELECT name,tarif_id FROM users WHERE id=${ACCOUNT[1]} limit 1"`)
#Запрашиваем ограничение по скорости
BITE_LIMIT=`mysql_one "SELECT speed FROM tarifs where id=${USER[1]} limit 1"`

log "Временно добавляем ПИРА в конфиг сервера"
${TUNSAFE} set ${TUNIF} peer "${ACCOUNT[3]}" allowed-ips ${ACCOUNT[2]}/32
log "Устанавливаем ограничения для юзера"
limits "${USER[0]}" "${BITE_LIMIT}" "${ACCOUNT[2]}"
done
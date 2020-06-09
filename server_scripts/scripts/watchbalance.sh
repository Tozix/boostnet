#!/bin/bash
#################################
#Скрипт контроля учетных записей#
#################################
#Контроль баланса юзеров	#

### Подключаем конфиг файл
. /home/boostnet/scripts.conf
### Подключаем Функции
. /home/boostnet/functions
#Дебаг
DEBUG="false"
##log - обычный лог
##log_e - ошибка
###


log "##################################Запуск watch blance#########################################"


log "----------------------------------------------------------------------"
log "Берем пользователей, для которые ожидают пополнения"
mysql_array "SELECT id,name,tarif_id,balance FROM users where active_vpn=3 ORDER BY updated_at" | while read i; do
ID=($i)
log "ID ${ID[0]} Name ${ID[1]} Tarif ${ID[2]} Balance ${ID[3]}"
log "Смотрим баланс"
TARIF_COST=`echo "SELECT cost FROM tarifs WHERE id=\"${ID[2]}\" LIMIT 1" | mysql --user=${DB_USER} --password=${DB_PASSWORD} --host=${DB_SERVER} --port=${DB_PORT} ${DB_NAME} -sN 2>/dev/null`

if [ "${ID[3]}" -ge "${TARIF_COST}" ]
then
log "Денег на балансе достаточно - списываем и включаем интернет интернет"
BITE_LIMIT=`echo "SELECT speed FROM tarifs WHERE id=\"${ID[2]}\" LIMIT 1" | mysql --user=${DB_USER} --password=${DB_PASSWORD} --host=${DB_SERVER} --port=${DB_PORT} ${DB_NAME} -sN 2>/dev/null`
mysql_one "UPDATE users SET balance=balance-${TARIF_COST},active_vpn=2 WHERE id=${ID[0]};"
log "Возвращаем скорость в зависимости от тарифа"
limits "${ID[1]}" "${BITE_LIMIT}"
#Уведомляем пользователя 1-ID,2-Тип,3-Заголовок,Текст
reports "${ID[0]}" "1" "VPN снова активен" "VPN снова активен, с вашего счета списана абонентская плата в размере: ${TARIF_COST} руб."
fi

done



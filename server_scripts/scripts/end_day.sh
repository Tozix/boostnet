#!/bin/bash
#################################
#Скрипт контроля учетных записей#
#################################
#Ежедневное списание		#

#Либо списываем средства и оставляем интернет(2) либо ставим в ожидание бабла(3), если баланс не достататочный.

### Подключаем конфиг файл
. /home/boostnet/scripts.conf
### Подключаем Функции
. /home/boostnet/functions
#Дебаг
DEBUG="false"
##log - обычный лог
##log_e - ошибка
###



log "Берем пользователей, с активным VPN (Ежедневным списанием)"
mysql_array "SELECT id,name,tarif_id,balance FROM users where active_vpn=2 and type!=2 ORDER BY updated_at" | while read i; do
ID=($i)
log "-------------------------------------------------------------------------------------------"
BITE_LIMIT="1000000"
TARIF_COST=`echo "SELECT cost FROM tarifs WHERE id=\"${ID[2]}\" LIMIT 1" | mysql --user=${DB_USER} --password=${DB_PASSWORD} --host=${DB_SERVER} --port=${DB_PORT} ${DB_NAME} -sN 2>/dev/null`
log "Юзер ID ${ID[0]} имя ${ID[1]} тариф ${ID[2]}(стоимость ${TARIF_COST}) на балансе ${ID[3]}"
#Смотрим баланс
if [ "${ID[3]}" -ge "${TARIF_COST}" ]
then
log "Денег на балансе достаточно - списываем и не отключаем интернет"
mysql_one "UPDATE users SET balance=balance-${TARIF_COST} WHERE id=${ID[0]};"
#Уведомляем пользователя 1-ID,2-Тип,3-Заголовок,Текст
reports "${ID[0]}" "0" "Списание средств" "С вашего счета была списана абонентская плата в размере ${TARIF_COST} руб."
else
log "Денег не хватает, ставим в статус 3 в ожидании поступлений на счет"
#Уведомляем пользователя 1-ID,2-Тип,3-Заголовок,Текст
reports "${ID[0]}" "9" "Блокировка интернета" "На вашем счете не достаточно средств, для списания абонентской платы - интернет будет отключен!"
mysql_one "UPDATE users SET active_vpn=3 WHERE id=${ID[0]};"
log "Обрубаем скорость интернета до 1мбита"
limits "${ID[1]}" "${BITE_LIMIT}"
fi
done
exit 0

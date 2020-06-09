#!/bin/bash
#################################
#Скрипт контроля учетных записей#
#################################
#Контроль баланса юзеров	#
### Подключаем конфиг файл
source "/mnt/c/web/boostnet.ru/server/scripts.conf"
### Подключаем Функции
source "/mnt/c/web/boostnet.ru/server/functions"
#Дебаг
DEBUG="true"
##log - обычный лог
##log_e - ошибка
###


log "##################################Запуск NEW Client#########################################"


log "----------------------------------------------------------------------"
log "Ищем новых пользователей, не пустым балансом, для которых нужно создать VPN"
mysql_array "SELECT id,name,tarif_id,balance FROM users where active_vpn=0 and balance!=0 ORDER BY updated_at" | while read i; do
ID=($i)
log "ID ${ID[0]} Name ${ID[1]} Tarif ${ID[2]} Balance ${ID[3]}"
log "Ставим статус в процессе создания"
mysql_one "UPDATE users SET active_vpn=1 WHERE id=${ID[0]};"
log "Создаем аккаунт"

INT=$(($IP_NUM+1))
log "ID(IP)клиента ${INT}"
log "${INT}" > /etc/tunsafe/num
log "Генерируем ключи для клиента ${ID[1]}"
/usr/bin/tunsafe genkey | /usr/bin/tee ${KEYS_DIR}/${1}_private_key | /usr/bin/tunsafe pubkey > ${KEYS_DIR}/${1}_public_key
CLIENT_PRIVATE_KEY=`cat ${KEYS_DIR}/${1}_private_key`
CLIENT_PUBLIC_KEY=`cat ${KEYS_DIR}/${1}_public_key`
log "Публичный ключ: ${CLIENT_PUBLIC_KEY}"
log "Приватный ключ: ${CLIENT_PRIVATE_KEY}"

log "Собираем конфиг для пользователя"
echo "[Interface]" >> ${USER_CONF_DIR}/${1}.conf
echo "Address = 10.10.0.${INT}/24" >> ${USER_CONF_DIR}/${1}.conf
echo "PrivateKey = ${CLIENT_PRIVATE_KEY}" >> ${USER_CONF_DIR}/${1}.conf
echo "DNS = 8.8.8.8" >> ${USER_CONF_DIR}/${1}.conf
echo "" >> ${USER_CONF_DIR}/${1}.conf
echo "[Peer]" >> ${USER_CONF_DIR}/${1}.conf
echo "PublicKey = oDdrze88EEQ8kO71XHz42NDYRlhiL6xc7uha49EPhGE=" >> ${USER_CONF_DIR}/${1}.conf
echo "AllowedIPs = 10.10.0.${INT}/24" >> ${USER_CONF_DIR}/${1}.conf
echo "Endpoint = 90.188.116.11:35053" >> ${USER_CONF_DIR}/${1}.conf
echo "PersistentKeepalive = 20" >> ${USER_CONF_DIR}/${1}.conf

log "Временно добавляем ПИРА в конфиг сервера"
/usr/bin/tunsafe set tun0 peer "${CLIENT_PUBLIC_KEY}" allowed-ips 10.10.0.${INT}/32

log "Обновляем инфу в БД"
mysql_one "UPDATE users SET active_vpn=2,private_key=\"${CLIENT_PRIVATE_KEY}\",public_key=\"${CLIENT_PUBLIC_KEY}\",address=\"10.10.0.${INT}/32\" WHERE id=${ID[0]};"
log "Впихуеваем ограничения согласно тарифу, если не выбран. То скорость по умолчанию 1 мбит"


#limits "${ID[1]}" "${BITE_LIMIT}"
#Уведомляем пользователя 1-ID,2-Тип,3-Заголовок,Текст
reports "${ID[0]}" "1" "Создание VPN аккаунта" "VPN аккаунт создан, инструкции по подключению находятся в личном кабинете."
fi

done

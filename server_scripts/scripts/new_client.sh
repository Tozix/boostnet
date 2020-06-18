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


log "##################################Запуск NEW Client#########################################"


log "----------------------------------------------------------------------"
log "Ищем новых пользователей, не пустым балансом, для которых нужно создать VPN"
mysql_array "SELECT id,name,tarif_id,balance FROM users where active_vpn=0 and tarif_id!=0 or active_vpn=8 and tarif_id!=0  ORDER BY updated_at" | while read i; do
ID=($i)
log "ID ${ID[0]} Name ${ID[1]} Tarif ${ID[2]} Balance ${ID[3]}"
log "Ставим статус в процессе создания"
mysql_one "UPDATE users SET active_vpn=1 WHERE id=${ID[0]};"
log "Создаем аккаунт"
#Хапаем свбодный IP
IP=`mysql_one "SELECT ipAddress FROM accounts where status=0 ORDER BY id limit 1"`

log "Генерируем ключи для клиента ${ID[1]}"

CLIENT_PRIVATE_KEY=`${TUNSAFE} genkey`
CLIENT_PUBLIC_KEY=`echo ${CLIENT_PRIVATE_KEY} | ${TUNSAFE} pubkey`
echo "Публичный ключ: ${CLIENT_PUBLIC_KEY}"
echo "Приватный ключ: ${CLIENT_PRIVATE_KEY}"

echo "Обновляем инфу в таблице accounts (Фиксируем за юзером IP адрес)"
mysql_one "UPDATE accounts SET status=1,user_id=${ID[0]},private_key=\"${CLIENT_PRIVATE_KEY}\",public_key=\"${CLIENT_PUBLIC_KEY}\" WHERE ipAddress=\"${IP}\";"

echo "А теперь запрашиваем активные сервера для добавления временного конфига на каждый сервер"
mysql_array "SELECT id FROM servers where status=1" | while read i; do
SERVER=($i)
#Добавляем в таблицу НОВЫХ аккаунтов
mysql_one "INSERT INTO new_accounts(user_id,server_id,ipAddress,public_key) VALUES ('${ID[0]}', '${SERVER[0]}','${IP}','${CLIENT_PRIVATE_KEY}');"
done

done

#Мониторинг юзеров Новосозданных#
mysql_array "SELECT id FROM users WHERE active_vpn=1" | while read i; do
ID=($i)
A_NUM=`mysql_one "SELECT COUNT(*) FROM new_accounts WHERE user_id=${ID[0]}"`
#Если кол-во
if [ "${A_NUM}" -eq "0" ]
then
echo "Юзверьей для создания новых временных аккаунтов больше нет, меняем статус аккаунта"
mysql_one "UPDATE users SET active_vpn=2 WHERE id=${ID[0]};"
reports "${ID[0]}" "1" "Создание VPN аккаунта" "VPN аккаунт создан, инструкции по подключению находятся в личном кабинете."
fi 
done
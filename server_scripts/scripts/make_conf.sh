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
check_d ${TUN_CONF_DIR}/backup
check_f ${CONF_PATH}
DATE=$(date +"%y-%m-%d")
cp ${CONF_PATH} "${TUN_CONF_DIR}/backup/back_${DATE}.conf"
#Чистим конфиг
echo > ${CONF_PATH}
log "Пишем шапку конфига"
echo "[Interface]" >> ${CONF_PATH}
echo "Address = 10.10.0.1/24" >> ${CONF_PATH}
echo "PrivateKey = 4MSZSnRY07oCrObJw8SHjWVfT+xpr7dByKBS0HOBzHI=" >> ${CONF_PATH}
echo "PostUp = iptables -A FORWARD -i %i -j ACCEPT; iptables -A FORWARD -o %i -j ACCEPT; iptables -t nat -A POSTROUTING -o ${IF1} -j MASQUERADE" >> ${CONF_PATH}
echo "PostDown = iptables -D FORWARD -i %i -j ACCEPT; iptables -D FORWARD -o %i -j ACCEPT; iptables -t nat -D POSTROUTING -o ${IF1} -j MASQUERADE" >> ${CONF_PATH}
if ! [[ -z ${IF2} ]];then
echo "PostUp = iptables -A FORWARD -i %i -j ACCEPT; iptables -A FORWARD -o %i -j ACCEPT; iptables -t nat -A POSTROUTING -o ${IF2} -j MASQUERADE" >> ${CONF_PATH}
echo "PostDown = iptables -D FORWARD -i %i -j ACCEPT; iptables -D FORWARD -o %i -j ACCEPT; iptables -t nat -D POSTROUTING -o ${IF2} -j MASQUERADE" >> ${CONF_PATH}
fi
echo "ListenPortTCP=5555" >> ${CONF_PATH}
echo "ListenPort = 35053" >> ${CONF_PATH}
echo " " >> ${CONF_PATH}
#Очищаем цепочку FORWARD
${IPTABLES} -F FORWARD
#Удалем списки IPSET
${IPSET} -X
#Запрещаем обмен пакетами между подсетями с 10.10.0.1 по 10.10.255.255
${IPTABLES} -A FORWARD -s 10.10.0.1/16 -d 10.10.0.1/16 -j DROP
log "Формируем список активных аккаунтов"
mysql_array "SELECT id,name,tarif_id FROM users where active_vpn=2" | while read i; do
ID=($i)
#Создаем новый список в IPSET
${IPSET}} -N ${ID[1]} iphash
mysql_array "SELECT public_key,ipAddress FROM accounts where status=1 and user_id=${ID[0]}" | while read i; do
USER=($i)
#Добавляем IP в список IPSet
${IPSET} -A ${ID[1]} ${USER[1]}
#Добавляем IP в конфиг tunsafe
echo "Добавляем ПИРА в конфиг сервера"
echo "" >> ${CONF_PATH}
echo "[Peer]" >> ${CONF_PATH}
echo "#Peer #${ID[1]}" >> ${CONF_PATH}
echo "PublicKey = ${USER[0]}" >> ${CONF_PATH}
echo "AllowedIPs = ${USER[1]}/32" >> ${CONF_PATH}
done
#Формируем правила. Разрешаем доступ между юзеркими сетями
${IPTABLES} -I FORWARD -m set --match-set ${ID[1]} src,dst -j ACCEPT
######Въебываем лимиты в соответсвии с таблицей
BITE_LIMIT=`mysql_one "SELECT speed FROM tarifs where id=${ID[2]} limit 1"`
#Чистим ограничения
if [ -f /proc/net/ipt_ratelimit/${ID[1]}_download ];then echo / > /proc/net/ipt_ratelimit/${ID[1]}_download; fi
if [ -f /proc/net/ipt_ratelimit/${ID[1]}_upload ];then echo / > /proc/net/ipt_ratelimit/${ID[1]}_upload; fi
IPS=`${IPSET} ${ID[1]} -L  | sed '1,/Members/ d' | tr -s '\r\n' ',' | sed 's/.$//'`
#Скачка (Download)
${IPTABLES} -A FORWARD -m ratelimit --ratelimit-set ${ID[1]}_download --ratelimit-mode src -j DROP
echo @+${IPS} ${BITE_LIMIT} > /proc/net/ipt_ratelimit/${ID[1]}_download
#Загрузка (Upload)
${IPTABLES} -A FORWARD -m ratelimit --ratelimit-set ${ID[1]}_upload --ratelimit-mode dst -j DROP
echo @+${IPS} $((${BITE_LIMIT} / 2)) > /proc/net/ipt_ratelimit/${ID[1]}_upload
done

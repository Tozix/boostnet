client
dev tun
proto tcp
connect-retry -1
connect-timeout 5
resolv-retry infinite
nobind
persist-key
persist-tun
remote-cert-tls server
comp-lzo
cipher AES-256-CBC
auth-nocache
auth-user-pass login.dat

<connection>
remote {{ $server_adr1 }} {{ $server_port }}
</connection>
<connection>
remote {{ $server_adr2 }} {{ $server_port }}
</connection>
<connection>
remote {{ $server_adr3 }} {{ $server_port }}
</connection>
<connection>
remote {{ $server_adr4 }} {{ $server_port }}
</connection>

<ca>
-----BEGIN CERTIFICATE-----
MIIEszCCA5ugAwIBAgIJAOB42FmjmKN9MA0GCSqGSIb3DQEBCwUAMIGXMQswCQYD
VQQGEwJSVTELMAkGA1UECBMCVE8xDjAMBgNVBAcTBVRvbXNrMRAwDgYDVQQKEwdm
cmVlbmV0MRAwDgYDVQQLEwdmcmVlbmV0MRMwEQYDVQQDEwpmcmVlbmV0IENBMRAw
DgYDVQQpEwdFYXN5UlNBMSAwHgYJKoZIhvcNAQkBFhFmcmVlbmV0QGdtYWlsLmNv
bTAeFw0xNzA0MDQwNzQ2NDFaFw0yNzA0MDIwNzQ2NDFaMIGXMQswCQYDVQQGEwJS
VTELMAkGA1UECBMCVE8xDjAMBgNVBAcTBVRvbXNrMRAwDgYDVQQKEwdmcmVlbmV0
MRAwDgYDVQQLEwdmcmVlbmV0MRMwEQYDVQQDEwpmcmVlbmV0IENBMRAwDgYDVQQp
EwdFYXN5UlNBMSAwHgYJKoZIhvcNAQkBFhFmcmVlbmV0QGdtYWlsLmNvbTCCASIw
DQYJKoZIhvcNAQEBBQADggEPADCCAQoCggEBAJY4voUhP7V+8pCVcYUP1kHz4SZz
1h8s+/Q1I2SiGDzSWPvCbwOt4yVhWe8Yps0MXLBiZDgjDzB/p6VKpAgGqCWSPT3Y
N+NtyKBFScaauxSXo7OLe9j9mdgotS37tNHJ7dtd0O3jtOjFgPnWz6p7dj6sMIsl
P2q5HIeywSpyxQjIotEEqZxtVcsb0g1STlOyExUl/QJfcTD8c4h9c0HCNHO4rNCE
9HLewj1utGCcakm3fpkfqz3yFpgxNjxZ4YyfEKs7M2NU6SMHIZ+aCJBL2QmHLJhq
7VSniyWELumNTkYsJjHh7BrkuuZ8LhExKlE45w3aKSwyEwRlG/JKGzJye98CAwEA
AaOB/zCB/DAdBgNVHQ4EFgQU7Mg3FvLjHEeZL9MbrvfhM8Y9lTowgcwGA1UdIwSB
xDCBwYAU7Mg3FvLjHEeZL9MbrvfhM8Y9lTqhgZ2kgZowgZcxCzAJBgNVBAYTAlJV
MQswCQYDVQQIEwJUTzEOMAwGA1UEBxMFVG9tc2sxEDAOBgNVBAoTB2ZyZWVuZXQx
EDAOBgNVBAsTB2ZyZWVuZXQxEzARBgNVBAMTCmZyZWVuZXQgQ0ExEDAOBgNVBCkT
B0Vhc3lSU0ExIDAeBgkqhkiG9w0BCQEWEWZyZWVuZXRAZ21haWwuY29tggkA4HjY
WaOYo30wDAYDVR0TBAUwAwEB/zANBgkqhkiG9w0BAQsFAAOCAQEAd+wMvZAWuYap
ZeCbetQ5skCxiKS+HGNmw5b9HR9PzScTWnHWvLbk5ksCF/tDRBqdVm5xM1uT+DvC
mAtNeKwB5V8ZuEYpZGfhCGL+oXaNWmk4afZCM7oyc/vbBGlFu5XIu7XKCKhtC8oE
yPsz5kBkM6xOAPw9aS10G8PeGPCtuql/cehaRoZk4hu+S+j2UIeqE59Yr/dnSq3n
NFUYqN1Q2PNLvfhANbeRL+4l5kZpfX14rODt+UwgBXS8wVjWSfyE4AFeRqCwbXs7
AE826VszTe8FeUB9PGbSru/dBET96N+0P1ztXme9OglXIbUDd9xHzI8L2P4cpszB
uzbz39Zv6Q==
-----END CERTIFICATE-----
</ca>
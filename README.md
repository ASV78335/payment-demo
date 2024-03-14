CURL запросы для ручного тестирования: 

curl --location 'http://127.0.0.1:80/calculate-price' \
--header 'Content-Type: application/json' \
--data '{"product": 1,
"taxNumber": "GR123456789",
"couponCode": "3X3GPYG4"
}'

curl --location 'http://127.0.0.1:80/purchase' \
--header 'Content-Type: application/json' \
--data '{"product": "1",
"taxNumber": "DE123456789",
"couponCode": "ISDEK437",
"paymentProcessor": "paypal"
}'

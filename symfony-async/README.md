docker-compose up -d
symfony server:start -d
symfony open:local:webmail
php bin/console debug:autowiring messenger

symfony console messenger:consume async -vv

symfony console messenger:failed:show

messenger:failed:show {id} --transport=failed -vv

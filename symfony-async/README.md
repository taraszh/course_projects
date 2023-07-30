docker-compose up -d
symfony server:start -d
symfony open:local:webmail
php bin/console debug:autowiring messenger

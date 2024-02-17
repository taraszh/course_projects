# The Bookstore API

is a simple robust RESTful web service designed to manage information about
books and their respective authors. The API allows users to perform CRUD
operations on both books and authors, facilitating seamless integration into
various applications.

In order to run application:

switch to app directory
execute: docker compose up -d
execute: docker compose exec app bin/console doctrine:migrations:migrate
use endpoints described below, using host http://localhost:81/

heplers:
docker compose exec app bin/console doctrine:migrations:diff

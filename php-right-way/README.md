### Learn PHP The Right Way Course Project
This repository contains the source code of the project from the fourth/project section of the [Learn PHP The Right Way](https://youtube.com/playlist?list=PLr3d3QYzkw2xabQRUpcZ_IBk9W50M9pe-) series from YouTube. 


### Tips
* Make sure to run `composer install` & `npm install` after you pull the latest changes or switch to a new branch so that you are always using the same versions of dependencies that I do during the lessons
* Run `npm run dev` if you want to build assets for development
* Run `npm run build` if you want to build assets for productions
* Run `npm run watch` if you want to build assets during development & have it automatically be watched so that it rebuilds after you make updates to front-end
* Run `docker-compose up -d --build` to rebuild docker containers if you are using docker to make sure you are using the same versions as the videos

docker-compose up -d --build


docker rm -vf $(docker ps -aq)
docker rmi -f $(docker images -aq)


docker exec -it expennies-app bash

    php expennies migrations:migrate
    
npm install

npm run dev

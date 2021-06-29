docker ps
docker-compose up -d  
docker-compose down
docker-compose restart
docker volume ls
docker volume inspect VOLUME_NAME
docker logs CONTAINER_NAME
docker exec -it CONTAINER_APACHE /bin/bash
docker exec -i CONTAINER_MYSQL mysql -uUSERNAME -pPASSWORD DBNAME < ~/pathto/file.sql
docker exec CONTAINER_PHP php artisan


#production
docker-compose -f docker-compose.prod.yml up -d
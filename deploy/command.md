./command run shop

docker build -t shop-app -f Dockerfile.shop .

docker build --no-cache -t shop-app -f Dockerfile.shop .

docker exec -it ce996589db83ae1cc5ea0dbe73881af642350c777fbb04b144a64fe2f3eb75c2 cat /var/www/html/storage/logs/laravel.log
./command run shop
./command run demo

docker build -t shop-app -f Dockerfile.shop .

docker build --no-cache -t shop-app -f Dockerfile.shop .

docker exec -it ce996589db83ae1cc5ea0dbe73881af642350c777fbb04b144a64fe2f3eb75c2 cat /var/www/html/storage/logs/laravel.log


方法三：使用 & 和 disown 命令
这种方法利用了 Shell 的特性，将进程放入后台并断开与终端的关联。

步骤：

在命令后添加 &，将其放入后台运行：

bash
php artisan serve &
断开进程与终端的关联：

bash
disown -h %1
%1 表示作业号，如果这是你启动的第一个后台任务，则为 %1。

你可以使用 jobs -l 查看所有作业及其编号。
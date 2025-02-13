# drinkshop

這是一個練習用的飲料商店。

## 專案說明

此專案包含兩部分：
- **vue.spa**：前端單頁應用程式，位於 `application/client`。
- **laravel.api**：後端 API 專案，位於 `services/shop`。
- **詳細文件**：可以參考 `./docs` 目錄下的說明文件。

## 部署說明

1. 進入部署目錄：
   ```bash
   cd ./deploy/demoshop
2. 執行指令：
    ```bash
    ./command
執行後會通過powershell運行dockercompose來啟動兩個容器：
- nginx：負責前端 vue.spa
- php-fpm：運行後端 laravel.api
- 完成後，可以透過瀏覽器
[進行測試](http://127.0.0.1:8080/)

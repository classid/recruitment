<h1 align="center">Nge (Noob Edition)</h1>

Laravel project customized stack by DigitalEntropy.

### Requirements : 
 - Docker 
   <br>or <br>
 - PHP 8
 - Swoole Extensions
 - NodeJS 14 or newer
   

### Quick Start :
```shell
cp .env.example .env
./nge artisan key:generate
./nge install
./nge up
```
open https://localhost:8000 in your favorite browser.

### FAQ : 

> Q : where is routes folder ?. <br>
> A : we replace default laravel router with our own custom route [here](https://github.com/digital-entropy/yalr). 
> you can saw all the routes in config/routes.php  

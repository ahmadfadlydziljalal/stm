<p align="center">
    <a href="https://github.com/yiisoft" target="_blank">
        <img src="https://avatars0.githubusercontent.com/u/993323" height="100px">
    </a>
    <h1 align="center">TMS Starter</h1>
    <br />
</p>

TMS Starter dibuat menggunakan [Yii2](http://www.yiiframework.com/), dengan basic template.
Dirancang oleh [ Dzil ](https://github.com/ahmadfadlydziljalal), dengan tujuan utamanya adalah membantu proses
bisnis di TMS Group terutama di PT. Pelayaran Tresnamuda Sejati.


REQUIREMENTS
------------

- PHP: minimal 8.1.5
- Composer: minimal 2.4.1
- Docker: minimal 20.10.13 
- Docker Compose: minimal 1.29.2


INSTALLATION
------------

### GIT Clone

~~~
git clone git@github.com:ahmadfadlydziljalal/tms-starter.git
~~~

Setelah berhasil meng-clone TMS Starter,
- Sesuaikan nama project nya, misalnya untuk operation, maka foldernya di rename saja sebagai berikut, tms-starter => operation.
- Copy .env-example ke .env, lalu sesuaikan dengan kebutuhan
- Reinit saja project, dengan cara menghapus folder .git, kemudian `git init` ulang


#### Install with Docker
Build images yang dibutuhkan dengan cara mengetikkan perintah pada direktori root project:

```
docker-compose -f docker-compose.yml -f docker-compose.sass.yml -f docker-compose.chrome.yml up --build -d
```
    
Init migration untuk database

```
docker exec -it tms-starter-php php yii migrate
```
 
Sekarang aplikasi sudah bisa diakses via:
```
http://localhost:3000
```
    

**NOTES:** 
- Pada proses development, Port 3000 bisa diganti via file docker-compose.sass.yml
- Pada proses production, arahkan ke docker container php


CONFIGURATION
-------------

### Database

Karena TMS Starter berdasarkan Yii2 basic,
semua setting database sudah di sesuaikan untuk kebutuhan perusahaan. 
Tetapi konfigurasi masih bisa dimodifikasi via .env file


**NOTES:**
- Langsung dari official Yii2, Yii2 won't create the database for you, this has to be done manually before you can access it.
- Saat development, migration akan membuatkan database testing.

TESTING
-------

Tests are located in `tests` directory. They are developed with [Codeception PHP Testing Framework](http://codeception.com/).
By default, there are 3 test suites:

- `unit`
- `functional`
- `acceptance`

Konfigurasi database untuk keperluan testing ada di `config/test_db.php`.
Untuk menjalankan testing, ketik perintah berikut satu per satu

```
docker exec -it tms-starter-php php tests/bin/yii migrate
```

```
docker exec -it tms-starter-php bash c run
```

Jika tidak ada konfigurasi yang salah, ketiga jenis testing tersebut akan jalan secara normal.

### Code coverage support

By default, code coverage is disabled in `codeception.yml` configuration file, you should uncomment needed rows to be able
to collect code coverage. You can run your tests and collect coverage with the following command:

```
#collect coverage for all tests
vendor/bin/codecept run --coverage --coverage-html --coverage-xml

#collect coverage only for unit tests
vendor/bin/codecept run unit --coverage --coverage-html --coverage-xml

#collect coverage for unit and functional tests
vendor/bin/codecept run functional,unit --coverage --coverage-html --coverage-xml
```

You can see code coverage output under the `tests/_output` directory.
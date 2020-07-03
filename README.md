## About the installation

01. mkdir <папка проекта> && cd <папка проекта>
02. git clone https://github.com/MyskinD/docker-laravel.git . - клонируем репозиторий
03. docker run --rm -v $(pwd):/app composer install - подтягиваем зависимости через контейнер-компойзер
04. sudo chown -R $USER:$USER <папка проекта> - задаем права пользователя на каталог проекта (не root)
05. в папке mysql создаем папку dbdata - для сохранения данных БД
06. cp .env.example .env
07. указываем в .env и docker-compose.yml настройки по усмотрению (название БД, имя пользователя, пароль)
08. docker-compose up -d - поднимаем контейнеры
09. docker-compose exec app php artisan key:generate - генерируем ключ
10. docker-compose exec app php artisan config:cache - кэшируем настройки (при необходимости)
11. в /etc/hosts и /<папка проекта>/nginx/conf.d/app.conf указываем имя сервера

#### ===============================

01. docker-compose exec db bash - создаем пользователя mysql
02. mysql -u root -p - ввозим пароль рута, указанного в docker-compose.yml
03. show databases; - проверяем существование БД
04. CREATE USER '<логин>'@'localhost' IDENTIFIED BY '<пароль>'; - создаем пользователя по данным из .env
05. GRANT ALL PRIVILEGES ON <имя БД>.* TO '<логин>'@'localhost'; - задаем права на указанную базу
06. FLUSH PRIVILEGES; - применяем новые права пользователя
07. SHOW GRANTS FOR <логин пользователя>@localhost; - проверяем назначенные права пользователю
08. exit - выходим из БД и контейнера
09. docker-compose exec app php artisan migrate - запускаем миграции

#### ===============================

01. docker-compose exec app php artisan tinker - запускаем tinker для проверки работоспособности БД
02. \DB::table('migrations')->get(); - выводит все строки в табилце
03. exit - выходим 

## About the project

01. бизнес логика приложения расположена в сервисном слое
02. бизнес логика работы с базой данных лежит в репозитории
03. контроллеры и модели остаются тонкими
04. реализовал свою валидацию
05. получение данных с сайта донора через GrabberController
06. вывод данных на наш сайт через CarsController
07. зависимости декларированы через сервис провайдер
08. таблица, для полученных данных и сохранения их в базе, содается через миграции
09. для вывода полученных данных подключен к шаблонам bootstrap4
10. laravel развернут из коробки, ничего не удалял, добавил только свою реализацию задачи.
11. для работы с сайтом донером подключил стороннюю библиотеку Simple Html Dom
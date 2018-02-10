# RUN APPLICATION

Build/run containers:

    $ git clone git@github.com:taras-by/php-skeleton.git
    $ cd php-skeleton
    $ docker-compose build
    $ docker-compose up -d 
    $ docker-compose exec --user="www-data" app composer install

Run application: http://localhost:835
    
# Symfony 4 - Rest API

Create a Movies DB app where movies could be added and removed and for each movie 
we have a title and release year. Store all the data in the DB. 
API: 
/addmovie/{title}/{releaseYear} adds new movie if movie is already there display an error 
/removemovie/{title} removes movie from the DB if the movie is not there display an error

# Requirements

```
PHP 7.2.* <br/>
MYSQL <br/>
```

# Create Symfony Project

```
composer create-project symfony/skeleton  {project_name}
```

# Check Install

```
cd project_name

php -S 127.0.0.1:8000 -t public
```

# Bundle install

```
composer require symfony/orm-pack <br/>
composer require sensio/framework-extra-bundle <br/>
composer friendsofsymfony/rest-bundle <br/>
composer require symfony/maker-bundle --dev <br/>
composer require symfony/property-access <br/>
```

# Create Database

mysql -u root -p  <br/>
CREATE DATABASE {your_database} CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci; <br/>
quit

# Add Parameter in .env

DATABASE_URL=mysql://root@127.0.0.1:3306/{your_database} 

# Create Entity

Create Entity/Repository Movie <br/>
php bin/console make:entity

Generator Migrate <br/>
php bin/console make:migration

Run Migrate <br/>
php bin/console doctrine:migrations:migrate


# Run APP

php -S 127.0.0.1:8000 -t public

# bidrento
Blog app

To run this app:
 # Clone project to some folder
 cd some_folder/
 
 git clone ...
 
 # make Composer install dependencies
 cd bidrento/
 
 composer install
 
 #You’ll probably also need to customize your .env file
 
 # Create database
 php bin/console doctrine:database:create
 
 # Make a migration
 php bin/console make:migration
 
 # Execute migration
 php bin/console doctrine:migrations:migrate
 
 # Run project
  symfony server:start
------------------------------------------------------
In this project no time was devoted to write css and all templates have very basic structure.
For security i used a symfony security-bundle (https://symfony.com/doc/current/security.html)

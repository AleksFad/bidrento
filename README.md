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

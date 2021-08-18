# Project Laravel
  You are can see my code here https://github.com/nguyenmanhquan782001/  
  This project runs with Laravel version 8.0.6
# Get started  
  Your php version should be >= 7.3. 
  You can refer to https://laravel.com 

  **Step 1**

  Git clone the repository 

     git clone https://github.com/nguyenmanhquan782001/trainning. 

   **Step 2**

Switch to collect the clone king 

     cd trainning
 **Step 3**

 Because when downloading, there are no vendor or node module files,
 so you have to install.

 With vendor of Laravel. 

     composer install  

With node module 

     npm install       
       Or                
     yarn install

**Step 4**

  Copy the example env file and make the required configuration changes in the .env file

     cp .env.example .env 

   and config .env:

     DB_CONNECTION=mysql
     DB_HOST=127.0.0.1
     DB_PORT=3306
     DB_DATABASE=my_name_database
     DB_USERNAME=my_username
     DB_PASSWORD=my_password

**Step 5**

  Create database with mysql or navicat. 

**Step 6** 

   Run migration 
    
     php artisan migrate
**Step 7** 
   
   Run serve 
   
     php artisan serve



















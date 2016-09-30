# _Shoes_

#### _Web App to keep track of shoe stores and the brands each store carries, 30 September 2016_

#### By _**Joshua Huffman**_

## Description

_This web app allows a user to create a list of shoe stores and a list of shoe brands. The user can then match stores to brands so one can see what brands a store carries and what stores carry a particular brand. This project is the Independent Project for week 4 of the Epicodus PHP class._

## Setup/Installation Requirements

* Clone repository to computer
* Run composer install to install project dependencies
* Import 'shoes' database into SQL server
* Edit app/app.php line "$server = 'mysql:host=localhost;dbname=shoes';" to add port used for mysql server in your configuration after localhost
* Edit next two lines to reflect mysql username and password on your local configuration
* Start a web server with web/ as the root, can run "php -S localhost:8000" from terminal while within shoes/web
* Visit localhost:8000 on your web browswer

## Database Setup
If unable to import database run the following SQL commands to recreate database:
  * CREATE DATABASE shoes;
  * USE shoes;
  * CREATE TABLE stores (id serial PRIMARY KEY, store_name varchar (255));
  * CREATE TABLE brands (id serial PRIMARY KEY, brand_name varchar (255));
  * CREATE TABLE brands_stores (id serial PRIMARY KEY, brand_id int, store_id int);

  Then copy 'shoes' structure to 'shoes_test'

## Specifications
  Behavior|Input|Output
  --------|-----|------
  create a new Store|Payless|Payless
  delete a Store|Payless|0
  list an individual store|store 1|Payless
  list all stores|Stores|Payless, Famous Footwear
  delete all stores|Delete Stores|0
  update a store name|Payless to Paymore|Paymore
  create a new Brand|Nike|Nike
  list a brand|brand 1|Nike
  list all brands|Brands|Nike, Reebok
  associate a brand with a store|Nike to Payless|Payless:Nike
  list all brands for a store|Payless|Nike, Reebok
  list all stores which carry a brand|Nike|Payless, Famous Footwear

## Known Bugs
  SQL queries are not sanitized, will refactor project to use PDO prepared statements instead of directly inserting user input into queries. In current state project is vulnerable to SQL injection and some inputs will just cause query to fail.

## Support and contact details

_Contact me at j.m.huffman@gmail.com with any comments or questions_

## Technologies Used

_This project is writen in PHP and uses the silex framework and twig for templating._

### License

*MIT License*

Copyright (c) 2016 **_Joshua Huffman_**

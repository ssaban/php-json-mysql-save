php-json-mysql-save
===================

# General
json_read.php script fetch an object in JSON format from an endpoint given as an argument
and store the object in MySql data base.

script was tested under MAMP webserver installed on Mac OS 10.9.2.
MAMP downloaded from http://www.mamp.info/en/ and installed under
/Applications/MAMP

MAMP localhost sql server is on port 8889
MAMP localhost apache server is on port 8888
Apache document root is under /Applications/MAMP/htdocs

to run php [SCRIPT.php]  from localhost url  http://localhost:8888/[SCRIPT.php]?[PARAMETERS FOR SCRIPT.php]


# Files
1. json_object_[I].json  [I]={ 1, 2, 3 }   - three json object files used for testing.
2. db_setup.php - initial setup of testdb and json_data table (That will hold info read from json objects)
3. json_read.php - the solution script

# Solution and activation
1. initialization

run db_setup.php (http://localhost:8888/db_setup.php) to perform one time setup for:

1.1. create dbname=testdb

1.2. create table json_data with fileds: id, name, value, timestame, and set name and id to be the primary key


2.fetch JSON object from endpoint given as an argument and store in json_data table in testdb
run json_read.php and pass in 'json_url'  argument the endpoint location for the json object to store.

script can be activated from both browser and command line (such that can be run as cron job)

assuming json_object.json is located under apache document root (per described in General section above)
to activate from command line script to extract info from json_object_1.json do:

   curl http://localhost:8888/json_read.php?json_url=http://localhost:8888/json_object_1.json

to activate from browser do

   http://localhost:8888/json_read.php?json_url=http://localhost:8888/json_object_1.json


Program Requierments:
# Program task:
- fetches an object in JSON format from an endpoint given as an argument
- stores the object in a mysql db (mysql:host=localhost;dbname=testdb;, user: user, password: passwd)

# Working assumptions :
- in production, the script will be run of crond on a minute frequency
- object JSON format: {"name":"","id":0,"value":"","timestamp":""}, where id and name are unique.


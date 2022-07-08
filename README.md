# moodleCCFApi
PHP Api for retrieve course custom fields data from Moodle

## Instalation
Put **fieldsapi** folder in your webroot folder, where all the Moodle stuff is placed. If this structure is respected, the database configuration is obtained from the moodle config.php file.

## How to use
http:://yourmoodle.com/fieldsapi/api.php/fields/get?token={**TOKEN**}&id={**COURSE_ID**}

If the course exists, it will return a json formatted response with the list of all custom fields names and values for the course ID given.

## Copyright notice
This api is an adaptation of the original code by [Sajal Soni](https://tutsplus.com/authors/sajal-soni) published [here](https://code.tutsplus.com/tutorials/how-to-build-a-simple-rest-api-in-php--cms-37000). Feel free to modify or upgrade this code at your discretion.

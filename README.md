# Base7Booking Landing Page

Multilanguage landing page project with form that stores leads into a database

## What I did for this project

* Created a PHP script to connect to the database
* Wrote validation scripts that check if the data entered is in the proper format
* Added a SQL query that pushes the form content into the database
* Created if / else architecture to display Success or Error message according to the data entered
* Added telephone section displaying phone information
* Added Custom Fields to dynamify the template
* Used qTranslatex plugin to translate the dynamic content and display the proper information according to the language
* Added a Langage Selector to allow the user to switch languages

## How to get it to work

### Getting the WP install ready

1. Import the database.sql file
2. Add the wordpress file 

### Getting the form to store data

1. Import the migration.sql file

### Credentials and database information

#### WP Information

The WP id is : base7booking
The WP pwd is : base7booking

#### Leads database

These information can be found and modified on line 38 to 41 of template-landingpage.php

The server is : localhost
The user is : root
The pwd is : root
The database name is : marketingLead

Thanks
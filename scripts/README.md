# Database setup scripts

These are instructions for creating the Templates table and populating it with some initial data to help with testing and demonstrations.

## Create tables by running the create_tables SQL script

/Applications/XAMPP/bin/mysql -uroot -DHappyTech < create_tables.sql

## Pre-populate the Templates table by running the populate_templates SQL script

/Applications/XAMPP/bin/mysql -uroot -DHappyTech < populate_templates.sql

## Pre-populate the Roles table by running the populate_roles SQL script

/Applications/XAMPP/bin/mysql -uroot -DHappyTech < populate_roles.sql

## Delete all tables by running the delete_tables SQL script

/Applications/XAMPP/bin/mysql -uroot -DHappyTech < delete_tables.sql

# Setup
Before attempting to view the site, please do the following:

1. Open the config.php file, change the DB_PASSWORD to the password of your phpMyAdmin so the database can connect, save and close.
2. Log into phpMyAdmin, open the SQL tab and run the entire contents db.sql.
3. Now you should have a populated database called 'real_estate' and you can begin using the site.

# Documentation

## Database
[Database Schema](https://docs.google.com/spreadsheets/d/1skd8sPF0WfSo3pmhIPfwBniHJORSzYSg9VBqM903kiY/edit?usp=sharing "Google Sheets")
The schema shows the structure of the database before initial data is added. See db.sql for initial data.

## File Structure
The .php files in the root directory are page files, the files in the 'inc' folder are included in other files in the project (eg. database config, header, footer). Files in the 'process' folder are used for processing things such as logging in, logging out, adding properties to the database, removing a property from wishlist, etc. 

## Testing
### Different Browsers
On our local machines we were able to test the following browsers at a variety of screen sizes:

Windows 7
* Chrome 62
* Firefox 56
* IE Edge (11) and IE 10

MacOS
* Chrome 62
* Safari 10

There was a bug in IE 11 where the footer was coming halfway up the homepage due to the 'height' property in the body being set. When this was removed the footer went to bottom of the page on pages with enough content, but it stayed at the bottom of all the other pages. This bug was not present in IE 10. In IE 10, there is a style inconsistency where the menu moves out to the right.

The height property was defined as a way to create a sticky footer using flexbox, and appeared to work fine in the latest versions of Chrome and Firefox.

There were no bugs or problems with the MacOS browsers.

### Responsive Testing
Tested various screen sizes and orientations, [see screenshots](https://docs.google.com/document/d/1R6TL4tNGZMae2iB3TuKIy1v0kyxMpWN9pkmWN1ZrCfY/edit?usp=sharing)


### Unit Testing
Kat tested the login form, [here are the results](https://docs.google.com/document/d/1fwdmBwhWU-WT-Nll5rhmTdvEPUdM7a13FC43zQ2luOo/edit?usp=sharing).

Tayla tested the remove from wishlist function, [here are the results](https://docs.google.com/document/d/1cDbL2gRtjap_kUIEPJktXqsdDPMnuy9eASOJ1AiX-OY/edit?usp=sharing)


## Workload
Person 1 (Tayla) was required to create the search function and the wishlist functionality for a logged in user, view a single property and browse categories (we used cities as our categories).

Person 2 (Kat) was required to build the admin dashboard and the functionality behind adding/editing/deleting properties to and from the database. 

Shared tasks included the styling and register/login pages. We deligated these tasks according to our areas of strength, Tayla did more of the styling/css, and Kat did more of the script behind register/login.

We both created the database schema and decided what cities and property types to use and what columns the 'properties' table needed. Based on this, Kat came up with an inital draft of the schema and Tayla created the addresses and descriptions for properties (6 inital properties in the db).

Database was created in Google sheets (link above), we both created the tables and added data types.

## Colour Scheme
We chose gold as our primary colour as it is traditionally the colour of wealth, and the target market for Rich List Real Estate is the wealthy, since only they are able to afford to buy property in the current market... We kept the rest of the colour palette neutral/minimal (black, white, grey) so as not to overwhelm.

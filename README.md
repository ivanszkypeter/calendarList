# calendarList

This program list your calendars from Google Calendar. You need the give permission Google Calendar API permission to use it.

## How to use it?

First clone the repository:

     git clone https://github.com/ivanszkypeter/calendarList.git

Navigate into the new folder:

     cd calendarList

Download dependencies using composer:

     composer update
 
## Set up apache entry for the folder

Navigate into the sites-available folder.

     cd /etc/apache2/sites-available

Create an entry for calendarList.

     nano calandarList.conf

Copy and paste the following:

     Listen 8090

     <VirtualHost *:8090>

        DocumentRoot "[THE FOLDER ROUTE WHERE YOU INITIALIZED THE REPOSITORY]/calendarList/"

        ErrorLog ${APACHE_LOG_DIR}/calendar_error.log
        CustomLog ${APACHE_LOG_DIR}/calendar_access.log combined

     </VirtualHost>

Enable the site

     a2ensite calendarList.conf

Restart apache2 service.

     service apache2 restart

Now check `http://localhost:8090`.
     

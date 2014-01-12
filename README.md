Harambee
========

## Micro-crowdfunding site for African entrepreneurs ##

The goal of this project was to launch a crowfunding site (like Kickstarter or IndieGoGo) targeted to raising funds for entrepreneurs in Africa and other developing regions of the world.

It has been widely accepted that in the long term, the best way to aliviate poverty is to provide education, tools and investment to entrepreneurs. This creates jobs and sustainable growth in the region.

The implementation would need to go far beyond this website, with volunteers on the ground to verify local projects and vet recipients.

I've not done any work on this since May 2011, so the version of CodeIgniter in use will need updating and the layout syle could porbably be improved quite a bit.

If anyone would like to take this cause up I can be contacted at pete@europeaxess.com

Installation
------------

 1. I use [MAMP 2.2](http://www.mamp.info/en/downloads/) to develop locally so after cloning the repo on your development machine and installing MAMP, just set the Apache document root in MAMP Preferences to your Harambee folder and start the servers.

 2. Go to your MAMP phpMyAdmin page http://localhost:8080/MAMP/ navigate to the 'Users' tab and create a new MySql user 'harambee', set a password and select the 'Create database with same name..' radio button.

 3. Navigate to the 'Databases' tab, click on harambee in the list of local DBs and navigate to the 'Import' tab.

 4. Select the sql file from the repo '_Resources/harambee.sql' and click Go.

 5. Edit config/database.php, set the active_group to 'dev' and set the password you chose:

```php
$db['dev']['hostname'] = 'localhost';
$db['dev']['username'] = 'harambee';
$db['dev']['password'] = '';
$db['dev']['database'] = 'harambee';
```

 6. That's it, navigate to http://localhost:8080/ in your browser

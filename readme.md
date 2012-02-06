Smacky Tables
=============
***Smacky Tables is not intended for production usage, but as an example for KillerAdmin***

This is an example of how to build an *online table reservation system* with [Kohana](http://kohanaframework.org) and [KillerAdmin](https://github.com/digibart/killeradmin). *KillerAdmin* is a Kohana Module meant for rapid development of an admin-area for end-users.

This repository contains all the necessary modules and files to get it working out-of-the-clone, except the database configuration.


Features Smacky Table
---------------------

* Guests can book a table online
* Waitresses can see which table is booked by who. But they can only see the tables they serve.
* A cook can login, but only see how many tables are booked in the next seven days.
* The manager is able to add/delete tables, users, and reservations.

**And the build-in KillerAdmin features:**

* Validating the tables and reservation and nice error feedback
* Sorting, filtering, adding, editing, and deleting tables and reservations
* Specify which user-role can list, create, edit or delete objects
* Minified JS and CSS
* Reset password if a user forgets it.
* User can change it own information (email, and password in this case)
* Captcha against brute force logins.



Installation
------------

1. clone this repository (don't forget a `git submodule init` and `git submodule update`)
2. import `application/mysql.sql` into your database
3. copy `modules/database/config/database.php` to `application/config/production/database.php` and edit it.
4. Go to `http://domain/admin` and login with:

		username: admin
		password: smackytables

5. Add employees, tables and you're done.


A small tutorial/step-by-step guide of how Smacky Tables is made can be found on [github](https://github.com/digibart/killeradmin/blob/3.2/develop/guide/killeradmin/tutorial.md)
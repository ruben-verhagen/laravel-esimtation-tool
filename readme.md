# Simple Cost Estimation Tool for Housekeeping Services

## Built on Laravel 5.1 and Boostrap 3
* [Requirements](#feature2)
* [How to install](#feature3)
* [Application Structure](#feature4)
* [Troubleshooting](#feature5)
* [License](#feature6)
* [Additional information](#feature7)


-----
<a name="feature2"></a>
##Requirements

	PHP >= 5.5.9
	OpenSSL PHP Extension
	Mbstring PHP Extension
	Tokenizer PHP Extension
	SQL server(for example MySQL)
	Composer
	Node JS

-----
<a name="feature3"></a>
##How to install:
* [Step 1: Get the code](#step1)
* [Step 2: Use Composer to install dependencies](#step2)
* [Step 3: Create database](#step3)
* [Step 4: Install](#step4)
* [Step 5: Start Page](#step5)

-----
<a name="step1"></a>
### Step 1: Get the code - Download the repository

    https://github.com/ruben-verhagen/laravel-esimtation-tool/archive/master.zip

Extract it in www(or htdocs if you using XAMPP) folder and put it for example in laravel5startersite folder.

-----
<a name="step2"></a>
### Step 2: Use Composer to install dependencies

Laravel utilizes [Composer](http://getcomposer.org/) to manage its dependencies. First, download a copy of the composer.phar.
Once you have the PHAR archive, you can either keep it in your local project directory or move to
usr/local/bin to use it globally on your system.
On Windows, you can use the Composer [Windows installer](https://getcomposer.org/Composer-Setup.exe).

Then run:

    composer dump-autoload
    composer install --no-scripts

-----
<a name="step3"></a>
### Step 3: Create database

If you finished first three steps, now you can create database on your database server(MySQL). You must create database
with utf-8 collation(uft8_general_ci), to install and application work perfectly.
After that, copy .env.example and rename it as .env and put connection and change default database connection name, only database connection, put name database, database username and password.

-----
<a name="step4"></a>
### Step 4: Install

Firstable need to uncomment this line "extension=php_fileinfo.dll" in php.ini file.

This project makes use of Bower and Laravel Elixir. Before triggering Elixir, you must first ensure that Node.js (included in homestead) is installed on your machine.

    node -v

Install dependencies listed in package.json with:

    npm install --save-dev

Retrieve frontend dependencies with Bower, compile SASS, and move frontend files into place:

    gulp

Now that you have the environment configured, you need to create a database configuration for it. For create database tables use this command:

    php artisan migrate

And to initial populate database use this:

    php artisan db:seed

If you install on your localhost in folder laravel5startersite, you can type on web browser:

	http://localhost/laravel5startersite/public
-----
<a name="step5"></a>
### Step 5: Start Page

You can now login to admin part of Laravel Framework 5  Bootstrap 3 Starter Site:

    username: admin@admin.com
    password: admin
OR user

    username: user@user.com
    password: user

-----
<a name="feature5"></a>
## Troubleshooting

### RuntimeException : No supported encrypter found. The cipher and / or key length are invalid.

    php artisan key:generate

### Site loading very slow

	composer dump-autoload --optimize
OR

    php artisan dump-autoload

-----
<a name="feature6"></a>
## License

This is free software distributed under the terms of the MIT license

-----
<a name="feature7"></a>
## Additional information

Inspired by and based on [andrew13's Laravel-4-Bootstrap-Starter-Site](https://github.com/andrew13/Laravel-4-Bootstrap-Starter-Site)

----

## Stockdash

Stockdash is a simple application for managing the selection and review of individual stocks for investment. It's built primarily using [Laravel](http://laravel.com/).

I built it because I was tired of managing multiple different sources of information and wrangling tools in order to "process" individual names and keep a log of my past interactions with them. If you're interested, you can see the initial list of user stories I wrote for this project [here](https://github.com/gardnersmitha/stockdash/wiki/Spec). 


## Installation

You'll need a server/VM setup that supports Laravel and Node.js - an overview of required software is [here](https://laravel.com/docs/5.2/installation#server-requirements). We use the excellent [Homestead](https://laravel.com/docs/5.2/homestead) environment setup that's custom tailored to run Laravel really nicely out of the box. You can definitely do the same thing - just follow the instructions [here](https://laravel.com/docs/5.2/homestead).


### 1. Download & Install 

After your VM is setup, clone the repository into your desired directory on your local machine:

```
git clone https://github.com/gardnersmitha/stockdash.git MyStockdashApp
```


Change into your new project directory:

```
cd MyStockdashApp
```


Install PHP dependencies via [composer](https://getcomposer.org/):

```
composer install

```

Install other package dependencies via [npm](https://www.npmjs.com/):

```
npm install

```
If you have any issues, a more comprehensive Laravel installation guide can be found [here](https://laravel.com/docs/5.2/installation#installation).

<br/>
<br/>

##### 2. Configure

There are a couple of configuration tasks that need to be completed in order for the app to run. 

First, you will need to create a `.env` file in the root of your project directory. A sample file called `.env.example` is included with the repository. The easiest way to get started is to simply copy the contents of this file into a newly created `.env` file, and edit from there. 

The very first line of the `.env` file contains a variable called `APP_KEY` - this is an install-specific 32-byte key that Laravel uses for a number of functions. Laravel's artisan command suite provides a convenient way generate a key for your project. 

From your project directory, run the following command:

```
php artisan key:generate
```

Second, you'll want to make sure your database gets all set up and happy. Assuming you have your DB user and pass configured correctly in your `.env` file, this should be pretty quick and easy thanks to Laravel's migrations:

```
php artisan migrate
```

That's it. You should be abie to view a working version of stockdash in your browser. 

<br/>
<br/>

## Features

//TODO write feature docs


# A simple Task app with L5SimpleFM

This is a simple app built using Laravel to show how [L5SimpleFM](https://github.com/chris-schmitz/L5SimpleFM) can be used to access data from A FileMaker Server.

## Prerequisites

The following tools are required to run this project:

- [Laravel 5.1](http://laravel.com/docs/5.1)
- [Composer](https://getcomposer.org/)
- [PHP version 5.5 or newer](http://php.net/manual/en/install.php)
- [FileMaker Server version 13 or newer](http://www.filemaker.com/)
- [Git](https://git-scm.com/)

## Setup

At the moment this setup is written from the perspective of a mac user. If it gets traction I'll write it from a windows user perspective.

- Open a terminal and clone a copy of the project to your computer:

        cd ~/Desktop
        git clone https://github.com/chris-schmitz/TaskWithL5SimpleFM.git Tasks

- Navigate to the root of the project folder and run a composer install:

        cd ~/Desktop/Tasks
        composer install

- Download the `Task Database` FileMaker file [from the release section](https://github.com/chris-schmitz/TaskWithL5SimpleFM/releases) and host it on your FileMaker Server.


## Database Credentials

### Full Access Account
- Username: **Admin**
- Password: **admin!password**

NOTE: **If you're going to host this example file on a publicly accessible FileMaker server, CHANGE THE FULL ACCESS ACCOUNT PASSWORD!**

### Web Access Account
- Username: **web_user**
- Password: **webdemo!**


## Configuration

- In the terminal, navigate back to the root of your project Rename your `.env.example` file `.env`:

        cd ~/Desktop/Tasks/
        cp .env.example .env

- Run the command to generate the application key:

        php artisan key:generate

- In the Laravel project, review the `FM_` keys in the `.env` and adjust the `FM_HOST` address if needed:

            FM_DATABASE=Task Database
            FM_USERNAME=web_user
            FM_PASSWORD=webdemo!
            FM_HOST=127.0.0.1 # If you're FileMaker Server is not on your local machine, change this IP to the IP or host name of the Server
            


## Running it
- Navigate into the project's public folder and launch a php built in server:

        cd ~/Desktop/Tasks/public
        php -S localhost:8001
        
- Open a web browser and navigate to the url `http://localhost:8001`
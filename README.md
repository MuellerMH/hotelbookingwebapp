# Tutorial: How to Create Hotel Booking web app in PHP
Project Introduction:
This tutorial will cover all the details (resources, tools, languages etc) that are necessary to build a complete and operational Hotel Booking web app. You will be guided through all the steps and concepts, starting from the basic ones like setting up the right tools and frameworks to the more advanced topics related to the development. And ultimately you will be able to create your own Hotel Booking web app without any difficulty.
It is Live streamed on https://www.liveedu.tv/onko/lN60A-how-to-create-hotel-booking-web-app-in-php/

# Introduction:

This tutorial will cover all the details (resources, tools, languages etc) that are necessary to build a complete and operational Hotel Booking web app. You will be guided through all the steps and concepts, starting from the basic ones like setting up the right tools and frameworks to the more advanced topics related to the development. And ultimately you will be able to create your own Hotel Booking web app without any difficulty.

### What are the requirements?: 

* HTML/CSS/Bootstrap
* JavaScript/AngularJS v1
* Databases driven websites
* Basic PHP and SQL
* Docker

### What is the target audience?:

* Setup a environment for windows, mac, linux with docker
* You want to build database driven Hotel Booking web app.
* Learners who want to enhance their knowledge
* This course will help the students who are doing their final projects 

### When are the streaming sessions (streaming schedule)?

Weekly 20 pm UTC +1 Europe time on Monday

**Session 1:** In the first session we will setting-up the Environment with Docker Compose. PHP Unit and MariaDB 

* Setting up Docker
* Setting up PHP 7 with Docker
* Setting up PHPUnit with Docker
* Setting up MariaDB with Docker

**Session 2:** In the second session we create a database model, the PHP model and the PHP controller, and a simple micro service

* Database model
* PHP Model
* PHP Controller
* Simple micro service

**Session 3:** In the third session we create the frontend with booking form and call the micro service

* HTML main frame with Angular.js
* Formular for bookings
* Use MicroServices

**Session 4:** In this session we create a cancelation and edit form for booking

* Create cancelation from add cancelation rules
* Create edit form
* Create a user profile

_.. on going _
Create rooms and rates, cancelation policies, avaibility 

**Tools:**
Sublime
MySQL Workbench


# start phpunit testing
docker run -v c:\priv\hotelbookingwebapp:/app --rm phpunit/phpunit --bootstrap autoload.php tests
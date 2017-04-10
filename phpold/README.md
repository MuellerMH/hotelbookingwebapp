PHPDocker.io generated environment
==================================

#Add to your project#

  * Unzip the file.
  * Move the `phpdocker` folder into your project. You may rename this folder (see note below)
  * Ensure the webserver config on `docker\nginx.conf` is correct for your project. PHPDocker.io generates it either for a typical Symfony project (`web/app|app_dev.php`) or generic (`public/index.php`).

Note: you may place the files elsewhere in your project. Make sure you modify the volume linking on `docker-compose.yml` for both the webserver and php-fpm so that the folder being shared into the container is the root of your project. Also, if you're using the vagrant machine, modify accordingly the line after the `#Bring up containers` comment.
 
#How to run#

You have two options to run the environment, depending mainly on your host OS. Essentially, you can either run the containers on bare metal, or through a virtualised environment.
 
##Linux##

If you run Linux, you have both choices available to you. Running directly has certain advantages, not least of which the fact there's essentially zero overhead and full access to your system's muscle.

The advantage of running through a virtualised environment is mainly having your whole environment neatly packed into a single set of files for the virtual machine.

The choice is up to you. If you'd rather run the containers directly:

  * Ensure you have the latest `docker engine` installed. Your distribution's package might be a little old, if you encounter problems, do upgrade. See https://docs.docker.com/engine/installation/
  * Ensure you have the latest `docker-compose` installed. See [docs.docker.com/compose/install](https://docs.docker.com/compose/install/)
  
Once you're done, simply `cd` to the folder where you placed the files, then `docker-compose up -d`. This will initialise and start all the containers, then leave them running in the background.
  
##Other OS##

MacOS and Windows have no native support for docker containers. The way around this is to boot a minimal Linux virtual machine, then run the containers inside.

Whichever way to do this is entirely up to you, but PHPDocker.io already has you covered provided you have a recent version of [vagrant](https://www.vagrantup.com/) and [virtualbox](https://www.virtualbox.org/) installed.

Simply `cd` to the folder where you placed the files, then `vagrant up`. This will fire up [boot2docker](http://boot2docker.io/), then initialise the containers within. You can `vagrant ssh` to act on the containers from then on.

##Services exposed outside your environment##

You can access your application via **`localhost`**, if you're running the containers directly, or through **`192.168.33.68`** when run on a vm. nginx and mailhog both respond to any hostname, in case you want to add your own hostname on your `/etc/hosts` 

Service|Address outside containers|Address outside VM
------|---------|-----------
Webserver|[localhost:8088](http://localhost:8088)|[192.168.33.68](http://192.168.33.68)

##Hosts within your environment##

You'll need to configure your application to use any services you enabled:

Service|Hostname|Port number
------|---------|-----------
php-fpm|hotelbookingwebapp-php-fpm|9000
MySQL|hotelbookingwebapp-mysql|3306 (default)

#Docker compose cheatsheet#

**Note 1:** you need to cd first to where your docker-compose.yml file lives

**Note 2:** if you're using Vagrant, you'll need to ssh into it first

  * Start containers in the background: `docker-compose up -d`
  * Start containers on the foreground: `docker-compose up`. You will see a stream of logs for every container running.
  * Stop containers: `docker-compose stop`
  * Kill containers: `docker-compose kill`
  * View container logs: `docker-compose logs`
  * Execute command inside of container: `docker exec -it hotelbookingwebapp-php-fpm COMMAND` where `COMMAND` is whatever you want to run. For instance, `/bin/bash` to open a console prompt.

The Hechinger Report
====================

This repo covers the WordPress theme for the Hechinger Report. If you are new to the project follow the setup steps below.

### Setup

Setting up the Hechinger theme for development takes a few steps. You'll be installing some softwore, runnig some terminal commands, and activating some plugins.

1. Follow the directions [here](https://github.com/Upstatement/hechinger_vagrant) to set up a Vagrant environment. Then come back here.
2. [Install Timber](#Install Timber) following the directions below.
3. [Install Mesh](#Install Mesh).
4. [Import the Hechinger database](#Import DB) to get actual Hechinger content.
5. [Install dependencies.](#Install Dependencies)
6. Read our [wiki](https://github.com/Upstatement/hechinger/wiki) and happy coding!

### [Install Timber]

iTimber helps you create fully-customized WordPress themes faster with more sustainable code. With Timber, you write your HTML using the Twig Template Engine separate from your PHP files.

You'll need to install the Timber plugin using the terminal commands below.

Open a terminal and navagte to your hechinger_vagrant install

```
$ vagrant ssh
$ cd /srv/www/wordpress-he/
$ wp plugin install timber-library --activate
$ wp plugin install https://github.com/jarednova/mesh/archive/master.zip --activate
$ exit
```

### [Install Dependencies]

Hechinger has a few dependencies we need to install. First we'll use Bower to install Upbase, jQuery, and other packages we need. Then're going to compile our `.scss` files with Compass.

Open a terminal and navagte to your hechinger theme folder.

```
$ bower install
$ compass watch
```

> Protip: If you ever find the site is "broken" or has no stylesheets always try `bower install` and `compass watch` before asking for help.

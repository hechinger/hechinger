The Hechinger Report
====================

This repo covers the WordPress theme for the Hechinger Report. If you are new to the project follow the setup steps below.

### Setup

Setting up the Hechinger theme for development takes a few steps. You'll be installing some softwore, runnig some terminal commands, and activating some plugins.

1. Follow the directions [here](https://github.com/Upstatement/hechinger_vagrant) to set up a Vagrant environment. Then come back here.
2. Install Dependencies Using Composer following the directions below.
3. [Import the Hechinger database](#import-database) to get actual Hechinger content.
4. [Follow the uploads instructions](#uploads-instructions) to get images for the site.
5. [Install dependencies.](#install-dependencies)
6. Read our [wiki](https://github.com/Upstatement/hechinger/wiki) and happy coding!


### Install Dependencies

Hechinger has a few dependencies we need to install. First we'll use Bower to install Upbase, jQuery, and other packages we need. Then're going to compile our `.scss` files with Compass. You will need [Composer](https://getcomposer.org/doc/00-intro.md#globally).

First we will update composer:

```bash
$ vagrant ssh
$ cd /srv/www/wordpress-he/wp-content/themes/hechinger
$ composer update
$ exit
```

Then we will get the front end dependencies. Open a terminal and navagte to your hechinger theme folder.

```bash
$ bower install
$ gem install autoprefixer-rails
$ compass watch
```

**Sometimes the WordPress plugins you installed aren't activated. Just go into the WordPress admin and check that you've actiated the plugins.**

[Autoprefixer](https://github.com/postcss/autoprefixer) is a gem that works with Compass to add browser prefixes to our compiled sass.
The site also uses [respond.js](https://github.com/scottjehl/Respond) to provide media queries for IE8 and lower.

**Protip: If you ever find the site is "broken" or has no stylesheets always try `bower install` and `compass watch` before asking for help.**

There are a few more dependencies not managed with composer that we need to install. You'll find the directions below:

1. Advanced Custom Fields
1. Stream Manager

### Advanced Custom Fields

Advanced Custom Fields (ACF) powers the custom fields on the new Hechinger site. Downloading and activating this plugin will give you access to the custom fields Upstatement's dev team has created. ACF will be install by composer, but if it isn't open a terminal:

```
$ vagrant ssh
$ cd /srv/www/wordpress-he/
$ wp plugin install http://connect.advancedcustomfields.com/index.php?p=pro&a=download&k=b3JkZXJfaWQ9MzQwMzh8dHlwZT1kZXZlbG9wZXJ8ZGF0ZT0yMDE0LTA3LTA5IDEyOjU4OjA4 --activate
$ exit
```
In the wp-admin, activate the license with the Upstatement license key here: https://github.com/Upstatement/Upstatement/wiki/Upstatement%20WordPress%20Plugins#advanced-custom-fields

### Stream Manager

[Stream Manager](http://github.com/Upstatement/Stream-Manager) allows editors to intuitivly sort recent posts for the homepage to install, navigate to your vagrant install for Hechinger. Composer should install the Stream Manager for us, but if it isn't:

```
$ cd www/wordpress-he/wp-content/plugins
$ git clone git@github.com:Upstatement/stream-manager.git
$ vagrant ssh
$ cd /srv/www/wordpress-he/
$ wp plugin activate stream-manager
```

### Timber

Timber helps you create fully-customized WordPress themes faster with more sustainable code. With Timber, you write your HTML using the Twig Template Engine separate from your PHP files.

If composer doesn't install Timber you'll need to install the Timber plugin using the terminal commands below.

Open a terminal and navagte to your hechinger_vagrant install

```
$ vagrant ssh
$ cd /srv/www/wordpress-he/
$ wp plugin install https://github.com/jarednova/mesh/archive/master.zip --activate
$ exit
```

## Database Management

### Import Database

Developers will be using a capture of the actual Hechinger Report database to develop the site. The most recent database dump will be located in the `development` folder in the `Upstatement/Hechinger` dropbox in the form of an sql file.

- Open a terminal and navigate to your `hechinger_vagrant` root directory.
- You'll be running a these terminal commands import the DB:

```

$ vagrant ssh
$ cd /srv/database && wp db import hechinger.sql --path=/srv/www/wordpress-he

```

That's it. You should have a bunch of Hechinger posts and pages imported.

To exit vagrant ssh just run `exit`.

### Uploads Instructions

If it's not already installed, install the Uploads by Proxy plugin:
```
$ vagrant ssh -c "cd /srv/www/wordpress-he && wp plugin install uploads-by-proxy --activate"
```
Then, set the config up with the live URL for this site by adding the following lines to your wp-config.php
```php
define('UBP_LIVE_DOMAIN', 'http://hechingerreport.org/');
define('UBP_IS_LOCAL', true );
```

## Database Administration

This section is pretty much for Chris Plummer only, if you do not have such name, you can safely ignore this as part of the setup process.

### Admin Only Export DB

If you are reading this you are the db admin for this project. We may need to export Hechinger's WP database to test our design work. _If you completed the above steps for Import Database do NOT do this_

- To export the database go to the wp-admin dashboard for Hechinger's live site. You'll need the credentials for the site. Ask Chris or Grant.
- From the sidebar select `tools->export`.
- Make sure that "All content" is checked and click "Download Export File."

You WP database will be saved locally as an xml file. I'd bet that now you want to import that to your local vagrant environment.

### Admin Only DB Import

Developers will be using a capture of the actual Hechinger Report database to develop the site. The most recent Database dump will be located in the `development` folder in the `Upstatement/Hechinger` dropbox in the form of an xml. Copy that file into your `hechinger_vagrant/database` directory. Then open a terminal and navigate to your `hechinger_vagrant` root directory. _If you completed the above steps for Import Database do NOT do this_

These are the commands you'll run to import the database you copied from Dropbox:

```shell

$ vagrant ssh
$ cd /srv/www/wordpress_he
$ wp plugin install wordpress-importer --activate
$ wp import /srv/database/thehechingerreport.wordpress.2014-11-12.xml --authors=create

```

That's it. It takes about 10 minutes. Get a coffee or get back to work on something else. When it's done you should have a bunch of Hechinger posts and pages imported.

To exit vagrant ssh just run `exit`.

### QA with Vagrant Cloud

We will be using Vagrant Cloud to help us QA the site across browsers and devices. Vagrant Cloud will set up a tunnel from their site to your Vagrant box. This allows you to visit the site at a url on any device. The tunnel is shut down as soon as you `vagrant halt`.

To run Vagrant Cloud:

1. If this is your first time using Vagrant Cloud. Create an acct with you @upstatement email at http://vagrantcloud.com
 - You'll select your own username and password, so make it easy to remember.
2. Next you'll open a terminal window and enter some commands to start sharing.
3. In the terminal window: `$ vagrant login`.
 - You'll be asked for your email and password.
4. Next run `$ vagrant share`
 - The command should return a valid url to visit
 - It often returns an error the first time you do this. So try running `vagrant share` again
5. Visit the url in the devices you wish to test.

_When you are done please shut off your share by pushing `ctrl-c` in the terminal with vagrant share running_

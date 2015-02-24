The Hechinger Report
====================

This repo covers the WordPress theme for the Hechinger Report. If you are new to the project follow the setup steps below. Otherwise, see the [day-to-day](#day-to-day) guidelines.

- [Day-to-day](#day-to-day)
- [Setup](#setup)
 
# Day to day

### Getting Started
Regardless of what you're authoring, it's a good idea to have your vagrant instance up and running.
In your CLI, navigate to your hechinger_vagrant directory and run `vagrant up`

### Authoring files
Regardless of what types of files you're editing, make sure you're following our [GitHub workflow guide](https://github.com/Upstatement/public-wiki/wiki/GitHub-Workflow)

### Authoring CSS
In order for your sass to be compiled, you'll need to have compass watching your sass files.
In your CLI, navigate to your theme directory (`hechinger_vagrant/www/wordpress-he/wp-content/themes/hechinger`) and run `compass watch`
Happy Styling!

# Setup

Setting up the Hechinger theme for development takes a few steps. You'll be installing some softwore, runnig some terminal commands, and activating some plugins.

1. Follow the directions [here](https://github.com/Upstatement/hechinger_vagrant) to set up a Vagrant environment. Then come back here.
1. [Install dependencies.](#install-dependencies)
1. [Import the Hechinger database](#import-database) to get actual Hechinger content.
1. [Follow the uploads instructions](#uploads-instructions) to get images for the site.
1. Read our [wiki](https://github.com/Upstatement/hechinger/wiki) and happy coding!


### Install Dependencies

Hechinger has a few dependencies we need to install. These are managed by composer (PHP package manager) and bower (front end package manager).

#### PHP Dependencies

```bash
$ vagrant ssh
$ cd /srv/www/wordpress-he/wp-content/themes/hechinger
$ composer update
$ exit
```

#### Front End Dependencies

First, make sure you have node installed. Node is a javascript application that serves as the backbone for bower (among other things).
[Download the installer](http://nodejs.org/download/) for your operating system.

Next, install [Bower](http://bower.io/). Bower is a package manager for front end dependencies.
`npm install -g bower`

Finally, open a terminal, navigate to your hechinger theme folder, and run the following commands.
These:
- Install front end dependencies via bower
- Get ruby up to date
- Install compass
- Install sass
- Install Autoprefixer
- Start the compass watch process (which watches + compiles our sass)

```bash
$ bower install
$ gem update --system
$ gem install compass
$ gem install sass
$ gem install autoprefixer-rails
$ compass watch
```

[Autoprefixer](https://github.com/postcss/autoprefixer) is a gem that works with Compass to add browser prefixes to our compiled sass.
The site also uses [respond.js](https://github.com/scottjehl/Respond) to provide media queries for IE8 and lower.

**Protip: If you ever find the site is "broken" or has no stylesheets always try `bower install` and `compass watch` before asking for help.**

#### Other Dependencies
These are dependencies that Composer may have been unable to install for us. Ensure you *need* to install these by verifying they don't already exist in their respective locations.

##### Stream Manager

[Stream Manager](http://github.com/Upstatement/Stream-Manager) allows editors to intuitivly sort recent posts for the homepage to install, navigate to your vagrant install for Hechinger.

```
$ cd www/wordpress-he/wp-content/plugins
$ git clone git@github.com:Upstatement/stream-manager.git
$ vagrant ssh
$ cd /srv/www/wordpress-he/
$ wp plugin activate stream-manager
```

## Database Management

### Import Database

Developers will be using a capture of the actual Hechinger Report database to develop the site. Here's how to get that:

- Open a terminal and navigate to your `hechinger_vagrant` root directory.
- You'll be running these terminal commands to import the DB:

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

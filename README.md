The Hechinger Report
====================

This repo covers the WordPress theme for the Hechinger Report. If you are new to the project follow the setup steps below.

### Setup

Setting up the Hechinger theme for development takes a few steps. You'll be installing some softwore, runnig some terminal commands, and activating some plugins.

1. Follow the directions [here](https://github.com/Upstatement/hechinger_vagrant) to set up a Vagrant environment. Then come back here.
2. [Install Timber](#install-timber) following the directions below.
3. [Install Mesh](#install-mesh).
4. [Import the Hechinger database](#import-db) to get actual Hechinger content.
5. [Install dependencies.](#Install-dependencies)
6. Read our [wiki](https://github.com/Upstatement/hechinger/wiki) and happy coding!

### Install Timber

Timber helps you create fully-customized WordPress themes faster with more sustainable code. With Timber, you write your HTML using the Twig Template Engine separate from your PHP files.

You'll need to install the Timber plugin using the terminal commands below.

Open a terminal and navagte to your hechinger_vagrant install

```
$ vagrant ssh
$ cd /srv/www/wordpress-he/
$ wp plugin install timber-library --activate
$ wp plugin install https://github.com/jarednova/mesh/archive/master.zip --activate
$ exit
```

### Install ACF

Advanced Custom Fields v5 powers the custom fields on the new Hechinger site. Downloading and activating this plugin will give you access to the custom fields Upstatement's dev team has created.

```
$ vagrant ssh
$ cd /srv/www/wordpress-he/
$ wp plugin install https://www.dropbox.com/s/msici5rzsadpf0w/advanced-custom-fields-pro.zip?dl=1 --activate
$ exit
```

### Install Dependencies

Hechinger has a few dependencies we need to install. First we'll use Bower to install Upbase, jQuery, and other packages we need. Then're going to compile our `.scss` files with Compass.

Open a terminal and navagte to your hechinger theme folder.

```
$ bower install
$ compass watch
```

_Protip: If you ever find the site is "broken" or has no stylesheets always try `bower install` and `compass watch` before asking for help._
=======

## Mesh

We use mesh to bootstrap custom taxonomies, pages, and post types. This is especially helpful to avoid DB imports and exports and bootstrap static pages.

To get Mesh follow the new [instructions in the readme](https://github.com/Upstatement/hechinger/compare/43_page_scaffold?expand=1#diff-04c6e90faac2675aa89e2176d2eec7d8R15). Specifically this can be run on an existing Hechinger install...


#### Install Mesh

```
$ vagrant ssh
$ cd /srv/www/wordpress-he/
$ wp plugin install https://github.com/jarednova/mesh/archive/master.zip --activate
```

#### Bootstrap a Page

To create a new page, add to the `functions.php` file's `HechingerSite::bootstap_content` method...

```php
function bootstap_content() {
  if ( class_exists( 'Mesh' ) ) {
    $article = new Mesh\Post( 'article', 'page' );
    $article = new Mesh\Post( 'Special Reports', 'page' );
    $article = new Mesh\Post( 'About Fred Hechinger', 'page' );
    $article = new Mesh\Post( 'My Cool Page', 'page' );
  }
}
```

#### Now populate that page

To populate these you'll need a file called `hechinger/templates/pages/page-my-cool-page.twig` and then populate that as you would other pages on the site

## Database Management

### Import Database

Developers will be using a capture of the actual Hechinger Report database to develop the site. The most recent database dump will be located in the `development` folder in the `Upstatement/Hechinger` dropbox in the form of an sql file.

- Open a terminal and navigate to your `hechinger_vagrant` root directory.
- You'll be running a these terminal commands import the DB:

```

$ vagrant ssh
$ cd /srv/database && wget https://www.dropbox.com/s/1be3oh84cujtt2l/he_db_11-12.sql?dl=1 && mysql -u root -proot wordpress_he < he_db_11-12.sql\?dl\=1

```

That's it. You should have a bunch of Hechinger posts and pages imported.

To exit vagrant ssh just run `exit`.

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

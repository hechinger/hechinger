hechinger
=========

WordPress theme for the Hechinger Report

### Setup

- Follow the directions [here](https://github.com/Upstatement/hechinger_vagrant) for the Vagrant

### Get Timber
```
$ vagrant ssh
$ cd /srv/www/wordpress-he/
$ wp plugin install timber-library --activate
$ wp plugin install https://github.com/jarednova/mesh/archive/master.zip --activate
```

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

## Datbase Management

### Export DB

We may need to export Hechinger's WP database to test our design work. To export the database go to the wp-admin dashboard for Hechinger's live site. From the sidebar select `tools->export`. Make sure that "All content" is checked and click "Download Export File."

You WP database will be saved locally as an xml file. I'd bet that now you want to import that to your local vagrant environment.

### Import DB

Developers will be using a capture of the actual Hechinger Report database to develop the site. The most recent Database dump will be located in the `development` folder in the `Upstatement/Hechinger` dropbox in the form of an xml. Copy that file into your `hechinger_vagrant/database` directory. Then open a terminal and navigate to your `hechinger_vagrant` root directory. You'll be running a couple terminal commands to install an import plugin and import the db.

```shell

$ vagrant ssh
$ cd /srv/www/wordpress_he
$ wp plugin install wordpress-importer --activate
$ wp import /srv/database/thehechingerreport.wordpress.2014-11-12.xml --author=create

```

That's it. It takes about 10 minutes. Get a coffee or get back to work on something else. When it's done you should have a bunch of Hechinger posts and pages imported.

To exit vagrant ssh just run `exit`.


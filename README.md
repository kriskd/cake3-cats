_This template includes more information than a typical project requires, both to provide hints on possible things to include, as well as to make the process of filling it largely a matter of deleting information that is not applicable. Specifically; **be sure to remove or replace any notes and comments in italics,** like this one. By convention, pseudo-variables you should replace are typically in ALLCAPS._


# [{{PROJECT_TITLE:@TODO}}]({{PROJECT_REPO_URL:https://github.com/loadsys/app}})

{{PROJECT_DESCRIPTION:@TODO}}

_Brief app description. Why does it exist? Who uses it?_

* Production URL: {{PROJECT_PRODUCTION_URL:@TODO}}
* Staging URL: {{PROJECT_STAGING_URL:@TODO}}
* Project Management URL: {{PROJECT_MANAGEMENT_URL:@TODO}}
* Loadsys Project Docs: {{PROJECT_DOCUMENT_URL:@TODO}}


## Environment

_"Environment" refers to external technologies required for the app to run. Anything that the app "assumes" will be available. Memcache is part of the environment, jQuery is a library. **Always** include the minimum PHP version, PHP extensions (and versions) utilized, database software version, and any other **external** programs used. Think in particular about the production environment, even if a tool (like memcached) is not used locally in development._

### Hosting

This section documents the minimum required tools for hosting this application.

* [CakePHP](https://github.com/cakephp/cakephp/tree/2.6.1) v2.6.1+
* PHP v5.6+
	* intl
	* pdo + mysql
	* mbstring
	* mcrypt
	* memcached
	* openssl
* Apache v2.4+
* MySQL v5+
* Memcached

(These tools are all provided in the bundled vagrant environment, described below.)


### Developer-specific

The following tools **should be installed on your development machine** in order to work with this project:

* PHP v5.4+ (Mac system default should work fine.)
* [composer](http://getcomposer.org/) for dependency management.
* Either of the following:
	* [VirtualBox](https://www.virtualbox.org/) v4.3+ (free)
	* [VMware Fusion](http://www.vmware.com/products/fusion) v6+ plus the [vagrant VMware plugin](https://www.vagrantup.com/vmware) (not free, but **fast**)
* [vagrant](http://www.vagrantup.com/downloads.html) v1.6+ for dev VM hosting. The following plugins are helpful but not required:
	* [vagrant-vbguest](https://github.com/dotless-de/vagrant-vbguest)
	* [vagrant-cachier](https://github.com/fgrehm/vagrant-cachier)
* For automatically running tests:
	* [node.js](http://nodejs.org/download/)
	* [npm](https://npmjs.org/)
	* [grunt-cli](http://gruntjs.com/getting-started)

Vagrant + VirtualBox/VMware provide the following additional tools via a customized [PuPHPet](https://puphpet.com/)-based vagrant configuration which itself uses [puppet](http://puppetlabs.com/puppet/puppet-open-source) and [Hiera](http://docs.puppetlabs.com/hiera/1/). There are no "optional" installs. Developers must be able to run tests, generate phpDocs and run the code sniffer locally before committing. Thankfully, **the vagrant VM provides the following tools**, including:

* PHP's [xdebug extension](http://xdebug.org/) v2+
* [composer](https://getcomposer.org/)
* [phpunit](http://phpunit.de/) v3.7
* [phpDocumentor](http://phpdoc.org/) v2
* [PHP Code Sniffer](https://github.com/squizlabs/PHP_CodeSniffer) v2
* [nodejs](http://nodejs.org/) + [npm](https://www.npmjs.org/)
	* [`json`](http://trentm.com/json/) command line tool.
	* ember-cli
	* grunt-cli


### Included Libaries and Submodules

_"Libraries" refer to packages that are directly executed or used by the app. Items that the app is able to obtain or install for itself are libraries. List any packages that are pulled in via composer, included as git submodules or directly bundled in the repo. Include links to the package's homepage or repo and the version number in use (if applicable). The list below is pre-populated with the submodules included in this CakePHP-Skeleton repo, and also lists some common add-ons._

Libraries should be included with Composer whenever possible. Git submodules should be used as a fallback, and directly bundling the code into the project repo as a last resort. The Skeleton includes the following defaults:

Composer-provided:

* [CakePHP](https://github.com/cakephp/cakephp) v2.6.0+
* [DebugKit](https://github.com/cakephp/debug_kit/tree/2.0) v2.x
* [CakeDC Migrations](https://github.com/cakedc/migrations)
* [Loadsys Cake Shell Scripts](https://github.com/loadsys/CakePHP-Shell-Scripts)
* [Loadsys Cake Serializers](https://github.com/loadsys/CakePHP-Serializers)
* [Loadsys Cake Basic Seeds](https://github.com/loadsys/CakePHP-Basic-Seed)


Git submodules:

* (none)


Bundled packages:

* [Twitter Bootstrap](https://github.com/twbs/bootstrap) v3.x
* [jQuery](https://github.com/jquery/jquery/) v1.x


### cron Tasks

_Document anything that is expected to run outside of a normal web browser interface here. Include when it is supposed to run and any details about permissions, logging, etc._

```
0 0,12	* * *	/var/www/Console/cake COMMAND > /var/www/tmp/log/COMMAND.log 2>&1
```



## Installation

_In general, document the series of steps necessary to set up the project on a new system (development or production). If there is a setup shell script, don't document its internal steps (the script itself does that), just how to run it. If setup is manual, list each step in order._


### Development (vagrant)

Developers are expected to use the vagrant environment for all local work. Using a \_AMP stack on your machine directly is no longer advised or supported.

```bash
git clone {{PROJECT_REPO_CLONE_URL:@TODO}} ./
./bootstrap.sh
vagrant up
```

The bootstrap file takes care of installing dependencies. After this process, the project should be available at http://localhost:8080/.


@TODO: Modify puphpet provisioning to run `bin/migrations` and `bin/cake SeedShell.seed fill vagrant`. Maybe create a wrapper script like `bin/vagrant-provision` to bundle all this up? Put a "caller" script into `puphpet/files/exec-{once|always}/` to get it to run.

@TODO: Add a vagrant shutdown script to automatically call `bin/db-backup`, which will save a zipped. sql file in the shared folder under `backups/`.


### Production (bare metal)

1. Install the dependencies listed at the top of this readme.
1. Create a new blank database.
1. Assign a user permissions to that database.
1. (Locally) Update the `Config/core.php` with the new credentials and commit/push them to GitHub.
1. Configure a webroot.
1. **Set an apache environment variable with `SetEnv APP_ENV production` in the `<VirtualHost>` block** so the correct database config is used.
1. `cd` into the webroot.
1. Clone the project:
		git clone {{PROJECT_REPO_HTTPS_URL:@TODO}} ./
		./bootstrap.sh
1. (Any other production-specific configs should already exist in `Config/core.php`.)
1. Run `bin/migrations` to load the schema into the DB.



1. @TODO: Get puppet provisioning working using existing puphpet configs, but altered for production (no xdebug, no `vagrant` user, etc.


### Writeable Directories

Writeable directories are managed by `Config/writedirs.txt`, and they can be set by running `bin/writedirs`.



## Contributing

_Information a developer would need to work on the project in the "correct" way. (Tests, etc.)_

### After Pulling

Things to do after pulling updates from the remote repo.

On your host:

* `bin/deps-install` (Install any changes/updated dependencies from git submodules, composer, pear, npm, etc.)
* `vagrant provision` (Make any changes to the VM's config that may be necessary, and runs associated Cake provisioning steps:)
	* `bin/clear-cache` (Make sure temp files are reset between host/vm use.)
	* `bin/db-backup` (Store the previous database contents before running schema/data updates.)
	* `bin/migrations` (Set up the DB with the latest schema.)
	* `bin/cake Seeds.seed fill vagrant` (Populate the latest set of development data from the seeds, if the plugin is available.)

### Developer Workflow

**@TODO: Review and update this section.**

* Pull origin and get `dev` up to date.
* Create new feature branch from `dev`.
* Make changes and commit to your branch.
* Rebase branch on latest `dev`.
* Push (forced) feature branch to origin.
* Create a PR and add the "Review" label to it. Assign to the PM.
* PM will take it from there.

### Configuration

App configuration is stored in `Config/core.php`. This configuration is then added to (or overwritten by) anything defined in the environment-specific config file, such as `config/vagrant.php` or `config/staging.php`.

The bundled vagrant VM automatically sets `APP_ENV=vagrant` both on the command line (via `vagrant ssh` and in the Apache context.) If you want to work with the project on your host machine locally, you need to `export APP_ENV=dev` (or whatever environment you want to match for `config/*.php`) before running `bin/cake`.

### Database Changes

Because the MySQL DB runs inside of the vagrant VM, you must connect to it via SSH. The easiest way to do this is using [Sequel Pro](http://sequelpro.com/).

Create a new "SSH" connection with the following settings:

* Name: vagrant@vagrant
* MySQL Host: 127.0.0.1 (This is the MySQL server's address after you've SSHed into the vagrant box.)
* Username: vagrant
* Password: vagrant (as defined in `puphpet/config.yaml`.)
* Database: vagrant (again per `puphpet/config.yaml`.)
* Port: 3306
* SSH Host: 127.0.0.1
* SSH User: vagrant
* SSH Password: vagrant (Or [some guys online](https://coderwall.com/p/yzwqvg) say you can point to your local `~/.vagrant.d/insecureprivatekey`.)
* SSH Port: 2222 (per `puphpet/config.yaml`.)

This setup is handy for backing up your data if you're about to destroy the box, or for making Schema or Seed changes before running the Shell commands in the VM.

#### Schema Migrations

* The database schema is maintained using the CakeDC Migrations plugin.
* Once you have made changes to your development database using the process above, run `bin/cake Migrations.migration generate -f` **from inside the vagrant box** (via `vagrant ssh`).
* When prompted to update `schema.php`, choose **yes** and then choose **overwrite**.
* Then review and commit the changes to `Config/schema.php` and the new file from `Config/Migration/`.

#### Sample Data

**@TODO: Review and update this section.**

@TODO: This doesn't work yet.

* Test data is maintained by the Loadsys Seeds plugin.
* You can repopulate data in the VM's MySQL database by running `bin/cake Seeds.seed fill vagrant`.
* To update a Seed dataset, make your changes in the database and run `bin/cake Seeds.seed generate vagrant`.
* Review and commit the changes made in `Config/Seed/`.


### PHP Unit Testing

Unit tests should be created for all new code written in the following categories:

* Model methods
* Behaviors
* Controller actions
* AppController methods
* Components
* Helper methods
* Shells and Tasks
* Libraries in `Lib/'
* Javascript in `webroot/js/`
* **Bundled** plugins


Command line automated "test-on-save" is also possible with Grunt via: `grunt watch`. This will block the terminal while it waits for file changes. New files should get picked up as well.


### Javascript Unit Testing

**@TODO: Review and update this section.**

@TODO: Get the TestJs plugin integrated into the skeleton, use abus as reference.

* Tests can also be written for the browser JavaScript code.
* Javascript should be written in individual "class" files (they will be merged by asset compilation) in `webroot/js/src/`.
* Anything you would normally put in a `document.ready(...)` call should be placed in @TODO.
* Matching test files should be created in `webroot/js/test/`.
* Everything from these folders will be compressed into `webroot/js/assets.js`.
* These compiled assets and tests are then included in `View/Pages/test.ctp`.
* You can run your tests in the browser by visiting http://localhost:8080/pages/testjs.
* There is a `grunt` task to auto-run these tests on change as well: `grunt test`
```

### CSS Changes

* CSS is managed via LESS source files.
* LESS source files are located in `webroot/less/`.
* Run `grunt less` to process the `webroot/less/` files and output compiled CSS files in `webroot/css/`.
* **Commit both the .less and the .css changes** back to the repo as you work.
	* (Until a CDN is set up, static assets will be served from the app server directly.)

.less files of note:

* `global.less` is included everywhere in the site.
* `public.less` is referenced in only the default (public) layout and will override anything in global.
* `admin.less` is referenced only in the admin layout and will also override global.
* LESS resources can be broken out into logical files and `@import`ed into global, public or admin collections as appropriate.
* By default, bootstrap is `<link>`ed separately in the default.ctp layout, but can be rolled into global.less if desired.


### Other grunt Commands

* _(no args)_ or `watch` - Starts the file watcher and auto-executes tests for any php file that changes (and has a test file associated with it.) Also watches .less files and compiles them into CSS on change.
* `less` - Compiles .less files into CSS.
* `test` - Executes the Mocha Javascript test suite.


## Immersion

**@TODO: Review and update this section.**

_This section may make more sense to include with the "Project" documentation instead of the "repo" README..._

New devs should all run through these steps to get familiar with the app and the features available.


## License

Copyright (c) 2015 {{PROJECT_CLIENT_NAME:@TODO}}

![Moox BackupServerUi](https://github.com/mooxphp/moox/raw/main/art/banner/backup-server-ui.jpg)

# Moox Backup Server UI

Filament UI for Spatie Laravel Backup Server. Needs a license key for the paid package from [https://spatie.be](https://spatie.be/products/laravel-backup-server).

## Quick Installation

These two commmands are all you need to install the package:

```bash
composer require moox/backup-server-ui
php artisan mooxbackup-server-ui:install
```

Curious what the install command does? See manual installation below.

## What it does

<!--whatdoes-->

Filament UI for Spatie Laravel Backup Server. Create automated or make manual incremental backups. More information and screenshots will follow.

<!--/whatdoes-->

## Manual Installation

Instead of using the install-command `php artisan mooxbackup-server-ui:install` you are able to install this package manually step by step:

```bash
// Publish and run the migrations:
php artisan vendor:publish --tag="backup-server-ui-migrations"
php artisan migrate

// Publish the config file with:
php artisan vendor:publish --tag="backup-server-ui-config"
```

## Usage

## SSH Connection

### Create ssh connection to your source server
Open your Command Line and type 
``` ssh forge@your-adress ```
continue with the given instructions.

### Add ssh key to your destination server
Copy public key from your source server and add it to your destination server.
Connect destination and source server.
Confirm fingerprinting from destination server. 

## Create new Destination 
These two attributes are required:

name: the name of this destination
disk_name: the name of one of the disks configured in config\filesystems.php. The chosen disk must use the local driver

## Create new Source 

Set a Name

Add your Hostname

Set the ssh User

Ssh Port should be 22

Copy your ssh key path (~/.ssh/id_rsa)

ssh_user: the user name to use to ssh into the source server

cron_expression (required): Cron expression when to start a backup [Cron Help](https://crontab.guru/)

choose a given destination

pre_backup_commands: 
To create a MYSQL Backup u need to cd in your folder and create a backup. Each value is a command that will be executed. For example: 
| Key    | Value |
| -------- | ------- |
| 0  | cd /home/forge/yourplatform.com/    |
| 1 | mysqldump <database>  -u<username> -p<password> > dump.sql    |

post_backup_commands: 
Now do everything that should be executed after a backup. In this case we want to remove the dump from server.
| Key    | Value |
| -------- | ------- |
| 0  | cd /home/forge/yourplatform.com/    |
| 1 | rm -f dump.sql   |

You need to specify a include path 
| Key    | Value |
| -------- | ------- |
| 0  | cd /home/forge/yourplatform.com/    |

To exlude paths you should give paths relative to the paths given in includes


## Creating Backups 
Now you can create backups ether manual or automatical You just need to select the Source. 


## Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information on what has changed recently.

## Security Vulnerabilities

Please review [our security policy](https://github.com/mooxphp/moox/security/policy) on how to report security vulnerabilities.

## Credits

-   [All Contributors](../../contributors)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.

![Moox BackupServerUi](https://github.com/mooxphp/moox/raw/main/_other/art/banner/backup-server-ui.jpg)

# Moox BackupServer UI

Filament UI for Spatie Laravel Backup Server. Needs a license key for the paid package from https://spatie.be.

## Quick Installation

These two commmands are all you need to install the package:

```bash
composer require moox/backup-server-ui
php artisan mooxbackup-server-ui:install
```

Curious what the install command does? See manual installation below.

## What it does

<!--whatdoes-->

Filament UI for Spatie Laravel Backup Server.

<!--/whatdoes-->

## Manual Installation

Instead of using the install-command `php artisan mooxbackup-server-ui:install` you are able to install this package manually step by step:

```bash
// Publish the config file with:
php artisan vendor:publish --tag="backup-server-ui-config"
```

Register the Plugins in FilamentAdminPanelProvider.

## Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information on what has changed recently.

## Security Vulnerabilities

Please review [our security policy](https://github.com/mooxphp/moox/security/policy) on how to report security vulnerabilities.

## Credits

-   [All Contributors](../../contributors)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.

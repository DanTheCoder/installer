# Installer for Laravel applications

Installation wizard for Laravel applications that simplifies the command-line installation process for non-technical persons.

<img width="1194" alt="Screenshot 2023-11-15 at 3 28 51 PM" src="https://github.com/DanTheCoder/app-installer/assets/9156964/19d07001-73e8-4f56-9887-33d36e16f4d0">
<img width="1194" alt="Screenshot 2023-11-15 at 3 29 54 PM" src="https://github.com/DanTheCoder/app-installer/assets/9156964/6952062e-f5ef-47d8-bc67-2a504ba1a657">
<img width="1194" alt="Screenshot 2023-11-15 at 3 29 39 PM" src="https://github.com/DanTheCoder/app-installer/assets/9156964/a4f5d60c-3ec2-48b8-9260-dd7cb32da8bc">

## Installation

You can install the package via composer:

```bash
composer require danthecoder/installer
```

You can publish the config file with:

```bash
php artisan vendor:publish --tag="installer-config"
```

Optionally, you can publish the views using

```bash
php artisan vendor:publish --tag="installer-views"
```

## Testing

```bash
composer test
```

## Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information on what has changed recently.

## Credits

-   [DanTheCoder](https://github.com/DanTheCoder)
-   [All Contributors](../../contributors)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.

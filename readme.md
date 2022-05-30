# GoToUrl for your laravel App

[![Latest Stable Version](https://poser.pugx.org/xorth/gotourl/v/stable)](https://packagist.org/packages/xorth/gotourl)
[![Latest Unstable Version](https://poser.pugx.org/xorth/gotourl/v/unstable)](https://packagist.org/packages/xorth/gotourl)
[![License](https://poser.pugx.org/xorth/gotourl/license)](https://packagist.org/packages/xorth/gotourl)

This composer package offers an easy redirector for your laravel 5.3 applications.

## Installation

Begin by pulling in the package through Composer.

```bash
composer require xorth/gotourl
```

Next, include the service provider within your `config/app.php` file.

```php
'providers' => [
    Xorth\GoToUrl\GoToUrlServiceProvider::class,
];
```

You can register the Go facade in the aliases key of your `config/app.php` file if you like.

```php
'aliases' => [
    'Go' => \Go::class,
];
```

## Usage

Within your controllers, before you perform a save, edit or delete action, make a call to the `go()` function to save where you want to go.

```php
public function create()
{
    go()->after(); // Get the full url through $request->fullUrl()

    // do more stuff
}
```

```php
public function save()
{
    // do something

    return go()->now();
}
```

You may also do:

- `go('/something/to/show')`
- `go()->after('/something/to/show')`
- `Go::after('/something/to/show`: Only if the facade was registered.
- `Go::now()`: Only if the facade was registered.

This can be pretty useful if you save, update or delete something in different parts of your app.

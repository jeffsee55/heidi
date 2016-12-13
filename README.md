<p align="center"><a href="https://laravel.com" target="_blank"><img width="150"src="http://scrapbookgirl.typepad.com/.a/6a00e54efec67b883301b7c7ac986b970b-800wi"></a></p>

# Heidi
___
### Because your plugin code deserves a home
Heidi is a Wordpress plugin framework with the idea that every piece of code should have a home. Heidi takes an opinionated approach about how your hooks should be organized & delegated. Heidi relies extensively on the Wordpress hooks API, mimicking an MVC framework to compute, delegate, and render plugin functionality.
>Please note: This is not an MVC framework. There is no concept of REST, it is merely a structure that flows in a similar fashion.

The benefits to using Heidi are:
- [Simple, fast routing engine](https://heidi.com/docs/routing).
- [Powerful dependency injection container](https://heidi.com/docs/container).
- [Easy and extendible admin notification system](https://heidi.com/docs/container).

Heidi is accessible, yet powerful, providing tools needed for large, robust applications. A superb combination of simplicity, elegance, and innovation give you tools you need to build any application with which you are tasked.

## Learning Heidi

Heidi has the most extensive and thorough documentation and video tutorial library of any modern web application framework. The [Heidi documentation](https://heidi.com/docs) is thorough, complete, and makes it a breeze to get started learning the framework.

If you're not in the mood to read, [Laracasts](https://laracasts.com) contains over 900 video tutorials on a range of topics including Heidi, modern PHP, unit testing, JavaScript, and more. Boost the skill level of yourself and your entire team by digging into our comprehensive video library.
The entire framework is centered around the concept of Wordpress hooks. Heidi uses action hooks to delegate class responsibilities.

### Routing
Every action hook is registered in the `plugin/routes.php` file

In `plugin/routes.php`
```php
$router->register([
    'admin_menu' => [
        'AdminController@registerSettingsPage'
    ]
]);
```

### Controllers
Wordpress will now look for a class called `AdminController` which should provide the `registerSettingsPage()` function.

In `plugin/Contollers/AdminController.php`
```php
namespace Heidi\Plugin\Controllers;

use Heidi\Plugin\Callbacks\AdminView;

class AdminController
{
    function registerSettingsPage()
    {
        add_menu_page(
            'Special Settings',
            'Special Settings',
            'manage_options',
            'special-settings',
            [new AdminView, 'render']
        );
    }
}
```

### Callback handlers
After defining the callback in the controller, Wordpress will now look for an `AdminView` class with the `render` function.

In `plugin/Callbacks/AdminView.php`
```php
namespace Heidi\Plugin\Callbacks;

class AdminView
{
    public function render()
    {
        $welcomeMessage = 'Hello, world!';
        view('admin.admin_settings', compact('welcomeMessage'));
    }
}
```

### Blade view templating
Finally, the view can be rendered with the Blade templating engine

In `plugin/view/admin/admin_settings.php`
```blade
@extends('admin.admin_layout')
@section('content')
    <h1>{{ $welcomeMessage }}</h1>
@endsection
```

## Contributing

Thank you for considering contributing to the Heidi framework! The contribution guide can be found in the [Heidi documentation](http://heidi.com/docs/contributions).

## Security Vulnerabilities

If you discover a security vulnerability within Heidi, please send an e-mail to Jeff See at jeff@heidi.com. All security vulnerabilities will be promptly addressed.

## License

The Heidi framework is open-sourced software licensed under the [MIT license](http://opensource.org/licenses/MIT).

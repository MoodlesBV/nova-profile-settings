# A tool for users to change their profile credentials

When this tool is added to Nova, you can let users update their profile data without giving them access to the full
User resource under 'Resources'.

![screenshot of the profile tool](https://github.com/runlinenl/nova-profile-tool/raw/master/screenshot.png)

## Installation

Next up, you must register the tool with Nova. This is typically done in the `tools` method of the `NovaServiceProvider`.

```php
// in app/Providers/NovaServiceProvider.php

// ...

public function tools()
{
    return [
        // ...
        new \Moodles\ProfileTool\ProfileTool,
    ];
}
```

## Usage

Click on the "Profile" menu item in your Nova app to see the tool provided by this package.


## Change language

You can fully modify the locale of the package to your own translations by specifying them in the language files.

You can change the translations of the title, buttons, messages etc. in:
`resources/lang/vendor/nova/{{lang}}.json`
Example:
```php
// in resources/lang/vendor/nova/en.json

{
    // ...
    "nova-profile-settings#success_message": "Profile has been updated!",
    "nova-profile-settings#navigation_name": "Profile",
    "nova-profile-settings#title": "Edit Profile",
    "nova-profile-settings#save_profile": "Save Profile"
}

```

You can change the translations of the input fields in:
`resources/lang/{{lang}}.json`
Example:
```php
// in resources/lang/en.json

{
    // ...
    "nova-profile-settings#name": "Name",
    "nova-profile-settings#email": "E-Mailaddress",
    "nova-profile-settings#password": "Password",
    "nova-profile-settings#password_confirmation": "Password confirmation"
}
```

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.


# Tepade

> A text detector with support for named parameters.

Easily detect texts that contain named variables enclosed within curly braces.
There's a bit of flair in this library that you can check in the examples.

**Notice:** You can change the regex related to capturing parameters.
but the default regex can only be enclosed within curly braces,
must start with an English letter, supports only letters, numbers, & the underscore (_) character.

## 🫡 Usage

### 🚀 Installation

You can install the package via composer:

```bash
composer require nabeghe/tepade
```

### Examples

Check the examples folder in the repositiry.

- [Example 1: Return](examples/1-return.php)
- [Example 2: Callback](examples/2-callback.php)
- [Example 3: Callback Custom Args](examples/3-callback-custom-args.php)
- [Example 4: Validators](examples/4-validators.php)
- [Example 5: Builder](examples/5-builder.php)
- [Example 6: Multiple Patterns](examples/6-multiple-patterns.php)
- [Example 7: Structure](examples/7-structure.php)

## 📖 License

Copyright (c) 2024 Hadi Akbarzadeh

Licensed under the MIT license, see [LICENSE.md](LICENSE.md) for details.
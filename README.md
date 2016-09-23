# Laravel Emoji
Text with Emoji for Laravel 5.X

[![Latest Stable Version](https://poser.pugx.org/bahricanli/laravel-emoji/v/stable.svg)](https://packagist.org/packages/bahricanli/laravel-emoji)
[![License](https://poser.pugx.org/bahricanli/laravel-emoji/license.svg)](LICENSE.md)
[![Build Status](https://img.shields.io/travis/bahricanli/laravel-emoji.svg)](https://travis-ci.org/bahricanli/laravel-emoji)
[![Quality Score](https://img.shields.io/scrutinizer/g/bahricanli/laravel-emoji.svg?style=flat-square)](https://scrutinizer-ci.com/g/bahricanli/laravel-emoji)
[![Total Downloads](https://img.shields.io/packagist/dt/bahricanli/laravel-emoji.svg?style=flat-square)](https://packagist.org/packages/bahricanli/laravel-emoji)

## Installation

Via Composer

``` bash
$ composer require "bahricanli/laravel-emoji:dev-master"
```

## Usage


``` php
use BahriCanli\LaravelEmoji\LaravelEmoji;

$str = "Power 󾮖 ";
LaravelEmoji::textWithEmoji($str);
```

## Emoji Source

https://github.com/bahricanli/php-emoji


## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.

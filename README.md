

# atpro-translator laravel Package
<p align="center">
<a href="https://travis-ci.org/atpro/translator"><img src="https://travis-ci.org/laravel/framework.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/atpro/translator"><img src="https://img.shields.io/packagist/v/atpro/translator" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/atpro/translator"><img src="https://img.shields.io/packagist/l/atpro/translator" alt="License"></a>
</p>

## Introduction

**Atpro-translator** is a package that allows you to easily manage the internationalization in your applications.
## Installation
To get started with Atpro-translator, use Composer to add the package to your project's dependencies:

```bash
    composer require atpro/translator
```
## Configuration

After installing the `Atpro-translator` library, register the  `\Atpro\Translator\AtproServiceProvider::class` in your `config/app.php` configuration file:

``` php
'providers' => [

        \Atpro\Translator\AtproServiceProvider::class,
    ],
```
Also, register the middleware in web middleware groups by simply adding the middleware class :

```php
AtproTranslateMiddleware::class,
```
into the `$middlewareGroups` of your `app/Http/Kernel.php` file.

And then run :
```bash
php artisan vendor:publish
 ```
publish `AtproServiceProvider`.
## Usage

**To translate your lang files into other languages**:

Run the command in terminal

```bash
    php artisan atpro:translate 
```

**Example**:
1. php artisan atpro:translate  and click enter
2. --> Your started language ?
   `en`
3. --> Your translated list language seperated with commas (,) example: fr,es ... ?
   `fr,it,es`
4. Click enter and wait for translated files

It will generate translated files in respective folder `fr,it,es`

**OPTIONAL OPTIONS**:
  
 | Options |                 Description                  |                                            Examples |
|:--------|:--------------------------------------------:|----------------------------------------------------:|
| `--e`   | Generate files for all languages without any | php artisan atpro:translate --e='user.php,test.php' |
| `--f`   |       Generate files for specific path       | php artisan atpro:translate --e='user.php,test.php' |



**B. To generate views for translation**:

Run the command in terminal

```bash
    php artisan atpro:generate-view-translate
```

**Example**:
1. php artisan atpro:generate-view-translate  and click enter
2. --> Yours languages seperated with commas (,) example: fr,es ... ?
   `fr,it,es`
3. Click enter and wait for generate views translate

It will generate a middleware, in controller, a routes file and a component containing the different options according to the chosen languages

You will also have a new component `<x-atpro::language> </x-atpro::language>`. You can use it in views.

**Note**: <span style="color:red">Make sure that the started language folder exists in your language folder and contains files you want to translate</span>.





# atpro-translator laravel Package
<p align="center">
<a href="https://travis-ci.org/atpro/translator"><img src="https://travis-ci.org/laravel/framework.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/atpro/translator"><img src="https://img.shields.io/packagist/v/atpro/translator" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/atpro/translator"><img src="https://img.shields.io/packagist/l/atpro/translator" alt="License"></a>
</p>

## About Project

## Installation
install with :

composer require atpro/translator

## Configuration

add in providers for  your config/app.php file

'providers' => [

        \Atpro\Translator\AtporServiceProvider::class,
    ],

## commands

Run the command in terminal 

php artisan atpro:translate 

click in enter

Example usage:
1. php artisan atpro:translate  and click enter 
2. --> Your started language ? 
en
3. --> Yours translated list language seperated with commas (,) example: fr,es ... ?
fr,it,es
4. Click enter and wait for translated language


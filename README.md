# VaMoLà

Validatore e Monitor per l'accessibilità

Vamolà is a ready installed version of [aChecker](https://github.com/inclusive-design/aChecker) validator with some improvements,
you don't need to install from zero but is enough to edit configuration parameters inside __include/config.inc.php__ file to match your database credentials.

This distribution comes with a SQL dump database (database.sql.bz2 file), it will builds **VamolaValidator** database for you from scratch.

That's because most of the customization comes from the database.

So, using Vamola you get all the <a href="https://github.com/atutor/AChecker" title="AChecker Project on Github">aChecker features, plus:

* A new guideline called "Allegato A L. 4/04" (matching Italian laws on accessibility since 20/03/2013), the latest version of "STANCA ACT"
* Full Italian language translations
* Original Vamolà HTML5 accessible theme using jQuery UI (v. 1.8.7)


## Download

Please, fetch [latest stable version 2.0.1](https://github.com/RegioneER/Vamola/archive/v2.0.1.zip)

## Installation

 1. Unzip latest stable release (or clone the master branch if you plan to contrib to this repository)
 2. Load inside your database entire the dump file database.sql.bz2
 3. Modify include/config.inc.php to match your SQL credentials parameters and temp directory
 4. Serve using Apache, enjoy :smile:

## Documentation

Documentation is helded inside this project's wiki pages

## Support

Getting support is easy as filing issues

## Contribute

You can fork this project and contribute by sending pull requests as you want

## Changelog

 - 2.0.5 Old Vamolà distribution, stills [available on SourceForge](http://sourceforge.net/projects/vamola-validate/)
 - 2.1.0 Current Vamolà distribution on Github, based on AChecker 1.4
 - 2.1.1 Feature added: Security enchancements by nonce submission and validation limit to avoid memory leaks.
 - 2.1.2 Template engine updated to Savant3

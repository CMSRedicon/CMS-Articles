# Redicon CMS Articles
Module for cmsr allowing for article management
## Getting Started
Install CMS Redicon first
### Installing
Add to the composer.json file
```
"redicon/cms-articles" : "dev-master"
```
Run
```
composer update
```
After successful installation, we launch from the command line
```
php artisan migrate --path=vendor/redicon/cms_articles/src/database/migrations
php artisan db:seed --class=Redicon/CMS_Articles/Database/Seeds/DatabaseSeeder
php artisan vendor:publish --provider=Redicon/CMS_Articles/CmsServiceProvide




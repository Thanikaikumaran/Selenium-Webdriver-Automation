



- LAMP Server:
- PHP 7.2
- LARAVEL

<hr>

### Project Setup

<b>1.</b> Download the project.

<b>2.</b> Need to Update the all dependencies.

```command
composer upgrade
```

<b>3.</b> Folder permission.

```command
sudo chmod -R 777 public/* storage/* bootstrap/* database/seeds/*
```

<b>4.</b> Need to edit the .env file. Following details needs to be update.

- `DB_HOST=` 
- `DB_PORT=` 
- `DB_DATABASE=` 
- `DB_USERNAME=` 
- `DB_PASSWORD=` 

<b>5.</b> After edit the .env file, we need to clear the cache.


```command
php artisan cache:clear
php artisan route:clear
php artisan config:clear
php artisan view:clear
php artisan config:cache
```
<hr>

#### Import Data into database 

<b>1.</b> Provided Data:

- `abc.xlsx`
- `cba.csv`

Above files are in `public/database/seeds` folder.
DB backup file in `public/database` folder.

<b>2.</b> Start to create the table and migrate the data:

```command
php artisan migrate:fresh --seed
```
If we observe any issue, we can try 

```command
composer dump-autoload
```

Then 

```command
php artisan migrate:fresh --seed
```

<hr>

#### Run Application
Finally we can run the application by following command

```command
php artisan serve
```

Sample URL 

```html
http://127.0.0.1:8000/home
```

# Task App
Task App

# Live Installation
1. Extract task.zip to web server
2. Import task_db.sql to database
3. Update db credential in .env file
```
APP_URL=YOUR_APP_URL
DB_HOST=localhost
DB_PORT=3306
DB_DATABASE=YOUR_DATABSE_NAME
DB_USERNAME=YOUR_DATABSE_USERNAME
DB_PASSWORD=YOUR_DATABSE_PASSWORD
```

# Live example
Visit this url for live demonstration of the app  
https://test.anf-gem.com/#/


# Local Installation
## Prerequisite
- Docker 2.4 (or latest)
- Docker Compose 1.27.4 (or latest, usually included in docker insall setup)
- Composer 2.0 (or latest)
- Git
- PHP 7.4 or higher
- Mysql Client (Workbench or DBeaver)
- Postman (Optional)

## Stacks
- Laravel
- Docker
- docker-compose
- VueJs
- Boostrap
- Mysql
- PHP 8.2

### Setup the APP
1. Run containers application
```
docker-compose up
```

2. Setup BE
In separate terminal  
```
cd task
composer install
cp .env.example .env

# .env file should contain the follwing details
APP_URL=http://localhost:8000
DB_CONNECTION=mysql
DB_HOST=db
DB_PORT=3306
DB_DATABASE=task_db
DB_USERNAME=root
DB_PASSWORD=root

```

### migration
```
php artisan key:generate
php artisan migrate
```

2. Setup FE
```
npm install
npm run dev
```

3. Test the APP
Open in broswer http://localhost:8000


### API Doc
```
# Import to PostMan
Task Collection.postman_collection.json
```

### References
- https://laravel.com/docs/11.x/eloquent-resources#resource-collections  
- https://vuejs.org/guide/quick-start.html  
- https://getbootstrap.com/docs/5.3/getting-started  
- https://sortablejs.github.io/Vue.Draggable


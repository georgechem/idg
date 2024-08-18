* Require PHP 8.2 or higher
* copy .env to .env.local and provide your variables for the database
>DB must be created

If you store your variables in .env.local not in .env and want to run any command which uses database you should specify local environment as in example below:
>php artisan migrate --env=local

Also file .env.testing is needed for testing environment and looks like:

**!!! PROVIDE PROPER DATA !!!**
```dotenv
APP_ENV=testing
APP_KEY=base64:!!!_your_app_key_!!!!
APP_DEBUG=true
APP_URL=http://localhost

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=use_your_main_database_for_simplicty
DB_USERNAME=your_username
DB_PASSWORD=your_password

CACHE_DRIVER=array
QUEUE_CONNECTION=sync
MAIL_MAILER=array
```

Run:
> composer install

> npm install (node 18.^)

> npm run watch ( to start a dev server with UI)

Frontend is done with React JS.
I choose the more modern approach to separate the backend form the frontend and provide a data as json.

In some application there is still blade used, and it still has some usages but market is going towards decoupling frontend from backend which has many advantages.

For simplicity of that example used laravel ui 
- which allow me to mount react application to the empty blade template. However, in the production project is recommended to decouple frontend fully.



To populate database with random data:
>  php artisan db:seed --env=local

>**Populating database takes some time due to significant number of records. Should not be longer than 1min.**


**Notes:**

In simple scenario Player should be a User in the app however that approach is less flexible. I separated player from the user because:
- not every user of the app can/should be a player (in the future)
- app may provide additional functionality then just playing
 - making user a player we may finish with extra fields in user which will be irrelevant for some of them  and if user is not a player we just store null there which is against database RDM and optimisation.

Used raw sql due to time limit and complexity of the query itself,
Parameters are bind so there is no possibility of SQL injection. Also, repository method allow only integers to be passed and that is another layer of protection.
Also, if that will be user input we need provide proper validation of that data in controller but here it is not necessary.

For date displaying used input type=text for simplicity - normally we should use HTM5 element but time is currently supported only on Chrome. The best choice will be some date time picker library for react.
Also for numeric input values used input type=text for simplicity

Currently, all calculation for data are done using complex SQL.
Query is efficient but hard to test. In production application I prefer to create
services for such calculations which can be very well tested and also reused.

Example response with Players, with their games, and relevant scores at given game.

![img.png](img.png)

Final Note:

That project is done only for demonstration purposes. To go to production 
need refactoring and improvement:

- is not likely in production to fetch all those data for all users and combine them using complex SQL not mentioning doing such calculation with SQL,
- seeders should be rather hardcoded (refers to numeric data specifically) - to allow for check if calculations are done properly (as we are using dynamic values tests got more complicated and harder to read) - also there can be setup separate database for test and populated separately (not used here due to time constraint), 
- also as on leader board the data presented are very limited we should fetch only what we need, having id for every presented user we can fetch and make calculation for given user only when it is clicked,
- also that project logic is simple itself however require a lot of extra work with proper environment set-up which was not done here due to time constraint (that is extra work on project, but it is done only once on every project and then expanded gradually during development),
- however database schema is designed for production purposes and it is scalable


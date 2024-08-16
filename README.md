* Require PHP 8.2 or higher
* copy .env to .env.local and provide your variables for the database
>DB must be created and migrations must be run

Frontend is done with React JS.
I choose the more modern approach to separate the backend form the frontend and provide a data as json.

In some application there is still blade used, and it still has some usages but market is going towards decoupling frontend from backend which has many advantages.

For simplicity of that example used laravel ui 
- which allow me to mount react application to the empty blade template. However, in the production project is recommended to decouple frontend fully.

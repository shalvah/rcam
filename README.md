# rcam

Demo implementation of realtime site comments with auto moderation using Pusher Channels


[View tutorial]()

## Prerequisites
- PHP >= 7.1.3
- Composer
- A [Pusher account](https://pusher.com/signup) and [Pusher app credentials](http://dashboard.pusher.com/)

## Getting started
Clone the project and install dependencies:

```bash
git clone https://github.com/shalvah/rcam
cd rcam
composer install
```

Copy the `.env.example` file to a `.env` file. Add your Pusher app credentials to this file:
```
PUSHER_APP_ID=your-app-id
PUSHER_APP_KEY=your-app-key
PUSHER_APP_SECRET=your-app-secret
PUSHER_APP_CLUSTER=your-app-cluster
```

Also replace the stubs in `resources/home.blade.php` with your respective Pusher credentials:

```js
    var socket = new Pusher("your-app-key", {
        cluster: 'your-app-cluster',
    });
```

Create a file called `database.sqlite` in the `database` folder of your app.

Then:

```bash
# run database migrations
php artisan migrate

# generate an application key
php artisan key:generate

# start the app
php artisan serve
```
## Built With

* [Pusher](https://pusher.com/) - APIs to enable devs building realtime features
* [Laravel](http://laravel.com) - the PHP framework for web artisans

## Acknowledgements
* [Commentator](https://github.com/craigthomasfrost/commentator)

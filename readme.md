# Blitz

Minimal authentication scaffolding with Inertia.js, Vue.js and Tailwind CSS.

## Installation

```shell
laravel new foobar-app

cd foobar-app

composer require imagdic/blitz --dev

php artisan blitz:install
```

This will install official `Inertia.js` Laravel adapter for server-side along with `Ziggy` so we can use routes in JavaScript.   
For client-side it will install official `Inertia.js` adapter, `Tailwind CSS` and `Vue.js`.

After successful installation you'll have minimal authentication (Login and Register).

![](https://i.imgur.com/7A3hVQz.png)
![](https://i.imgur.com/0u6kEp7.png)
![](https://i.imgur.com/Alu9gMz.png)

### Verification

`User` model has to implement `Illuminate\Contracts\Auth\MustVerifyEmail`
and add `verified` middleware on routes you want to protect.  
See [Email Verification](https://laravel.com/docs/verification) for more details.

## Further plans

- ~~Email verification~~
- ~~Password reset and Forgot password~~
- Extend dashboard page


## Alternatives

- [Laravel Jetstream](https://github.com/laravel/jetstream/)

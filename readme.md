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
![](https://i.imgur.com/3svUtAY.png)
![](https://i.imgur.com/Alu9gMz.png)

## Further plans

- Email verification
- Password reset
- Extend dashboard page

These upgrades will be optional and can be used by providing certain flags (ex. `--verification`, `--password-reset`, `--admin-dashboard`).  
Main goal is to keep this package as minimal as it can be and add new features as optional.


## Alternatives

- [Laravel Jetstream](https://github.com/laravel/jetstream/)

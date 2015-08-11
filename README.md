# Grovo
Laravel 5.1 Grovo API Service Provider

The first time you run a Grovo request, the grovo.config file will contain the token generated from the API. It is recommended to move your token to your .env file and reference the token in the grovo.config like so:

`env('GROVO_TOKEN')`

`$grovo->user()->get($id);`
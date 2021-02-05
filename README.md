
## Getting Started
[Link to front repo](https://github.com/Florian-Rowehy/checkpoint4-front)

Clone this project `git clone git@github.com:Florian-Rowehy/checkpoint4-front.git` <br>
Install the dependencies `composer install`<br>
Create your .env.local file with a valid DATABASE_URL

Run `php bin/console d:d:c` to create the database <br>
Run `php bin/console d:m:m` to make the migration <br>
Run `php bin/console d:f:l` to load the fixtures <br>

Generate the SSL keys using the JWT_PASSPHRASE as the key
```
$ mkdir -p config/jwt
$ openssl genpkey -out config/jwt/private.pem -aes256 -algorithm rsa -pkeyopt rsa_keygen_bits:4096
$ openssl pkey -in config/jwt/private.pem -out config/jwt/public.pem -pubout
```

Run `symfony server:start` to launch your local php web server

Install the front repo
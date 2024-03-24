# Simplest framework

For reference only, because the project is under development.

## Installation

```sh
composer create-project anzubko/swf
```

### Apache/mod_php

```apacheconf
DocumentRoot {SITE_ROOT}/public

<Directory {SITE_ROOT}/public>
    FallbackResource /.bin/index.php
</Directory>
```

### Nginx/PHP-FPM

```nginxconf
root {SITE_ROOT}/public;

location / {
    try_files $uri /.bin/index.php$is_args$args;
}

location /.bin {
    fastcgi_pass {PHP_FPM_URL}:9000;
    fastcgi_param SCRIPT_FILENAME $document_root$fastcgi_script_name;
    include fastcgi_params;
}
```

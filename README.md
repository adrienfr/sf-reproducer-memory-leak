# Reproducer memory leak

## Test

```bash
composer install
php bin/console --env=test doctrine:database:create
php bin/console --env=test doctrine:schema:create
```

Update composer.json with `"symfony/framework-bundle": "5.4.5",` / `"symfony/framework-bundle": "5.4.6",` to switch between SF versions.

On SF 5.4.5 :
```bash
Time: 00:01.822, Memory: 54.50 MB

OK (100 tests, 700 assertions)
```

On SF 5.4.6 :
```bash
Time: 00:01.729, Memory: 98.50 MB

OK (100 tests, 700 assertions)
```

# To repo

clone this project

```
composer install
./n98-magerun2-4-x.phar # broken
./n98-magerun2-3-x.phar # works
```

# From scratch

```
composer create-project --repository=https://repo-magento-mirror.fooman.co.nz/ magento/project-community-edition=2.3.7-p3 ./magerun-broken --no-install
cd ./magerun-broken
composer config --unset repo.0
composer config repo.composerrepository composer https://repo-magento-mirror.fooman.co.nz/
composer install
```

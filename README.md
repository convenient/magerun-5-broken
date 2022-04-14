The latest magerun v5 bundles in guzzle 7, magento uses guzzle 6

So if I have a console command which has a dependency on guzzle, magerun is fully broken.


This is because `vendor/guzzlehttp/guzzle/src/functions.php` will be autoloaded from the magerun phar file, and the code executed will be from magento and there's a version mismatch.
 
# Example command

```
$ php bin/magento convenient:example:example
Hello there this is my guzzle client GuzzleHttp\Client
```

# To repo

clone this project

```
composer install
./n98-magerun2-4-x.phar --version # broken
./n98-magerun2-3-x.phar --version # works
```

In more detail

Working
```
[16:59:42] lukerodgers [~/src/magerun-broken]$ ./n98-magerun2-4.9.1.phar  --version
n98-magerun2 4.9.1 by netz98 GmbH
```

Broken

```
[16:59:12] lukerodgers [~/src/magerun-broken]$ ./n98-magerun2-5.0.0.phar --version | head -5
PHP Fatal error:  Uncaught Error: Call to undefined method GuzzleHttp\Utils::chooseHandler() in phar:///Users/lukerodgers/src/magerun-broken/n98-magerun2-5.0.0.phar/vendor/guzzlehttp/guzzle/src/functions.php:61
Stack trace:
#0 /Users/lukerodgers/src/magerun-broken/vendor/guzzlehttp/guzzle/src/HandlerStack.php(42): GuzzleHttp\choose_handler()
#1 /Users/lukerodgers/src/magerun-broken/vendor/guzzlehttp/guzzle/src/Client.php(65): GuzzleHttp\HandlerStack::create()
#2 /Users/lukerodgers/src/magerun-broken/vendor/magento/framework/ObjectManager/Factory/AbstractFactory.php(121): GuzzleHttp\Client->__construct(Array)
#3 /Users/lukerodgers/src/magerun-broken/vendor/magento/framework/ObjectManager/Factory/Dynamic/Developer.php(66): Magento\Framework\ObjectManager\Factory\AbstractFactory->createObject('GuzzleHttp\\Clie...', Array)
#4 /Users/lukerodgers/src/magerun-broken/vendor/magento/framework/ObjectManager/ObjectManager.php(70): Magento\Framework\ObjectManager\Factory\Dynamic\Developer->create('GuzzleHttp\\Clie...')
#5 /Users/lukerodge in phar:///Users/lukerodgers/src/magerun-broken/n98-magerun2-5.0.0.phar/vendor/guzzlehttp/guzzle/src/functions.php on line 61

Fatal error: Uncaught Error: Call to undefined method GuzzleHttp\Utils::chooseHandler() in phar:///Users/lukerodgers/src/magerun-broken/n98-magerun2-5.0.0.phar/vendor/guzzlehttp/guzzle/src/functions.php on line 61

Error: Call to undefined method GuzzleHttp\Utils::chooseHandler() in phar:///Users/lukerodgers/src/magerun-broken/n98-magerun2-5.0.0.phar/vendor/guzzlehttp/guzzle/src/functions.php on line 61
```


# From scratch

```
composer create-project --repository=https://repo-magento-mirror.fooman.co.nz/ magento/project-community-edition=2.3.7-p3 ./magerun-broken --no-install
cd ./magerun-broken
composer config --unset repo.0
composer config repo.composerrepository composer https://repo-magento-mirror.fooman.co.nz/
composer install
```

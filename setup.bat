php bin/console doctrine:database:drop --force
php bin/console doctrine:database:create


php bin/console doctrine:generate:entities AppBundle/Entity/Product
php bin/console doctrine:generate:entities AppBundle/Entity/Category
php bin/console doctrine:generate:entities AppBundle/Entity/User

php bin/console doctrine:schema:update --force


php bin/console doctrine:generate:crud -n --overwrite  --with-write  --entity AppBundle:Product
php bin/console doctrine:generate:crud -n --overwrite  --with-write  --entity AppBundle:Category
php bin/console doctrine:generate:crud -n --overwrite  --with-write  --entity AppBundle:User

php bin/console fos:user:create user user@example.com user
php bin/console fos:user:create test test@example.com test
php bin/console fos:user:create admin admin@example.com admin --super-admin


php bin/console fos:user:promote test ROLE_ADMIN


php bin/console assetic:dump

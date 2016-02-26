php app/console doctrine:database:drop --force
php app/console doctrine:database:create

rem php app/console doctrine:generate:entity

php app/console doctrine:generate:entities AppBundle/Entity/Product
php app/console doctrine:generate:entities AppBundle/Entity/Category
php app/console doctrine:generate:entities AppBundle/Entity/User

php app/console doctrine:schema:update --force


php app/console doctrine:generate:crud -n --overwrite  --with-write  --entity AppBundle:Product
php app/console doctrine:generate:crud -n --overwrite  --with-write  --entity AppBundle:Category
php app/console doctrine:generate:crud -n --overwrite  --with-write  --entity AppBundle:User

php app/console fos:user:create user user@example.com user
php app/console fos:user:create test test@example.com test
php app/console fos:user:create admin admin@example.com admin --super-admin


php app/console fos:user:promote test ROLE_ADMIN



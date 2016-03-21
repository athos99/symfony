php bin/console doctrine:database:drop --force
php bin/console doctrine:database:create

php bin/console doctrine:generate:entities AppBundle/Entity/Dir --path src
php bin/console doctrine:generate:entities AppBundle/Entity/Element --path src
php bin/console doctrine:generate:entities AppBundle/Entity/Group --path src
php bin/console doctrine:generate:entities AppBundle/Entity/Product --path src
php bin/console doctrine:generate:entities AppBundle/Entity/Category --path src
php bin/console doctrine:generate:entities AppBundle/Entity/User --path src

php bin/console doctrine:schema:update --force

php bin/console doctrine:generate:crud -n --overwrite  --with-write  --entity AppBundle:Product
php bin/console doctrine:generate:crud -n --overwrite  --with-write  --entity AppBundle:Category
php bin/console doctrine:generate:crud -n --overwrite  --with-write  --entity AppBundle:User
php bin/console doctrine:generate:crud -n --overwrite  --with-write  --entity AppBundle:Dir
php bin/console doctrine:generate:crud -n --overwrite  --with-write  --entity AppBundle:Element
php bin/console doctrine:generate:crud -n --overwrite  --with-write  --entity AppBundle:Group

php bin/console fos:user:create user user@example.com user
php bin/console fos:user:create test test@example.com test
php bin/console fos:user:create admin admin@example.com admin --super-admin


php bin/console fos:user:promote test ROLE_ADMIN


php bin/console assetic:dump
php bin/console config:dump-reference  > dump-reference.txt
php bin/console config:dump-reference doctrine  > doctrine.txt
php bin/console config:dump-reference stof_doctrine_extensions  > stof_doctrine_extensions.txt

:fin
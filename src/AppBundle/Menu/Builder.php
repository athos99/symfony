<?php
// src/AppBundle/Menu/Builder.php
namespace AppBundle\Menu;

use Knp\Menu\FactoryInterface;
use Symfony\Component\DependencyInjection\ContainerAware;

class Builder extends ContainerAware {
  public function mainMenu(FactoryInterface $factory, array $options) {
    $menu = $factory->createItem('root');
    $menu->addChild('Home', array('route' => 'homepage'));
    $menu->addChild('Lucky', array(
        'route' => 'lucky',
        'routeParameters'=>array('count'=>2)
    ));
    $menu->addChild('Category', array('route' => 'category'));
    $menu->addChild('Product', array('route' => 'product'));
    $menu->addChild('Test', array('route' => 'test'));

// access services from the container!
//    $em = $this->container->get('doctrine')->getManager();
// findMostRecent and Blog are just imaginary examples
//    $blog = $em->getRepository('AppBundle:Blog')->findMostRecent();

//    $menu->addChild('Latest Blog Post', array(
//      'route' => 'blog_show',
//      'routeParameters' => array('id' => $blog->getId())
//    ));

// create another menu item
    $menu->addChild('About Me', array('route' => 'product'));
// you can also add sub level's to your menu's as follows
    $menu['About Me']->addChild('Edit profile',
      array('route' => 'lucky'));

// ... add more children

    return $menu;
  }
}
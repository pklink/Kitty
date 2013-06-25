<?php


namespace Kitty\Controller;

use Kitty\Controller;
use Kitty\Model\Option;

/**
 * Class Setting
 *
 * @package Kitty\Controller
 */
class Settings extends Controller
{

    protected function getName()
    {
        $name = $this->entityManager->getRepository('Kitty\Model\Option')->findOneBy([
            'name' => 'name'
        ]);

        if ($name == null)
        {
            $name = new Option();
            $name->setName('name');
        }

        return $name;
    }


    public function generalAction()
    {
        /* @var \Kitty\App $app */
        $app     = $this->app;
        $request = $this->app->request();
        $name    = $this->getName();

        if ($request->isPost())
        {
            $name->setValue($request->post('name'));

            $this->entityManager->persist($name);
            $this->entityManager->flush();

            $app->flash('success', 'Einstellungen wurden gespeichert.');
            $app->redirect($app->getBaseUrl() . '/settings');
        }

        // set head-title
        $this->setHeadArgument('title', 'Allgemeine Einstelungen');

        // render view
        $this->render('settings/general', [
            'name' => $name->getValue()
        ]);
    }

}
<?php


namespace Kitty;


use Kitty\Model\Option;
use Slim\Slim;
use SlimController\SlimController;

/**
 * Class Controller
 *
 * @package Kitty
 * @property App $app
 */
abstract class Controller extends SlimController {

    /**
     * @var EntityManager
     */
    protected $entityManager;


    /**
     * @var array
     */
    private $headArguments = [];


    /**
     * @param Slim $app
     */
    public function __construct(Slim &$app)
    {
        $this->entityManager = EntityManager::instance();
        parent::__construct($app);
    }


    /**
     * @return array
     */
    private function getOptions()
    {
        $options    = $this->entityManager->getRepository('Kitty\Model\Option')->findAll();
        $optionsArr = [];

        foreach ($options as $option)
        {
            /* @var Option $option */
            $optionsArr[$option->getName()] = $option->getValue();
        }

        return $optionsArr;
    }


    /**
     * @param string $name
     * @param mixed $value
     */
    protected function setHeadArgument($name, $value)
    {
        $this->headArguments[$name] = $value;
    }


    /**
     * @param string $template
     * @param array $args
     */
    protected function render($template, $args = [])
    {
        /* @var \Kitty\App $app */
        $app = $this->app;

        $args['app'] = [
            'baseUrl' => $app->getBaseUrl()
        ];
        $args['identity'] = $app->getIdentity();

        // add flash messages
        if (isset($_SESSION['slim.flash']))
        {
            $args['flash'] = $_SESSION['slim.flash'];
        }

        // add options
        $args['options'] = $this->getOptions();

        // add header arguments
        $args['headArguments'] = $this->headArguments;

        parent::render($template, $args);
    }

}
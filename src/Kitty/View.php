<?php


namespace Kitty;


class View extends \Slim\View
{

    /**
     * @var \Twig_Environment
     */
    protected $twig;


    /**
     * @return View
     */
    public function __construct()
    {
        // init twig
        $basepath = realpath(__DIR__ . '/../../templates');

        $loader = new \Twig_Loader_Filesystem($basepath);
        $this->twig = new \Twig_Environment($loader, array(
            //'cache' => $basepath . '/cache',
            'debug' => true
        ));

        // add debug-extension
        $this->twig->addExtension(new \Twig_Extension_Debug());

        // add markdown-filter
        $filter = new \Twig_SimpleFilter('markdown', ['\Michelf\Markdown', 'defaultTransform']);
        $this->twig->addFilter($filter);

        parent::__construct();
    }


    /**
     * @param string $template
     * @return string
     */
    public function render($template)
    {
        return $this->twig->render($template . '.twig', $this->data);
    }

}
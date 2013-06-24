<?php


namespace Kitty;


class View extends \Slim\View
{

    /**
     * @var array
     */
    protected $options = [
        'baseUrl' => ''
    ];

    /**
     * @var \Twig_Environment
     */
    protected $twig;


    /**
     * @param array $options
     */
    public function __construct($options = [])
    {
        $this->options = array_merge($this->options, $options);

        // init twig
        $basepath = realpath(__DIR__ . '/../../templates');

        $loader = new \Twig_Loader_Filesystem($basepath);
        $this->twig = new \Twig_Environment($loader, array(
            //'cache' => $basepath . '/cache',
            'debug' => true
        ));

        $this->twig->addExtension(new \Twig_Extension_Debug());

        parent::__construct();
    }


    /**
     * @param string $template
     * @return string
     */
    public function render($template)
    {
        $this->data['app'] = $this->options;
        return $this->twig->render($template . '.twig', $this->data);
    }

}
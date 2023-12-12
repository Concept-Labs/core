<?php
namespace Cl\View;

use Cl\Factory;
use Cl\Config;
use Cl\Debug\Debug;

class View {

    protected $template;
    public function __construct(protected Config $config)
    {

    }

    public function setTemplate(string $template)
    {
        $this->template = $template;
    }

    public function getTemplate()
    {
        return $this->template;
    }

    static function renderView( string $name)
    {

    }

}
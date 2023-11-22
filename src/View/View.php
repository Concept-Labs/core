<?php
namespace Cl\Core\View;

use Cl\Core\Factory;
use Cl\Core\Config;
use Cl\Core\Debug\Debug;

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
<?php

namespace App;

class Application extends \Laravel\Lumen\Application
{
    public function resource($uri, $controller)
    {
        $this->get($uri, $controller . '@index');
        $this->get($uri . '/{id}', $controller . '@get');
        $this->post($uri, $controller . '@store');
        $this->put($uri . '/{id}', $controller . '@update');
        $this->delete($uri . '/{id}', $controller . '@delete');
    }
}

<?php
namespace Tests\Framework\Modules;

class ErroredModule {

  public function __construct(\Framework\Router $router)
  {
    $router->get('/demo', function() {
      /* return something that is neither a string nor a ResponseInterface */
      return new \stdClass();
    }, 'demo');
  }
}
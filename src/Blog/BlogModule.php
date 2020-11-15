<?php
namespace App\Blog;

use Framework\Renderer;
use Framework\Router;
use Psr\Http\Message\ServerRequestInterface as Request;

class BlogModule {

  private $renderer;


  public function __construct(Router $router)
  {
    $this->renderer = new Renderer();
    $this->renderer->addPath('blog', __DIR__ . '/views');
    $router->get('/blog', [$this, 'index'], 'blog.index');
    $router->get('/blog/{slug:[a-z\-]+}', [$this, 'show'], 'blog.show');
  }

  public function index(Request $request): string
  {
    return $this->renderer->render('@blog/index');
  }

  public function show(Request $request): string
  {
    return $this->renderer->render('@blog/show');
  }
}
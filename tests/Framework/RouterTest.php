<?php
namespace Tests\Framework;

use GuzzleHttp\Psr7\Request;
use PHPUnit\Framework\TestCase;

class RouterTest extends TestCase {

  public function setUp() 
  {
    $this->router = new Router();
  }

  public function testGetMethod()
  {
    $request = new Request('GET', '/blog');
    $this->router->get('/blog', function(){ return 'hello';}, 'blog');
    $route = $this->router->match($request);
    $this->assertEquals('blog', $route->getName());
    $this->assertEquals('hello', call_user_func_array($route->getCallback(), [$request]));
  }

  public function testGetMethodIfURLDoesNotExists()
  {
    $request = new Request('GET', '/blog');
    $this->router->get('/fzfe', function(){ return 'hello';}, 'blog');
    $route = $this->router->match($request);
    $this->assertEquals(null, $route);
    $this->assertEquals(null, $route);
  }

  public function testGetMethodWithParameters()
  {
    $request = new Request('GET', '/blog/-mon-slug-8');
    $this->router->get('/blog/{slug:[a-z0-9\-]+}-{id:\d+}', function(){ return 'zefzae';}, 'post.show');
    $route = $this->router->match($request);
    $this->assertEquals('post.show', $route->getName());
    $this->assertEquals(['slug' => 'mon-slug', 'id' => 8], $route->getParameters());
  }
}
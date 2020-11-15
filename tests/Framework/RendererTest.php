<?php
namespace Tests\Framework;

use Framework\Renderer;
use PHPUnit\Framework\TestCase;

class RendererTest extends TestCase {

  private $renderer;

  public function setUp()
  {
    $this->renderer = new Renderer();
    
  }

  public function testRenderTheRightPath() {
    $this->renderer->addPath('blog', __DIR__ . 'views');
    $content = $this->render('@blog/demo');
    $this.assertEquals('Salut les gens', $content);
  }

  public function testRenderTheDefaultPath() {
    $this->renderer->addPath(__DIR__ . 'views');
    $content = $this->render('demo');
    $this.assertEquals('Salut les gens', $content);
  }
}
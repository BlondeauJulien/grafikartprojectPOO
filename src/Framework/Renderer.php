<?php
namespace Framework;

class Renderer {

  const DEFAULT_NAMESPACE = '__MAIN';

  private $paths = [];
  private $globals = [];

  public function addPath(string $namespace, ?string $path = null): void 
  {
    if(is_null($path)) {
      $this->paths[self::DEFAULT_NAMESPACE] = $namespace;
    } else {
      $this->paths[$namespace] = $path;
    }
  }

  public function render(string $view, array $params = []): string 
  {
    if($this->hasNamespace($view)) {
      $path = $this->replaceNameSpace($view) . '.php';
    } else {
      $path = $this->paths[self::DEFAULT_NAMESPACE] . DIRECTORY_SEPARATOR . $view . '.php';

    }
    
    ob_start();
    $renderer = $this;
    extract($this->globals);
    extract($params);
    require($path);
    return ob_get_clean();
  }

  public function addGlobal(string $key, $value):void 
  {
    $this->globals[$key] = $value;
  }

  private function hasNamespace(string $view): bool 
  {
    return $view[0] === '@';
  }

  private function getNamespace(string $view): string 
  {
    return substr($view, 1, strpos($view, '/') - 1);
  }

  private function replaceNameSpace(string $view): string 
  {
    $namespace = $this->getNameSpace($view);
    return str_replace('@' . $namespace, $this->paths[$namespace], $view);
  }
}
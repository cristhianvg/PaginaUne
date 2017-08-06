<?php

class request {

  private $get;
  private $post;
  private $cookie;

  public function __construct($get, $post, $cookie) {
    $this->get = $get;
    $this->post = $post;
    $this->cookie = $cookie;
  }

  /**
   * Obtiene variable enviada por el método GET
   * @param string $variable
   * @return mixed
   */
  public function getQuery(string $variable) {
    return htmlspecialchars($this->get[$variable]);
  }

  public function hasQuery(string $variable): bool {
    return isset($this->get[$variable]);
  }

  /**
   * Obtiene variable eviada por el método POST
   * @param string $variable
   * @return mixed
   */
  public function getParam(string $variable) {
    return htmlspecialchars($this->post[$variable]);
  }

  public function hasParam(string $variable): bool {
    return isset($this->post[$variable]);
  }

  public function getCookie($cookie): array {
    return $this->cookie[$cookie];
  }

}

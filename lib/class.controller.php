<?php

abstract class controller {

  /**
   * 
   * @var config
   */
  private $config;

  /**
   * 
   * @var array
   */
  private $params;

  /**
   * 
   * @var string
   */
  private $view;

  /**
   * 
   * @var session
   */
  private $session;

  abstract function main(request $request);

  public function __construct(config $config, session $session) {
    $this->config = $config;
    $this->session = $session;
    $this->params = array();
  }

  public function getConfig(): config {
    return $this->config;
  }

  public function getParams(): array {
    return $this->params;
  }

  public function setParam(string $param, $value) {
    $this->params[$param] = $value;
  }

  public function getView(): string {
    return $this->view;
  }

  public function setView(string $view) {
    $this->view = $view;
  }

  public function getSession(): session {
    return $this->session;
  }

}

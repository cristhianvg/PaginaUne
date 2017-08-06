<?php

class view {

  private $params;
  private $view;

  /**
   *
   * @var config
   */
  private $config;

  public function __construct(config $config, $view, $params = null) {
    $this->params = $params;
    $this->view = $view;
    $this->config = $config;
  }

  public function render() {
    if (is_array($this->params) === true) {
      extract($this->params);
    }
    require $this->config->getPath() . 'view/template.' . $this->view . '.php';
  }

}
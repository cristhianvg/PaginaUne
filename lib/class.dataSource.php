<?php

class dataSource {

  /**
   * 
   * @var config
   */
  private $config;

  /**
   * 
   * @var PDO
   */
  private $instancia = null;

  public function __construct(config $config) {
    $this->config = $config;
  }

  /**
   * 
   * @return \PDO
   * @throws Exception
   */
  protected function getConection(): PDO {
    try {
      if ($this->instancia === null) {
        $dsn = $this->getConfig()->getDrive() . ':host=' . $this->getConfig()->getHost() . ';port=' . $this->getConfig()->getPort() . ';dbname=' . $this->getConfig()->getDbname();
        $this->instancia = new PDO($dsn, $this->getConfig()->getUser(), $this->getConfig()->getPassword());
        $this->instancia->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $this->instancia->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);
      }
      return $this->instancia;
    } catch (PDOException $exc) {
      throw new Exception($exc->getMessage(), $exc->getCode(), $exc->getPrevious());
    }
  }

  protected function getConfig(): config {
    return $this->config;
  }

  protected function setConfig(config $config) {
    $this->config = $config;
  }

  /**
   * Ejecuta un SQL tipo SELECT con o sin parametros y devuelve un array de objetos tipo stdClass
   * @param string $sql
   * @param array $params
   * @return array
   */
  protected function query(string $sql, array $params = null): array {
    try {
      $stmt = $this->getConection()->prepare($sql);
      $stmt->execute($params);
      return $stmt->fetchAll();
    } catch (PDOException $exc) {
      throw new Exception($exc->getMessage(), $exc->getCode(), $exc->getPrevious());
    }
  }

  /**
   * Ejecuta sentencias SQL tipo INSERT, UPDATE y DELETE
   * @param string $sql
   * @param array $params Parámetro opcional
   * @return bool
   */
  protected function execute(string $sql, array $params = array()): bool {
    try {
      $stmt = $this->getConection()->prepare($sql);
      $stmt->execute($params);
      return true;
    } catch (PDOException $exc) {
      throw new Exception($exc->getMessage(), $exc->getCode(), $exc->getPrevious());
    }
  }

}

<?php

namespace lesha724\DistanceLearning\models;

use GuzzleHttp\Client;
use lesha724\DistanceLearning\interfaces\IDistanceLearning;
use lesha724\DistanceLearning\throws\NullArgumentException;

/**
 * Class BaseConnector
 * @package lesha724\DistanceLearning\models
 */
abstract class BaseConnector extends BaseObject implements IDistanceLearning
{
    /**
     * Хост
     * @var string
     */
    protected $_host;

    /**
     * ключ
     * @var string
     */
    protected $_appKey;

    /**
     * BaseConnector constructor.
     * @param string $host
     * @param string $appKey
     * @param array $config
     * @throws NullArgumentException
     */
    public function __construct(string $host, string $appKey, array $config = [])
    {
        if(empty($host))
            throw new NullArgumentException('Необходимо заполнить "host"');
        if(empty($appKey))
            throw new NullArgumentException('Необходимо заполнить "appKey"');

        $this->_host = $host;
        $this->_appKey = $appKey;

        parent::__construct($config);
    }

    #region methods
    /**
     * Геттер для хоста
     * @return mixed
     */
    public function getHost() : string
    {
        return $this->_host;
    }

    /**
     * Геттер для Токена
     * @return mixed
     */
    public function getToken() : string
    {
        return $this->_appKey;
    }

    /**
     * Отправка запроса
     * @param string $uri
     * @param string $type
     * @param array $params
     *
     * @return void
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    protected function _sendQuery(string $uri, string $type = 'POST', array $params = []){
        $client = new Client();
        $response = $client->request($type, $uri, [
            'query' => $params
        ]);
        if($response->getStatusCode() != 200)
        {

        }
    }
    #endregion
}
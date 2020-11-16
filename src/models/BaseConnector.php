<?php

namespace lesha724\DistanceLearning\models;

use GuzzleHttp\Client;
use GuzzleHttp\Psr7\Response;
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
    protected $_token;

    /**
     * BaseConnector constructor.
     * @param string $host
     * @param string $appKey
     * @param array $config
     * @throws NullArgumentException
     */
    public function __construct(string $host, string $token, array $config = [])
    {
        if(empty($host))
            throw new NullArgumentException('Необходимо заполнить "host"');
        if(empty($token))
            throw new NullArgumentException('Необходимо заполнить "appKey"');

        $this->_host = $host;
        $this->_token = $token;

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
        return $this->_token;
    }

    /**
     * Отправка запроса
     * @param string $uri
     * @param string $type
     * @param array $params
     *
     * @return Response
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    protected function _sendQuery(string $uri, string $type = 'POST', array $params = []){
        $client = new Client();
        return $client->request($type, $uri, [
            'query' => $params
        ]);
    }
    #endregion
}
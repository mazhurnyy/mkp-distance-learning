<?php

namespace lesha724\DistanceLearning\models;

use GuzzleHttp\Client;
use GuzzleHttp\RequestOptions;
use lesha724\DistanceLearning\interfaces\IDistanceLearning;
use lesha724\DistanceLearning\throws\NullArgumentException;
use Psr\Http\Message\ResponseInterface;

/**
 * Class BaseConnector
 * @package lesha724\DistanceLearning\models
 */
abstract class BaseConnector extends BaseObject implements IDistanceLearning
{
    const TYPE_MOODLE = 'moodle';
    
    const TYPE_EDX = 'edx';
    
    /**
     * Хост
     * @var string
     */
    protected $_host = '';

    /**
     * ключ
     * @var string
     */
    protected $_token = '';

    /**
     * @var string
     */
    protected $_typePostParams = RequestOptions::JSON;

    /**
     * BaseConnector constructor.
     * @param string $host
     * @param string $token
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
     * @return string
     */
    public function getHost() : string
    {
        return $this->_host;
    }

    /**
     * Геттер для Токена
     * @return string
     */
    public function getToken() : string
    {
        return $this->_token;
    }

    /**
     * Отправка запроса
     * @param string $uri
     * @param string $type
     * @param array $paramsQuery
     * @param array $params
     * @return ResponseInterface
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    protected function _sendQuery(string $uri, string $type, array $paramsQuery, array $params = []) : ResponseInterface{
        if($type == 'GET')
        {
            $paramsQuery = array_merge($paramsQuery, $params);
            $params = [];
        }

        $uri.='?'.http_build_query($paramsQuery);

        $queryData = [];
        if($type == 'POST' && !empty($params)) {
            $queryData = [
                $this->_typePostParams => $params
            ];
        }

        return (new Client())->request($type, $uri, $queryData);
    }

    /**
     * Какой тип дистанционного образования
     * @return string
     * 
     * @see TYPE_MOODLE
     * @see TYPE_EDX
     */
    public abstract function getType(): string;
    #endregion
}
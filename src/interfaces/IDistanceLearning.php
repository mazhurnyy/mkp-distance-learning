<?php

namespace lesha724\DistanceLearning;

/**
 * Интейфейс для коннектор к дистанционному обучению
 * Interface IDistanceLearning
 * @package lesha724\DistanceLearning
 */
interface IDistanceLearning
{
    /**
     * Геттер для хоста
     * @return mixed
     */
    public function getHost();

    /**
     * Геттер для Токена
     * @return mixed
     */
    public function getToken();


    /**
     * Проверка существования пользователя дистанционного образования с таким email
     * @param string $email
     * @return bool
     */
    public function validateEmail(string $email);
}
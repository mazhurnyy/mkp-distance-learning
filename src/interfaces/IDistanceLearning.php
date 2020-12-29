<?php

namespace lesha724\DistanceLearning\interfaces;

/**
 * Интерфейс для коннектор к дистанционному обучению
 * Interface IDistanceLearning
 * @package lesha724\DistanceLearning
 */
interface IDistanceLearning
{
    #region Getters
    /**
     * Геттер для хоста
     * @return string
     */
    public function getHost() : string;

    /**
     * Геттер для Токена
     * @return string
     */
    public function getToken() : string;
    
    /**
     * Тип
     * @return string
     */
    public function getType() : string;
    #endregion

    /**
     * IDistEducation constructor.
     * @param string $host Хост
     * @param string $appKey Апкей
     */
    public function __construct(string $host, string $appKey);

    #region Course functions
    /**
     * Список курсов
     * @return ICourse[]
     */
    public function getCoursesList();

    /**
     * Запись на курс
     * @param int $courseId
     * @param array $membersId
     * @return bool
     */
    public function subscribeToCourse(int $courseId, array $membersId): bool;

    /**
     * Выписка с курса
     * @param int $courseId
     * @param array $membersId
     * @return bool
     */
    public function unsubscribeToCourse(int $courseId, array $membersId): bool;
    #endregion


    #region User
    /**
     * Получить пользователя по параметрам
     * @param array $params
     * @return IUser[]
     */
    public function getUsers(array $params) : array;

    /**
     * Создание нового пользователя
     * @param array $params
     * @return IUser
     */
    public function createUser(array $params) : IUser;
    #endregion

}
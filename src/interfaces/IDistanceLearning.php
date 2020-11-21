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
     * Записать студента на курс
     * @param $student IStudent
     * @param $courseId int
     * @return mixed
     */
    public function subscribeToCourse(IStudent $student, int $courseId) : bool;

    /**
     * Отписать студента с курса
     * @param $student IStudent
     * @param $courseId int
     * @return mixed
     */
    public function unsubscribeToCourse(IStudent $student, int $courseId) : bool;
    #endregion

    /**
     * Проверка существования пользователя дистанционного образования с таким email
     * @param string $email
     * @return bool
     */
    public function validateEmail(string $email) : bool;
}
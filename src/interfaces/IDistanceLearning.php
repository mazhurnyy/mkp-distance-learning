<?php

namespace lesha724\DistanceLearning\interfaces;

use lesha724\DistanceLearning\models\Course;

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
     * @return mixed
     */
    public function getHost() : string;

    /**
     * Геттер для Токена
     * @return mixed
     */
    public function getToken() : string;
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
     * @return Course[]
     */
    public function getCoursesList();

    /**
     * Инфо по курсу по id
     * @param int $courseId
     * @return Course|null
     */
    public function getCourse(int $courseId) : Course;

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
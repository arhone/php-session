<?php declare(strict_types = 1);
namespace arhone\session;

/**
 * Управление сессией
 *
 * Interface SessionInterface
 * @package arhone\session
 */
interface SessionInterface {

    /**
     * SessionInterface constructor.
     *
     * @param array $config
     */
    public function __construct (array $config = []);

    /**
     * Запуск сессии
     *
     * @return bool
     */
    public function start () : bool;

    /**
     * Статус сессии
     *
     * @return bool
     */
    public function status () : bool;

    /**
     * Записать сессию
     *
     * @param string $name
     * @param $value
     * @return mixed
     */
    public function set (string $name, $value);

    /**
     * Получить сессию
     *
     * @param string $name
     * @return mixed
     */
    public function get (string $name);

    /**
     * Удалить сессию
     *
     * @param string $name
     * @return mixed
     */
    public function delete (string $name);

    /**
     * Метод для установки настроек класса
     *
     * @param array $config
     * @return array
     */
    public function config (array $config) : array;

}
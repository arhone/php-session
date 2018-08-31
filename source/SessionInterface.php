<?php declare(strict_types = 1);

namespace arhone\session;

/**
 *  Управление сессией
 *
 * Interface SessionInterface
 * @package arhone\session
 * @author Алексей Арх <info@arh.one>
 */
interface SessionInterface {

    /**
     * SessionInterface constructor.
     *
     * @param array $config
     */
    public function __construct (array $config = []);

    /**
     * Возвращает или устанавливает имя сессии
     *
     * @param null|string $name
     * @return string
     */
    public function name ($name = null) : string;

    /**
     * Получает и/или устанавливает идентификатор текущей сессии
     *
     * @param string|null $id
     * @return string
     */
    public function id ($id = null) : string;

    /**
     * Запуск сессии
     *
     * @param string|null $id
     * @return bool
     */
    public function start ($id = null) : bool;

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
     * Удалить данные из сессии
     *
     * @param string $name
     * @return mixed
     */
    public function delete (string $name);

    /**
     * Удалить сессию
     *
     * @return bool
     */
    public function destroy () : bool;

    /**
     * Записывает данные сессии и завершает её
     */
    public function close ();

    /**
     * Удалить все переменные сессии
     */
    public function unset ();

    /**
     * Метод для установки настроек класса
     *
     * @param array $config
     * @return array
     */
    public function config (array $config) : array;

}
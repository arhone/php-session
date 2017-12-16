<?php declare(strict_types = 1);
namespace arhone\session;

/**
 * Управление сессией
 *
 * Class Session
 * @package arhone\session
 */
class Session implements SessionInterface {

    /**
     * Конфигурация класса
     *
     * @var array
     */
    protected static $config = [];

    /**
     * SessionInterface constructor.
     *
     * @param array $config
     */
    public function __construct (array $config = []) {

        self::config($config);
        $this->start();

    }

    /**
     * Запуск сессии
     *
     * @return bool
     */
    public function start () : bool {

        $status = $this->status();

        return $status == true ? $status : session_start();

    }

    /**
     * Статус сессии
     *
     * @return bool
     */
    public function status () : bool {

        $statusList = [
            PHP_SESSION_DISABLED => false,
            PHP_SESSION_NONE     => null,
            PHP_SESSION_ACTIVE   => true
        ];

        $status = session_status();

        return isset($statusList[$status]) ? $statusList[$status] : false;

    }

    /**
     * Записать сессию
     *
     * @param string $name
     * @param $value
     * @return mixed
     */
    public function set (string $name, $value) {

        $session = &$_SESSION;
        foreach (explode('.', $name) as $key) {

            if (!is_array($session)) {
                $session = [];
            }

            $session = &$session[$key];

        }

        $session = $value;

    }

    /**
     * Получить сессию
     *
     * @param string $name
     * @return mixed
     */
    public function get (string $name) {

        $session = &$_SESSION;
        foreach (explode('.', $name) as $key) {

            if (isset($session[$key])) {

                $session = &$session[$key];

            } else {

                return null;

            }

        }

        return $session;

    }

    /**
     * Удалить сессию
     *
     * @param string $name
     * @return mixed
     */
    public function delete (string $name) {

        $session = &$_SESSION;
        $name    = explode('.', $name);
        foreach ($name as $id => $key) {

            if (isset($session[$key]) && !isset($name[$id + 1])) {

                unset($session[$key]);

            } else {

                $session = &$session[$key];

            }

        }

    }

    /**
     * Метод для установки настроек класса
     *
     * @param array $config
     * @return array
     */
    public function config (array $config) : array {

        return self::$config = array_merge(self::$config, $config);

    }

}
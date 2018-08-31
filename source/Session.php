<?php declare(strict_types = 1);

namespace arhone\session;

/**
 * Управление сессией
 *
 * Class Session
 * @package arhone\session
 * @author Алексей Арх <info@arh.one>
 */
class Session implements SessionInterface {

    /**
     * Конфигурация класса
     *
     * @var array
     */
    protected $config = [
        'name' => 'session'
    ];

    /**
     * SessionInterface constructor.
     *
     * @param array $config
     */
    public function __construct (array $config = []) {

        self::config($config);

    }

    /**
     * Возвращает или устанавливает имя сессии
     *
     * @param null|string $name
     * @return string
     */
    public function name ($name = null) : string {

        return session_name(!empty($name) ? $name : $this->config['name']);

    }

    /**
     * Получает и/или устанавливает идентификатор текущей сессии
     *
     * @param string|null $id
     * @return string
     */
    public function id ($id = null) : string {

        return !empty($id) ? session_id($id) : session_id();

    }

    /**
     * Запуск сессии
     *
     * @param string|null $id
     * @return bool
     */
    public function start ($id = null) : bool {

        if (!empty($id)) {
            $this->id($id);
        }

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
     * Удалить сессию
     *
     * @return bool
     */
    public function destroy () : bool {

        return session_destroy();

    }

    /**
     * Записывает данные сессии и завершает её
     */
    public function close () {

        session_write_close();

    }

    /**
     * Удалить все переменные сессии
     */
    public function unset () {

        session_unset();

    }

    /**
     * Метод для установки настроек класса
     *
     * @param array $config
     * @return array
     */
    public function config (array $config) : array {

        return $this->config = array_merge($this->config, $config);

    }

}
<?php

namespace Patterns\Other\DIContainer;

use Exception;

class Model
{
    /**
     * @var DBConnection
     */
    private $db;

    /**
     * Строка со случайными символами. Добавлена для того, чтобы легко было проверить при повторном получении
     * аналогичного объекта через контейнер внедрения зависимости, что получили уже созданный объект, а не создался
     * новый
     *
     * @var string
     */
    private $hash;
    
    /**
     * DBConnection, который требуется для создания модели будет создан автоматически, при создании Model через 
     * контейнер внедрения зависимостей
     * 
     * @param DBConnection $DBConnection
     * @throws Exception
     */
    public function __construct(DBConnection $DBConnection)
    {
        $this->db = $DBConnection;
        $this->hash = $this->generateString();
    }

    /**
     * @return DBConnection
     */
    public function getDb(): DBConnection
    {
        return $this->db;
    }

    /**
     * @return string
     */
    public function getHash(): string
    {
        return $this->hash;
    }

    /**
     * @param int $length
     * @return string
     * @throws Exception
     */
    private function generateString($length = 15): string
    {
        $chars = '1234567890ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz';
        $numChars = strlen($chars);
        $string = '';
        for ($i = 0; $i < $length; $i++) {
            $string .= $chars[random_int(1, $numChars) - 1];
        }
        return $string;
    }
}

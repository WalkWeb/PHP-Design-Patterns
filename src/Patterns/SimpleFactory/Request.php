<?php

namespace Patterns\SimpleFactory;

class Request
{
    /**
     * @var array
     */
    private $cookieParams = [];

    /**
     * @var null|array|object
     */
    private $parsedBody;

    /**
     * @var array
     */
    private $queryParams = [];

    /**
     * @var array
     */
    private $serverParams;

    /**
     * @var array
     */
    private $uploadedFiles;

    /**
     * Заполняет объект данными. Для простоты примера перечислены не все параметры, которые заполняются в Request
     *
     * Пример реального, и сделанного по PSR-7 стандарту объекта Request можно, например, в библиотеке Zend\Diactoros
     * класс ServerRequest
     *
     * @param array $serverParams
     * @param array $uploadedFiles
     * @param array $cookies
     * @param array $queryParams
     * @param null $parsedBody
     */
    public function __construct(
        array $serverParams = [],
        array $uploadedFiles = [],
        array $cookies = [],
        array $queryParams = [],
        $parsedBody = null
    )
    {
        $this->serverParams  = $serverParams;
        $this->uploadedFiles = $uploadedFiles;
        $this->cookieParams  = $cookies;
        $this->queryParams   = $queryParams;
        $this->parsedBody    = $parsedBody;
    }
}

<?php

namespace Patterns\Structural\DI;

/**
 * Допустим, мы создаем какой-то функционал для школы. У нас есть сущность школьника и школы.
 *
 * Какие ошибки проектирования мы можем допустить:
 *
 * 1. Указать все нужные параметры школы сразу с сущность школьника, под предлогом того, что школа у нас одна, и её
 * параметры не меняются.
 *
 * Последствия: если наш функционал будет расширяться, и нам потребуется использовать его для разных  школ, придется
 * много всего переписывать
 *
 * 2. Указать школу отдельным методом setSchool(...)
 *
 * Последствия: кто-то может забыть вызвать этот отдельный метод, и когда будет вызван метод, обращающийся к школе,
 * будет ошибка
 *
 * 3. Указать конкретный класс школы в конструкторе.
 *
 * Последствия: если в какой-то ситуации нам понадобится передать не класс School, а какой-то другой, даже если он
 * реализует все необходимые методы, мы не сможем это легко сделать - потому что привязка идет именно к классу. Чтобы
 * избежать такой привязки к конкретным классам, и, соответственно, к конкретным реализациям, лучше делать проверку на
 * интерфейс.
 *
 * ---------------------------------------------------------------------------------------------------------------------
 * Пример, указанный ниже, за счет использования паттерна Dependency Injection не имеет перечисленных недостатков.
 * ---------------------------------------------------------------------------------------------------------------------
 * @package Patterns\DependencyInjection
 */
class SchoolboyDI
{
    private $name;

    private $school;

    /**
     * Конструктор, в котором мы сразу задаем имя школьника и школу, в которой он учится. Собственно здесь имы и создаем
     * зависимость сущности школьника от «внедренных» в него параметров. В большей степени это относится именно к
     * зависиомости от объекта школы.
     *
     * @param string $name
     * @param SchoolInterface $school
     */
    public function __construct(string $name, SchoolInterface $school)
    {
        $this->name = $name;
        $this->school = $school;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getSchoolName(): string
    {
        return $this->school->getName();
    }
}
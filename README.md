
Примеры моей реализации паттернов проектирования на PHP. На данный момент реализовано 14 из 26 запланированных.

# Классические паттерны

Из книги ставшей классикой «Приемы объектно-ориентированного проектирования. Паттерны проектирования»
Авторы: Эрих Гамма, Джон Влиссидес, Ральф Джонсон, Ричард Хелм

## Порождающие паттерны (Creational)

- [x] [AbstractFactory](https://github.com/WalkWeb/PHP-Design-Patterns/tree/master/src/Patterns/Creational/AbstractFactory)
- [x] [Builder](https://github.com/WalkWeb/PHP-Design-Patterns/tree/master/src/Patterns/Creational/Builder)
- [ ] Factory Method
- [x] [Prototype](https://github.com/WalkWeb/PHP-Design-Patterns/tree/master/src/Patterns/Creational/Prototype)
- [x] [Singleton](https://github.com/WalkWeb/PHP-Design-Patterns/tree/master/src/Patterns/Creational/Singleton)

## Структурные паттерны (Structural)

- [x] [Adapter](https://github.com/WalkWeb/PHP-Design-Patterns/tree/master/src/Patterns/Structural/Adapter)
- [ ] Bridge
- [ ] Composite
- [x] [Decorator](https://github.com/WalkWeb/PHP-Design-Patterns/tree/master/src/Patterns/Structural/Decorator)
- [x] [Facade](https://github.com/WalkWeb/PHP-Design-Patterns/tree/master/src/Patterns/Structural/Facade)
- [ ] Flyweight
- [ ] Proxy

## Паттерны поведения (Behavioral)
 
- [ ] Chain of Responsibility
- [ ] Command
- [ ] Interpreter
- [x] [Iterator](https://github.com/WalkWeb/PHP-Design-Patterns/tree/master/src/Patterns/Behavioral/Iterator)
- [ ] Mediator
- [ ] Momento
- [x] [Observer](https://github.com/WalkWeb/PHP-Design-Patterns/tree/master/src/Patterns/Behavioral/Observer)
- [x] [State](https://github.com/WalkWeb/PHP-Design-Patterns/tree/master/src/Patterns/Behavioral/State)
- [x] [Strategy](https://github.com/WalkWeb/PHP-Design-Patterns/tree/master/src/Patterns/Behavioral/Strategy)
- [ ] Template Method
- [ ] Visitor

# Неклассические паттерны

Паттерны, которых нет в книге «Приемы объектно-ориентированного проектирования. Паттерны проектирования», но которые 
были придуманы другими программистами и сегодня довольно часто используются.

- [x] [Контейнер внедрения зависимостей](https://github.com/WalkWeb/PHP-Design-Patterns/tree/master/src/Patterns/Other/DIContainer)
- [x] [NullObject](https://github.com/WalkWeb/PHP-Design-Patterns/tree/master/src/Patterns/Other/NullObject)
- [x] [Immutable](https://github.com/WalkWeb/PHP-Design-Patterns/tree/master/src/Patterns/Other/Immutable)

# Планы

- Добавить реализацию недостающих паттернов
- Разобраться с паттерном «Внедрение зависимостей», он размещен в Structural, хотя перепроверив - не нашел его в книге.
- Добиться 100% покрытия кода unit-тестами

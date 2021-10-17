
Примеры моей реализации паттернов проектирования на PHP. На данный момент реализовано 14 из 26 запланированных.

# Классические паттерны

Из книги ставшей классикой «Приемы объектно-ориентированного проектирования. Паттерны проектирования»
Авторы: Эрих Гамма, Джон Влиссидес, Ральф Джонсон, Ричард Хелм

## Порождающие паттерны (Creational)

- [x] [AbstractFactory](src/Creational/AbstractFactory/)
- [x] [Builder](src/Creational/Builder)
- [ ] Factory Method
- [x] [Prototype](src/Creational/Prototype)
- [x] [Singleton](src/Creational/Singleton)

## Структурные паттерны (Structural)

- [x] [Adapter](src/Structural/Adapter)
- [ ] Bridge
- [ ] Composite
- [x] [Decorator](src/Structural/Decorator)
- [x] [Facade](src/Structural/Facade)
- [ ] Flyweight
- [ ] Proxy

## Паттерны поведения (Behavioral)
 
- [ ] Chain of Responsibility
- [ ] Command
- [ ] Interpreter
- [x] [Iterator](src/Structural/Iterator)
- [ ] Mediator
- [ ] Momento
- [x] [Observer](src/Structural/Observer)
- [x] [State](src/Structural/State)
- [x] [Strategy](src/Structural/Strategy)
- [ ] Template Method
- [ ] Visitor

# Неклассические паттерны

Паттерны, которых нет в книге «Приемы объектно-ориентированного проектирования. Паттерны проектирования», но которые 
были придуманы другими программистами и сегодня довольно часто используются.

- [ ] [Контейнер внедрения зависимостей](src/Other/DIContainer)
- [ ] [NullObject](src/Other/NullObject)
- [ ] [Immutable](src/Other/Immutable)

# Планы

- Добавить реализацию недостающих паттернов
- Разобраться с паттерном «Внедрение зависимостей», он размещен в Structural, хотя перепроверив - не нашел его в книге.
- Добиться 100% покрытия кода unit-тестами

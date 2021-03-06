<?php

declare(strict_types=1);

namespace Patterns\Creational\AbstractFactory\Spell;

/**
 * В нашем простом примере DamageSpell не имеет никакого уникального функционала, но на практике каждый тип заклинания
 * может иметь свои особенности, например, на силу боевого заклинания может влиять расположение персонажа - например,
 * в локациях зимы заклинания типа льда будут получать бонус к урону, а в локациях пустыни, наоборот, штраф
 *
 * В этом случае дочерний класс будет переопределять родительский метод getPower(), и выглядеть он будет уже чуть
 * сложнее:
 * getPower(Location $location): int
 *
 * А с учетом того, что другие типы заклинаний могут требовать и другие игровые объекты для своих механик, общий
 * интерфейс может выглядеть так:
 *
 * getPower(World $world, Location $location, Character $character): int
 *
 * А в еще более сложной логике может оказаться так, что одно заклинание может иметь несколько эффектов, и в этом случае
 * будет возвращаться не просто сила заклинания, а коллекция событий для применения к персонажу
 */
class DamageSpell extends AbstractSpell
{

}

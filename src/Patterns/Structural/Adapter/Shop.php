<?php

namespace Patterns\Structural\Adapter;

/**
 * Допустим, у нас есть некий магазин, который работает с объектами, наследующих интерфейс ProductInterface
 *
 * Но нам нужно «скормить» ему другой объект, от интерфейса CarInterface. Чтобы подменить интерфейс объекта используется
 * адаптер. Который, при необходимости, может немного доработать методы объекта, чтобы они соответствовали нужному нам
 * интерфейсу.
 *
 * Паттерн Адаптер легко перепутать с другим паттерном - Декоратор. Визуально они делают одно и тоже - «обвалакивают»
 * некий объект. Но отличаются они задачей - Адаптер используется для подмены интерфейса, а Декоратора для доработки
 * функционала объекта, без непосредственного изменения самого объекта.
 *
 * @package Patterns\Adapter
 */
class Shop
{
    public function getProductName(ProductInterface $product): string
    {
        return $product->getName();
    }
}
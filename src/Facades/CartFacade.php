<?php
namespace Kemetech\Cart\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * Class CartFacade
 * @package Kemetech\Cart
 */
class CartFacade extends Facade
{
    /**
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'cart';
    }
}
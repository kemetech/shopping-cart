<?php
namespace Kemetech\Cart\Collection;

use Illuminate\Support\Collection;

class Item extends Collection
{
    /**
     * @var $model
     */
    protected $model;

    /**
     * Get the property from Collection
     *
     * @param string $property
     * @return mixed|void
     */
    public function __get($property)
    {
        if ($this->has($property))
        {
            return $this->get($property);
        }

        // Below code will be used for the shopping cart when,
        // we change the storage type to the database.

        if (!$this->get('__model'))
        {
            return;
        }

        $model = $this->get('__model');

        $class = explode('\\', $model);

        if (strtolower(end($class)) === $property)
        {
            $model = new $model();

            return $model->find($this->id);
        }

        return;
    }

    /**
     *  Get RawId from Collection of Shopping Cart
     *
     * @return mixed|void
     */
    public function rawId()
    {
        return $this->__raw_id;
    }
        
}
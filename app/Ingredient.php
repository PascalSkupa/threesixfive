<?php

namespace App;

use Fatsecret;

class Ingredient
{

    private $id;

    private $name;

    private $sub_categories;

    private $servings;

    private $measurement;

    private $units;

    public function __construct($ingredient)
    {
        $this->id = $ingredient['food_id'];
        $this->name = $ingredient['food_name'];
        $this->units = $ingredient['number_of_units'];
        $this->measurement = $ingredient['measurement_description'];

        $fat = FatSecret::getIngredient($this->id);

        $this->sub_categories = $fat['food']['food_sub_categories']['food_sub_category'];

        $this->servings = $fat['servings']['serving'];
    }

    public function hasSubCategory($category)
    {
        return in_array($category, $this->sub_categories);
    }

    /**
     * @return Integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return String
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @return String
     */
    public function getMeasurement()
    {
        return $this->measurement;
    }

    /**
     * @return mixed
     */
    public function getUnits()
    {
        return $this->units;
    }

    /**
     * @return mixed
     */
    public function getSubCategories()
    {
        return $this->sub_categories;
    }

    /**
     * @return mixed
     */
    public function getServings()
    {
        return $this->servings;
    }
}
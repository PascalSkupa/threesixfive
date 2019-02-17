<?php

namespace App;


class Ingredient
{

    private $id;

    private $name;

    private $sub_categories;

    private $servings;

    public function __construct($ingredient)
    {
        $this->id = $ingredient['food_id'];
        $this->name = $ingredient['food_name'];
        $this->sub_categories = $ingredient['food_sub_categories']['food_sub_category'];
        $this->servings = $ingredient['servings']['serving'];
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
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
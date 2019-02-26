<?php

namespace App;


class Recipe
{

    private $id;

    private $name;

    private $description;

    private $types;

    private $categories;

    private $serving;

    private $ingredients;

    private $direction;

    const ALL_ALLERGENS = [
        'A' => [],
        'B' => [],
        'C' => [],
        'D' => [],
        'E' => [],
        'F' => [],
        'G' => [],
        'H' => [],
        'I' => [],
        'K' => [],
        'L' => [],
        'M' => [],
        'N' => [],
        'O' => []
    ];

    public function __construct($recipe)
    {
        $this->id = $recipe['recipe_id'];
        $this->name = $recipe['recipe_name'];
        $this->description = $recipe['recipe_description'];
        $this->types = $recipe['recipe_types']['recipe_type'];
        $this->categories = $recipe['recipe_categories']['recipe_category'];
        $this->serving = $recipe['number_of_servings'];
        $this->direction = $recipe['directions']['direction'];
        $this->ingredients = [];

        foreach ($recipe['ingredients']['ingredient'] as $ingredient) {
            array_push($this->ingredients, new Ingredient($ingredient));
        }
    }

    public function hasAllergen($allergen)
    {
        foreach ($this->ingredients as $ingredient) {
            foreach (Recipe::ALL_ALLERGENS[$allergen] as $subCategory) {
                if ($ingredient->hasSubCategory($subCategory)) {
                    return true;
                }
            }
        }

        return false;
    }

    public function hasNoGo($nogo)
    {
        foreach ($this->ingredients as $ingredient) {
            if ($ingredient->hasSubCategory($nogo)) {
                return true;
            }
        }

        return false;
    }

    public function hasDiet($diet)
    {
        foreach ($this->categories as $category) {
            if ($category == $diet) {
                return true;
            }
        }

        return false;
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
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @return mixed
     */
    public function getTypes()
    {
        return $this->types;
    }

    /**
     * @return mixed
     */
    public function getCategories()
    {
        return $this->categories;
    }

    /**
     * @return mixed
     */
    public function getServing()
    {
        return $this->serving;
    }

    /**
     * @return mixed
     */
    public function getIngredients()
    {
        return $this->ingredients;
    }

    /**
     * @return mixed
     */
    public function getDirection()
    {
        return $this->direction;
    }
}
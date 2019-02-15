<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It is a breeze. Simply tell Lumen the URIs it should respond to
| and give it the Closure to call when that URI is requested.
|
*/

$router->get('/', function () use ($router) {
    return $router->app->version();
});

$router->group(['prefix' => 'api'], function () use ($router) {

    // Get all users with http://localhost:8000/api/users
    $router->get('users', ['uses' => 'UsersController@showAllUsers']);

    // Get one specific user with http://localhost:8000/api/users/id
    $router->get('users/{id}', ['uses' => 'UsersController@showOneUser']);

    // Login with http://localhost:8000/api/login
    $router->post('login', ['uses' => 'UsersController@login']);

    // Create user with http://localhost:8000/api/users
    $router->post('users', ['uses' => 'UsersController@create']);

    // Delete user with http://localhost:8000/api/users/id
    $router->delete('users/{id}', ['uses' => 'UsersController@delete']);

    // Update user with http://localhost:8000/api/users/id
    $router->put('users/{id}', ['uses' => 'UsersController@update']);



    // Get menu from one specific user with http://localhost:8000/api/menu/userid
    $router->get('menu/{id}/{year}/{week}', ['uses' => 'MenuController@getMenu']);

    // Generate menu for one specific user with http://localhost:8000/api/algorithm/generate/userid
    $router->post('form/{id}', ['uses' => 'AlgorithmController@generateAlgorithm']);

    //



    // Create grocery list for one specific user with http://localhost:8000/api/grocerylist
    $router->post('groceries/{id}', ['uses' => 'GroceryListController@createIndividualGroceryList']);

    // Get grocery list from one specific user with http://localhost:8000/api/grocerylist/userid
    $router->get('groceries/{id}', ['uses' => 'GroceryListController@getGroceryList']);



    // Get all allergens with http://localhost:8000/api/allergens
    $router->get('allergens', ['uses' => 'AllergensController@getAllAllergens']);

    // Get one allergens with http://localhost:8000/api/allergens/id
    $router->get('allergens/{id}', ['uses' => 'AllergensController@getAllergen']);

    // Get all categories with http://localhost:8000/api/categories
    $router->get('categories', ['uses' => 'CategoryController@getAllCategories']);

    // Get one categories with http://localhost:8000/api/categories/id
    $router->get('categories/{id}', ['uses' => 'CategoryController@getCategory']);

    // Get all diets with http://localhost:8000/api/diets
    $router->get('diets', ['uses' => 'DietController@getAllDiets']);

    // Get one diets with http://localhost:8000/api/diets/id
    $router->get('diets/{id}', ['uses' => 'DietController@getDiet']);

});

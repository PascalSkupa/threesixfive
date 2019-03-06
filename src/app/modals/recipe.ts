import {Grocery} from './grocery';

export class Recipe {
  food_name: string;
  groceries = new Array<Grocery>();
  food_id: number;
  food_type: string;
  food_url: string;
  calcium: number;
  calories: number;
  carbohydrate: number;
  fat: number;
  fiber: number;
  iron: number;
  metric_serving_unit: string;
  monounsaturated_fat: number;
  number_of_units: number;
  polyunsaturated_fat: number;
  pottasium: number;
  protein: number;
  saturated_fat: number;
  serving_description: string;
  serving_id: number;
  serving_url: string;
  sodium: number;
  sugar: number;
  vitamin_a: number;
  vitamin_c: number;
  getId() {
    return this.food_id;
  }
}




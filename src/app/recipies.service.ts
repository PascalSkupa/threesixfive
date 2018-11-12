import {Injectable} from '@angular/core';
import {Recipe} from './recipe';

@Injectable({
  providedIn: 'root'
})
export class RecipiesService {

  list = new Array<Recipe>();

  constructor() {
  }

  getRecipe(id) {
    for (const recipe of this.list) {
      if (recipe.getId() === id) {
        return recipe;
      }
    }
  }
}

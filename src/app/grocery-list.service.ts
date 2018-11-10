import {Injectable} from '@angular/core';
import {Grocery} from './grocery';

@Injectable({
  providedIn: 'root'
})

export class GroceryListService {
  constructor() {
  }
   list = new Array<Grocery>();

   addToList(grocery) {
    this.list.push(grocery);
  }
  removeFromList(grocery) {
    this.list.splice(this.list.indexOf(grocery), 1);
  }
}

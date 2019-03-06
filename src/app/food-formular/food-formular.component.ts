import {Component, OnInit} from '@angular/core';
import {first} from 'rxjs/operators';
import {Router} from '@angular/router';
import {SelectItem} from 'primeng/api';

@Component({
  selector: 'app-food-formular',
  templateUrl: './food-formular.component.html',
  styleUrls: ['./food-formular.component.scss']
})
export class FoodFormularComponent implements OnInit {

  meals: SelectItem[];

  diets: SelectItem[];

  allergie: SelectItem[];

  nogo: SelectItem[];

  selectedMeals: string;
  selectedDiets: string;

  val1 = 1;

  selectedDays: string[] = ['Montag', 'Dienstag', 'Mittwoch', 'Donnerstag', 'Freitag', 'Samstag', 'Sonntag'];

  constructor(private router: Router) {

    this.meals = [
      {label: 'Breakfast', value: 'Breakfast'},
      {label: 'Lunch', value: 'Lunch'},
      {label: 'Dinner', value: 'Dinner'},
      {label: 'Snack', value: 'Snack'}
    ];

    this.diets = [
      {label: 'Dairy Free', value: 'Dairy Free', icon: ''},
      {label: 'Gluten Free', value: 'Gluten Free', icon: ''},
      {label: 'High Protein', value: 'High Protein', icon: ''},
      {label: 'Low Calorie', value: 'Low Calorie', icon: ''},
      {label: 'Low Carb', value: 'Low Carb', icon: ''}
    ];

    this.allergie = [
      {label: 'Celery', value: 'Celery', icon: ''},
      {label: 'Crustaceans', value: 'Crustaceans', icon: ''},
      {label: 'Egg', value: 'Egg', icon: ''},
      {label: 'Fish', value: 'Fish', icon: ''},
      {label: 'Gluten', value: 'Gluten', icon: ''},
      {label: 'Lactose', value: 'Lactose', icon: ''},
      {label: 'Lupines', value: 'Lupines', icon: ''},
      {label: 'Molluscs', value: 'Molluscs', icon: ''},
      {label: 'Mustard', value: 'Mustard', icon: ''},
      {label: 'Nuts', value: 'Nuts', icon: ''},
      {label: 'Peanuts', value: 'Peanuts', icon: ''},
      {label: 'Sesame', value: 'Sesame', icon: ''},
      {label: 'Soy', value: 'Soy', icon: ''},
      {label: 'Sulphites', value: 'Sulphites', icon: ''},
    ];

    this.nogo = [
      {label: 'Beef', value: 'Beef', icon: ''},
      {label: 'Broccoli', value: 'Broccoli', icon: ''},
      {label: 'Cabbage', value: 'Cabbage', icon: ''},
      {label: 'Fish', value: 'Fish', icon: ''},
      {label: 'Lamb', value: 'Lamb', icon: ''},
      {label: 'Licorice', value: 'Licorice', icon: ''},
      {label: 'Mushrooms', value: 'Mushrooms', icon: ''},
      {label: 'Nuts', value: 'Nuts', icon: ''},
      {label: 'Pork', value: 'Pork', icon: ''},
      {label: 'Raisin', value: 'Raisin', icon: ''},
      {label: 'Seafood', value: 'Seafood', icon: ''},
      {label: 'Soy Milk', value: 'Soy Milk', icon: ''},
      {label: 'Soy Nuts', value: 'Soy Nuts', icon: ''},
      {label: 'Soy Sauce', value: 'Soy Sauce', icon: ''},
      {label: 'Soy Yogurt', value: 'Soy Yogurt', icon: ''},
      {label: 'Tofu', value: 'Tofu', icon: ''},
      {label: 'Tomatoes', value: 'Tomatoes', icon: ''}
    ];
  }


  clear() {
    this.selectedMeals = null;
  }

  ngOnInit() {
  }

  onSubmit() {
    this.router.navigate(['/']);
  }


}

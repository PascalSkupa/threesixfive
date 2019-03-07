import {Component, OnInit} from '@angular/core';
import {first} from 'rxjs/operators';
import {Router} from '@angular/router';
import {SelectItem} from 'primeng/api';
import {FormControl, FormGroup, Validators} from '@angular/forms';

@Component({
  selector: 'app-food-formular',
  templateUrl: './food-formular.component.html',
  styleUrls: ['./food-formular.component.scss']
})
export class FoodFormularComponent implements OnInit {

  foodForm: FormGroup;

  submitted: boolean;

  meals: SelectItem[];

  diets: SelectItem[];

  allergie: ({ label: string; value: string; name: string; allergen: string })[];

  nogo: ({ label: string; name: string; nogo: string })[];

  selectedMeals: string;
  selectedDiets: string;

  val1 = 1;

  selectedDays: string[] = ['Montag', 'Dienstag', 'Mittwoch', 'Donnerstag', 'Freitag', 'Samstag', 'Sonntag'];

  constructor(
    private router: Router,
  ) {

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
      {label: 'Celery', value: 'Celery', name: 'Celery', allergen: 'celery.svg'},
      {label: 'Crustaceans', value: 'Crustaceans', name: 'Crustaceans', allergen: 'crustaceans.svg'},
      {label: 'Egg', value: 'Egg', name: 'Egg', allergen: 'egg.svg'},
      {label: 'Fish', value: 'Fish', name: 'Fish', allergen: 'fish.svg'},
      {label: 'Gluten', value: 'Gluten', name: 'Gluten', allergen: 'gluten.svg'},
      {label: 'Lactose', value: 'Lactose', name: 'Lactose', allergen: 'lactose.svg'},
      {label: 'Lupines', value: 'Lupines', name: 'Lupines', allergen: 'lupines.svg'},
      {label: 'Molluscs', value: 'Molluscs', name: 'Molluscs', allergen: 'molluscs.svg'},
      {label: 'Mustard', value: 'Mustard', name: 'Mustard', allergen: 'mustard.svg'},
      {label: 'Nuts', value: 'Nuts', name: 'Nuts', allergen: 'nuts.svg'},
      {label: 'Peanuts', value: 'Peanuts', name: 'Peanuts', allergen: 'peanuts.svg'},
      {label: 'Sesame', value: 'Sesame', name: 'Sesame', allergen: 'sesame.svg'},
      {label: 'Soy', value: 'Soy', name: 'Soy', allergen: 'soy.svg'},
      {label: 'Sulphites', value: 'Sulphites', name: 'Sulphites', allergen: 'sulphites.svg'}
    ];

    this.nogo = [
      {label: 'Beef', name: 'Beef', nogo: 'beef.svg'},
      {label: 'Broccoli', name: 'Broccoli', nogo: 'broccoli.svg'},
      {label: 'Cabbage', name: 'Cabbage', nogo: 'cabbage.svg'},
      {label: 'Fish', name: 'Fish', nogo: 'fish.svg'},
      {label: 'Lamb', name: 'Lamb', nogo: 'lamb.svg'},
      {label: 'Licorice', name: 'Licorice', nogo: 'licorice.svg'},
      {label: 'Mushrooms', name: 'Mushrooms', nogo: 'mushrooms.svg'},
      {label: 'Nuts', name: 'Nuts', nogo: 'nuts.svg'},
      {label: 'Pork', name: 'Pork', nogo: 'pork.svg'},
      {label: 'Raisin', name: 'Raisin', nogo: 'raisin.svg'},
      {label: 'Seafood', name: 'Seafood', nogo: 'seafood.svg'},
      {label: 'Soy Milk', name: 'Soy Milk', nogo: 'soymilk.svg'},
      {label: 'Soy Nuts', name: 'Soy Nuts', nogo: 'soynuts.svg'},
      {label: 'Soy Sauce', name: 'Soy Sauce', nogo: 'soysauce.svg'},
      {label: 'Soy Yogurt', name: 'Soy Yogurt', nogo: 'soyyogurt.svg'},
      {label: 'Tofu', name: 'Tofu', nogo: 'tofu.svg'},
      {label: 'Tomatoes', name: 'Tomatoes', nogo: 'tomatoes.svg'}
    ];
  }


  clear() {
    this.selectedMeals = null;
  }

  ngOnInit() {
    this.foodForm = new FormGroup(
      {persons: new FormControl()
    });
  }

  onSubmit() {
    this.router.navigate(['/']);
  }


}

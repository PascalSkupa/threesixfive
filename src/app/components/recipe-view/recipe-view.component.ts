import {Component, Input, OnInit} from '@angular/core';
import {Recipe} from '../../modals/recipe';

@Component({
  selector: 'app-recipe-view',
  templateUrl: './recipe-view.component.html',
  styleUrls: ['./recipe-view.component.scss']
})
export class RecipeViewComponent implements OnInit {
  @Input() title;


  constructor() { }

  ngOnInit() {
  }

}

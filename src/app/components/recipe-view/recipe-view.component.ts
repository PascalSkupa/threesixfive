import {Component, Input, OnInit, ViewContainerRef} from '@angular/core';

@Component({
  selector: 'app-recipe-view',
  templateUrl: './recipe-view.component.html',
  styleUrls: ['./recipe-view.component.scss']
})
export class RecipeViewComponent implements OnInit {
  @Input() title: string;
  @Input() expandedView: boolean;

  constructor(viewContainerRef: ViewContainerRef) { }

  ngOnInit() {
  }
  cancel() {

  }

}

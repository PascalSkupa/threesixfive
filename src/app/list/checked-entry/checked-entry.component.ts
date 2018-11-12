import { Component, OnInit } from '@angular/core';
import {GroceryListService} from '../../grocery-list.service';

@Component({
  selector: 'app-checked-entry',
  templateUrl: './checked-entry.component.html',
  styleUrls: ['./checked-entry.component.scss']
})
export class CheckedEntryComponent implements OnInit {

  checkedGroceryList = this.service.checkedGroceries;

  constructor(private service: GroceryListService) { }

  deleteCheckedGrocery(grocery) {
    this.service.removeFromCheckedGroceries(grocery);
  }
  ngOnInit() {
  }

}

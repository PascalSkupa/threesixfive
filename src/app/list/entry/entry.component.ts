import {Component, OnInit} from '@angular/core';
import {GroceryListService} from '../../grocery-list.service';
import {Grocery} from '../../grocery';


@Component({
  selector: 'app-entry',
  templateUrl: './entry.component.html',
  styleUrls: ['./entry.component.scss']
})
export class EntryComponent implements OnInit {
  groceryList = this.service.list;
  constructor(private service: GroceryListService) {
  }
  ngOnInit() {
  }

  deleteGrocery(grocery) {
    this.service.removeFromList(grocery);
  }
}

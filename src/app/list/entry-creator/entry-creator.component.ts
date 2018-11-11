import {Component, OnInit} from '@angular/core';
import {GroceryListService} from '../../grocery-list.service';
import {Grocery} from '../../grocery';

@Component({
  selector: 'app-entry-creator',
  templateUrl: './entry-creator.component.html',
  styleUrls: ['./entry-creator.component.scss']
})
export class EntryCreatorComponent implements OnInit {

  name: string;
  amount: number;
  unit: string;

  constructor(private service: GroceryListService) {
  }

  addToList() {
    this.service.addToList(
      new Grocery(this.name, this.amount, this.unit)
    );
  }
  ngOnInit() {
  }


}

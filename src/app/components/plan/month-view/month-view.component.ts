import { Component, OnInit } from '@angular/core';

@Component({
  selector: 'app-month-view',
  templateUrl: './month-view.component.html',
  styleUrls: ['./month-view.component.scss']
})
export class MonthViewComponent implements OnInit {

  private date = new Date();
  month = this.date.toLocaleString('en-us', { month: 'long' });
  constructor() { }

  ngOnInit() {
  }
}

import {Component, Input, OnInit} from '@angular/core';

@Component({
  selector: 'app-day-view',
  templateUrl: './day-view.component.html',
  styleUrls: ['./day-view.component.scss']
})


export class DayViewComponent implements OnInit {

  @Input() Date;
  date: string;
  recipieView: boolean;

  constructor() {
  }

  ngOnInit() {
    this.date = this.Date.toString();
    this.date = this.date.substring(0, 16);
  }

  clickOnRecipie() {
    this.recipieView = true;
  }

  cancel() {
    this.recipieView = false;
  }
}

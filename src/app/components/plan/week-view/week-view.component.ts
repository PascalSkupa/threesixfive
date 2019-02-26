import {Component, Input, OnInit} from '@angular/core';
import * as moment from 'moment';
@Component({
  selector: 'app-week-view',
  templateUrl: './week-view.component.html',
  styleUrls: ['./week-view.component.scss']
})
export class WeekViewComponent implements OnInit {
   days: any[];
   // numbers: any[] = {1, 2, 3, 4, 5, 6, 0};
  constructor() {
  }

  @Input() Date;

  ngOnInit() {
  }

  getWeek() {

    if (moment().day() === 0) {
    }
    for (let i = 0; i <= 6; i++) {

    }
  }
}

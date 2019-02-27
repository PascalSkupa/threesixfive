import {Component, Input, OnInit} from '@angular/core';
import * as moment from 'moment';
import {PlanService} from "../../../services/plan/plan.service";

@Component({
  selector: 'app-week-view',
  templateUrl: './week-view.component.html',
  styleUrls: ['./week-view.component.scss']
})
export class WeekViewComponent implements OnInit {
  // numbers: any[] = {1, 2, 3, 4, 5, 6, 0};


  clickedDate;
  key = this.service.actualView;
  days =
    {
      'Monday': 0,
      'Tuesday': 1,
      'Wednesday': 2,
      'Thursday': 3,
      'Friday': 4,
      'Saturday': 5,
      'Sunday': 6
    };

  week;



  constructor(private service: PlanService) {
  }

  @Input() Date;

  ngOnInit() {
    let b = moment().format('dddd');
    let a = this.days[b];
    console.log(b + a + "");
    let monday = moment().subtract(a, 'days').format("MMM Do YY");
    let woche = [];
    for(let i = 0; i<7; i++) {
      woche.push(moment().add(i - a, 'days'))
    }
    this.week = woche;
    console.log(this.week);
  }

  showDate(date) {
    this.service.dayIsClicked(date);
    this.clickedDate = this.service.clickedDate;
    this.service.viewDay();
    this.key = this.service.actualView;
    console.log("kjk");
  }

}

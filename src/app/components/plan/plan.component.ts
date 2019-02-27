import {
  Component,
  OnInit,
} from '@angular/core';
import {PlanService} from '../../services/plan/plan.service';
import {animate, state, style, transition, trigger} from '@angular/animations';
import * as moment from 'moment';


@Component({
  selector: 'app-plan',
  // changeDetection: ChangeDetectionStrategy.OnPush,
  templateUrl: './plan.component.html',
  styleUrls: ['./plan.component.scss'],
  animations: [
    trigger('enterTrigger', [
      state('fadeIn', style({
        opacity: '1',
        // transform: 'translateY(50%)'
      })),
      transition('void => *', [style({opacity: '0'}), animate('1000ms')])
    ])
  ]
})

export class PlanComponent implements OnInit {
  en: any;
  clickedDate;
  key = this.service.actualView;
  actualDate = new Date();
  dateValue;
  week;

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


  constructor(private service: PlanService) {
  }

  ngOnInit() {
    this.en = {
      firstDayOfWeek: 0,
      dayNames: ['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday'],
      dayNamesShort: ['Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat', 'Sun', ],
      dayNamesMin: ['Mo', 'Tu', 'We', 'Th', 'Fr', 'Sa', 'Su'],
      monthNames: [ 'January', 'February', 'March', 'April', 'May', 'June', 'July', 'August',
        'September', 'October', 'November', 'December' ],
      monthNamesShort: [ 'Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec' ],
      today: 'Today',
      clear: 'Clear',
      dateFormat: 'dd/mm/yy'
    };
  }

  calenderIsClicked() {
    this.service.dayIsClicked(this.dateValue);
    this.clickedDate = this.service.clickedDate;
    console.log(this.clickedDate);
    this.service.viewDay();
    this.key = this.service.actualView;
  }

  // viewDay() {
  //   this.clickedDate = this.service.clickedDate;
  //   console.log(this.clickedDate);
  //   this.service.viewDay();
  //   this.key = this.service.actualView;
  // }

  viewMonth() {
    this.service.viewMonth();
    this.key = this.service.actualView;
  }
  viewWeek() {
    this.service.viewWeek();
    this.key = this.service.actualView;
    this.getWeek();
  }

  getWeek() {
    let b = moment().format('dddd');
    let a = this.days[b];
    console.log(b + a + "");
    let monday = moment().subtract(a, 'days').format("MMM Do YY");
    console.log(monday);
    let woche = [];
    for(let i = 0; i<7; i++) {
      woche.push(moment().add(i - a, 'days'))
    }
    console.log(woche);
    this.week = woche;
  }
}

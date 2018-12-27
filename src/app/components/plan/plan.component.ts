import {
  Component,
  OnInit,
  ChangeDetectionStrategy, Input, Output, EventEmitter,
} from '@angular/core';
import {CalendarEvent} from 'angular-calendar';



@Component({
  selector: 'app-plan',
  changeDetection: ChangeDetectionStrategy.OnPush,
  templateUrl: './plan.component.html',
  styleUrls: ['./plan.component.scss']
})

export class PlanComponent implements OnInit {
  view = 'month';

  viewDate: Date = new Date();

  events: CalendarEvent[] = [];
  constructor() {
  }

  ngOnInit() {
  }

}

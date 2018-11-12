import {
  Component,
  OnInit,
  ChangeDetectionStrategy, Input, Output, EventEmitter,
} from '@angular/core';
import {CalendarEvent} from 'angular-calendar';
import { CalendarHeaderComponent } from './calendar-header.component';



@Component({
  selector: 'app-plan',
  changeDetection: ChangeDetectionStrategy.OnPush,
  templateUrl: './plan.component.html',
  styleUrls: ['./plan.component.scss']
})

export class PlanComponent implements OnInit {
  @Input()
  view: string;

  @Input()
  viewDate: Date;

  @Input()
  locale: 'en';

  @Output()
  viewChange: EventEmitter<string> = new EventEmitter();

  @Output()
  viewDateChange: EventEmitter<Date> = new EventEmitter();
  view = 'month';

  viewDate: Date = new Date();

  events: CalendarEvent[] = [];

  constructor() {
  }

  ngOnInit() {
  }

}

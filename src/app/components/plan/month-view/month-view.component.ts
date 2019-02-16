import {Component, EventEmitter, OnInit, Output} from '@angular/core';
import {PlanService} from '../../../services/plan/plan.service';

@Component({
  selector: 'app-month-view',
  templateUrl: './month-view.component.html',
  styleUrls: ['./month-view.component.scss']
})
export class MonthViewComponent implements OnInit {

  private date = new Date();
  month = this.date.toLocaleString('en-us', { month: 'long' });
  value;
  constructor(private service: PlanService) { }
  ngOnInit() {
  }
  calenderIsClicked() {
    this.service.dayIsClicked(this.value);
    // console.log(this.service.clickedDate);
  }

}

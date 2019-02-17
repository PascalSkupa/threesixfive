import {
  Component,
  OnInit,
} from '@angular/core';
import {PlanService} from '../../services/plan/plan.service';
import {animate, state, style, transition, trigger} from '@angular/animations';


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
  clickedDate;
  key = this.service.actualView;
  private date = new Date();
  month = this.date.toLocaleString('en-us', { month: 'long' });
  value;
  constructor(private service: PlanService) {
  }

  ngOnInit() {

  }
  calenderIsClicked() {
    this.service.dayIsClicked(this.value);
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
    this.clickedDate = this.service.clickedDate;
    console.log(this.clickedDate);
    this.service.viewMonth();
    this.key = this.service.actualView;
  }
}

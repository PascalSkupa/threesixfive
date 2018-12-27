import {Component, Input, OnInit} from '@angular/core';
@Component({
  selector: 'app-day-view',
  templateUrl: './day-view.component.html',
  styleUrls: ['./day-view.component.scss']
})




export class DayViewComponent implements OnInit {

  @Input() viewDate: String;
  date: string
  constructor() { }

  ngOnInit() {
  }
}

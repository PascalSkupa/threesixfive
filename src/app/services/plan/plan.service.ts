import { Injectable } from '@angular/core';

@Injectable({
  providedIn: 'root'
})
export class PlanService {
  clickedDate;
  actualView = 'monthComponent';
  actualDate = new Date();
  constructor() { }
  dayIsClicked(date) {
    this.clickedDate = date;
  }
  viewMonth() {
    this.actualView = 'monthComponent';
  }
  viewWeek() {
    this.actualView = 'weekComponent';
  }
  viewDay() {
    this.actualView = 'dayComponent';
  }
}

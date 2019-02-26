import { Injectable } from '@angular/core';
import {HttpClient} from '@angular/common/http';

@Injectable({
  providedIn: 'root'
})
export class PlanService {
  clickedDate;
  actualView = 'monthComponent';
  actualDate = new Date();
  constructor(private http: HttpClient) { }
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
  getDailyMeals(date) {
    // return this.http.get('https://10.19.4.215:8000/api/users');
  }
 }

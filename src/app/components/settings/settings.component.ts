import {Component, OnInit} from '@angular/core';

@Component({
  selector: 'app-settings',
  templateUrl: './settings.component.html',
  styleUrls: ['./settings.component.scss']
})
export class SettingsComponent implements OnInit {
  emailEdit = false;
  firstnameEdit = false;
  lastNameEdit = false;
  firstnameValue = 'Marwan';
  lastnameValue = 'Abdalla';
  mailValue = '4160@htl.rennweg.at';
  constructor() {
  }

  ngOnInit() {
  }

  changeMail() {
    this.emailEdit = true;
  }

  changeFisrtname() {
    this.firstnameEdit = true;
  }

  changeLastname() {
    this.lastNameEdit = true;
  }
  saveMail() {
    this.emailEdit = false;
  }
  saveFirstname() {
    this.firstnameEdit = false;
  }
  saveLastname() {
    this.lastNameEdit = false;
  }
}

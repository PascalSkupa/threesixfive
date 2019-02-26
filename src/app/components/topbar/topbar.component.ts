import {Component, OnInit} from '@angular/core';
import {MenuItem} from 'primeng/api';
import {User} from '../../login/_models';
import {Router} from '@angular/router';
import {AuthenticationService} from '../../login/_services';

@Component({
  selector: 'app-topbar',
  templateUrl: './topbar.component.html',
  styleUrls: ['./topbar.component.scss']
})
export class TopbarComponent implements OnInit {

  items: MenuItem[];
  currentUser: User;

  constructor(
    private router: Router,
    private authenticationService: AuthenticationService
  ) {
    this.authenticationService.currentUser.subscribe(x => this.currentUser = x);
  }

  logout() {
    this.authenticationService.logout();
    this.router.navigate(['/login']);
  }
  ngOnInit() {
    this.items = [
      {
        label: 'Home',
        icon: 'pi pi-fw pi-home',
        routerLink: '/plan'
      },
      {separator: true},
      {
        label: 'Grocery List', icon: 'pi pi-fw pi-list', routerLink: '/list'
      },
      {separator: true},
      {
        label: 'User', icon: 'pi pi-fw pi-user', routerLink: '/settings'
      }
    ];
  }
}

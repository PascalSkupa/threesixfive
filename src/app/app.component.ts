import {Component, OnInit} from '@angular/core';
import {User} from './login/_models';
import {Router} from '@angular/router';
import {AuthenticationService} from './login/_services';

@Component({
  selector: 'app-root',
  templateUrl: './app.component.html',
  styleUrls: ['./app.component.scss']
})
export class AppComponent {
  title = 'threesixfive';
  currentUser: User;
  currentUrl: String;

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
}

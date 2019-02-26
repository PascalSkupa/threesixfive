import { NgModule } from '@angular/core';
import { Routes, RouterModule } from '@angular/router';
import {PlanComponent} from './components/plan/plan.component';
import {ListComponent} from './components/list/list.component';
import {SettingsComponent} from './components/settings/settings.component';
import {RegisterComponent} from './login/register';
import {LoginComponent} from './login/login';
import {HomeComponent} from './login/home';
import {AuthGuard} from './login/_guards';
import {MainApplicationComponent} from './components/main-application/main-application.component';
import {FoodFormularComponent} from './food-formular/food-formular.component';



const appRoutes: Routes = [
  { path: 'foodFormular', component: FoodFormularComponent, canActivate: [AuthGuard] },
  { path: 'login', component: LoginComponent },
  { path: 'register', component: RegisterComponent },
  // { path: '', component: MainApplicationComponent, canActivate: [AuthGuard]},
  { path: '', component: MainApplicationComponent,
    // canActivate: [AuthGuard],
    children: [
      { path: 'plan', component: PlanComponent},
      { path: 'list', component: ListComponent},
      { path: 'settings', component: SettingsComponent}
    ]},

  // otherwise redirect to home
  { path: '**', redirectTo: '' },

];



@NgModule({
  imports: [RouterModule.forRoot(appRoutes)],
  exports: [RouterModule]
})

export class AppRoutingModule { }

import { NgModule } from '@angular/core';
import { Routes, RouterModule } from '@angular/router';
import {PlanComponent} from './plan/plan.component';
import {ListComponent} from './list/list.component';
import {SettingsComponent} from './settings/settings.component';

const routes: Routes = [
  {
    path: 'plan',
    component: PlanComponent
  },
  {
    path: 'list',
    component: ListComponent
  },
  {
    path: 'settings',
    component: SettingsComponent
  }
];



@NgModule({
  imports: [RouterModule.forRoot(routes)],
  exports: [RouterModule]
})

export class AppRoutingModule { }

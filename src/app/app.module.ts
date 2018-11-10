import {BrowserModule} from '@angular/platform-browser';
import {NgModule} from '@angular/core';
import {AccordionModule} from 'primeng/accordion';
import {MenuItem} from 'primeng/api';
import {AppRoutingModule} from './app-routing.module';
import {AppComponent} from './app.component';
import {SidebarComponent} from './sidebar/sidebar.component';
import {PlanComponent} from './plan/plan.component';
import {ListComponent} from './list/list.component';
import {SettingsComponent} from './settings/settings.component';
import {CommonModule} from '@angular/common';
import {FormsModule} from '@angular/forms';
import {BrowserAnimationsModule} from '@angular/platform-browser/animations';
import {CalendarModule, DateAdapter} from 'angular-calendar';
import {adapterFactory} from 'angular-calendar/date-adapters/date-fns';
import {DemoUtilsModule} from './plan/demo-utils/module';
import {EntryComponent} from './list/entry/entry.component';
import {MatButtonModule, MatCheckboxModule} from '@angular/material';
import {MatFormFieldModule} from '@angular/material/form-field';
import {MatInputModule} from '@angular/material/input';
import {MatSelectModule} from '@angular/material/select';
import {Grocery} from './grocery';
import {GroceryListService} from './grocery-list.service';
import { EntryCreatorComponent } from './list/entry-creator/entry-creator.component';


@NgModule({
  declarations: [
    AppComponent,
    SidebarComponent,
    PlanComponent,
    ListComponent,
    SettingsComponent,
    EntryComponent,
    EntryCreatorComponent
  ],
  imports: [
    CommonModule,
    BrowserModule,
    AppRoutingModule,
    CommonModule,
    FormsModule,
    BrowserAnimationsModule,
    MatButtonModule, MatCheckboxModule, MatFormFieldModule, MatInputModule, MatSelectModule,
    CalendarModule.forRoot({
      provide: DateAdapter,
      useFactory: adapterFactory
    }),
    DemoUtilsModule
  ],
  providers: [GroceryListService],
  bootstrap: [AppComponent],
  exports: [PlanComponent]
})
export class AppModule {
}

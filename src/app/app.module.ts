import {NgModule} from '@angular/core';
import {AppRoutingModule} from './app-routing.module';
import {AppComponent} from './app.component';
import {SidebarComponent} from './components/sidebar/sidebar.component';
import {PlanComponent} from './components/plan/plan.component';
import {ListComponent} from './components/list/list.component';
import {SettingsComponent} from './components/settings/settings.component';
import {CommonModule} from '@angular/common';
import {FormsModule} from '@angular/forms';
import {BrowserAnimationsModule} from '@angular/platform-browser/animations';
import {CalendarModule, DateAdapter} from 'angular-calendar';
import {adapterFactory} from 'angular-calendar/date-adapters/date-fns';
import {EntryComponent} from './components/list/entry/entry.component';
import {MatButtonModule, MatCheckboxModule} from '@angular/material';
import {MatFormFieldModule} from '@angular/material/form-field';
import {MatInputModule} from '@angular/material/input';
import {MatSelectModule} from '@angular/material/select';
import {GroceryListService} from './services/grocery-list/grocery-list.service';
import {EntryCreatorComponent} from './components/list/entry-creator/entry-creator.component';
import {CalendarHeaderComponent} from './components/plan/demo-utils/calendar-header.component';
import {CheckedEntryComponent} from './components/list/checked-entry/checked-entry.component';
import {DayViewComponent} from './components/plan/day-view/day-view.component';
import {RecipeViewComponent} from './components/recipe-view/recipe-view.component';
import {MatExpansionModule} from '@angular/material/expansion';
import { BrowserModule } from '@angular/platform-browser';
import { ReactiveFormsModule } from '@angular/forms';
import { HttpClientModule, HTTP_INTERCEPTORS } from '@angular/common/http';
import {MatDialogModule} from '@angular/material/dialog';
import {SelectButtonModule} from 'primeng/selectbutton';

// used to create fake backend
import { fakeBackendProvider } from './login/_helpers';


import { AlertComponent } from './login/_components';
import { JwtInterceptor, ErrorInterceptor } from './login/_helpers';
import { HomeComponent } from './login/home';
import { LoginComponent } from './login/login';
import { RegisterComponent } from './login/register';
import { MainApplicationComponent } from './components/main-application/main-application.component';
import { TopbarComponent } from './components/topbar/topbar.component';
import { FoodFormularComponent } from './food-formular/food-formular.component';


@NgModule({
  declarations: [
    AppComponent,
    SidebarComponent,
    PlanComponent,
    ListComponent,
    SettingsComponent,
    EntryComponent,
    EntryCreatorComponent,
    CalendarHeaderComponent,
    CheckedEntryComponent,
    DayViewComponent,
    RecipeViewComponent,
    AlertComponent,
    HomeComponent,
    LoginComponent,
    RegisterComponent,
    MainApplicationComponent,
    TopbarComponent,
    FoodFormularComponent
  ],
  imports: [
    CommonModule,
    BrowserModule,
    AppRoutingModule,
    CommonModule,
    FormsModule,
    BrowserAnimationsModule,
    MatButtonModule, MatCheckboxModule, MatFormFieldModule, MatInputModule, MatSelectModule,
    MatExpansionModule,
    ReactiveFormsModule,
    HttpClientModule,
    SelectButtonModule,
    CalendarModule.forRoot({
      provide: DateAdapter,
      useFactory: adapterFactory
    })
  ],
  providers: [GroceryListService,
    { provide: HTTP_INTERCEPTORS, useClass: JwtInterceptor, multi: true },
    { provide: HTTP_INTERCEPTORS, useClass: ErrorInterceptor, multi: true },

    // provider used to create fake backend
    fakeBackendProvider],
  bootstrap: [AppComponent],
  exports: [PlanComponent, CalendarHeaderComponent],

})
export class AppModule {
}

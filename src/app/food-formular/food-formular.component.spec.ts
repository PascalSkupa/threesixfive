import { async, ComponentFixture, TestBed } from '@angular/core/testing';

import { FoodFormularComponent } from './food-formular.component';

describe('FoodFormularComponent', () => {
  let component: FoodFormularComponent;
  let fixture: ComponentFixture<FoodFormularComponent>;

  beforeEach(async(() => {
    TestBed.configureTestingModule({
      declarations: [ FoodFormularComponent ]
    })
    .compileComponents();
  }));

  beforeEach(() => {
    fixture = TestBed.createComponent(FoodFormularComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});

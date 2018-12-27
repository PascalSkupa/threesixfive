import { async, ComponentFixture, TestBed } from '@angular/core/testing';

import { CheckedEntryComponent } from './checked-entry.component';

describe('CheckedEntryComponent', () => {
  let component: CheckedEntryComponent;
  let fixture: ComponentFixture<CheckedEntryComponent>;

  beforeEach(async(() => {
    TestBed.configureTestingModule({
      declarations: [ CheckedEntryComponent ]
    })
    .compileComponents();
  }));

  beforeEach(() => {
    fixture = TestBed.createComponent(CheckedEntryComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});

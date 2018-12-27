import { TestBed } from '@angular/core/testing';

import { GroceryListService } from './grocery-list.service';

describe('GroceryListService', () => {
  beforeEach(() => TestBed.configureTestingModule({}));

  it('should be created', () => {
    const service: GroceryListService = TestBed.get(GroceryListService);
    expect(service).toBeTruthy();
  });
});

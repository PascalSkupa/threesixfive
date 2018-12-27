import { TestBed } from '@angular/core/testing';

import { RecipiesService } from './recipies.service';

describe('RecipiesService', () => {
  beforeEach(() => TestBed.configureTestingModule({}));

  it('should be created', () => {
    const service: RecipiesService = TestBed.get(RecipiesService);
    expect(service).toBeTruthy();
  });
});

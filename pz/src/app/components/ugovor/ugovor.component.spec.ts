import { async, ComponentFixture, TestBed } from '@angular/core/testing';

import { UgovorComponent } from './ugovor.component';

describe('UgovorComponent', () => {
  let component: UgovorComponent;
  let fixture: ComponentFixture<UgovorComponent>;

  beforeEach(async(() => {
    TestBed.configureTestingModule({
      declarations: [ UgovorComponent ]
    })
    .compileComponents();
  }));

  beforeEach(() => {
    fixture = TestBed.createComponent(UgovorComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
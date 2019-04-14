import { async, ComponentFixture, TestBed } from '@angular/core/testing';

import { IzmeneKorisnikaComponent } from './izmene_korisnika.component';

describe('IzmeniKorisnikaComponent', () => {
  let component: IzmeneKorisnikaComponent;
  let fixture: ComponentFixture<IzmeneKorisnikaComponent>;

  beforeEach(async(() => {
    TestBed.configureTestingModule({
      declarations: [ IzmeneKorisnikaComponent ]
    })
    .compileComponents();
  }));

  beforeEach(() => {
    fixture = TestBed.createComponent(IzmeneKorisnikaComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
import { async, ComponentFixture, TestBed } from '@angular/core/testing';

import { DokumentacijaComponent } from './dokumentacija.component';

describe('DokumentacijaComponent', () => {
  let component: DokumentacijaComponent;
  let fixture: ComponentFixture<DokumentacijaComponent>;

  beforeEach(async(() => {
    TestBed.configureTestingModule({
      declarations: [ DokumentacijaComponent ]
    })
    .compileComponents();
  }));

  beforeEach(() => {
    fixture = TestBed.createComponent(DokumentacijaComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
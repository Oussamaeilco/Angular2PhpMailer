import { ComponentFixture, TestBed } from '@angular/core/testing';

import { AppMailerComponent } from './app-mailer.component';

describe('AppMailerComponent', () => {
  let component: AppMailerComponent;
  let fixture: ComponentFixture<AppMailerComponent>;

  beforeEach(async () => {
    await TestBed.configureTestingModule({
      declarations: [ AppMailerComponent ]
    })
    .compileComponents();
  });

  beforeEach(() => {
    fixture = TestBed.createComponent(AppMailerComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});

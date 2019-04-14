import { NgModule }      from '@angular/core';
import { BrowserModule } from '@angular/platform-browser';
import { FormsModule, ReactiveFormsModule } from '@angular/forms';
import  {HttpModule } from '@angular/http';



import { AppComponent }  from './app.component';
import { HomeComponent } from './components/home/home.component';
import { LoginComponent } from './components/login/login.component';
import { RegisterComponent } from './components/register/register.component';
import { AppRoutingModule } from './app-routing/app-routing.module';
//import { IzmeneKorisnikaComponent } from './components/izmene_korisnika/izmene_korisnika.component';
import { KorisniciComponent } from './components/korisnici/korisnici.component';

@NgModule({
  imports:      [ BrowserModule,
                  AppRoutingModule,
                  FormsModule,
                  ReactiveFormsModule,
                  HttpModule,
                 // RouterModule.forRoot()
                ],

  declarations: [ AppComponent,
                  HomeComponent,
                  LoginComponent,
                  RegisterComponent,
                  //IzmeneKorisnikaComponent,
                  KorisniciComponent],

  bootstrap:    [ AppComponent ],
  providers: [],

})

export class AppModule {
}

import {NgModule} from '@angular/core';
import {CommonModule} from '@angular/common';
import {RouterModule, Routes} from '@angular/router';

import {HomeComponent} from '../components/home/home.component';
import {AboutComponent} from '../components/about/about.component'; 
import {LoginComponent} from '../components/login/login.component';
import {RegisterComponent} from '../components/register/register.component';
//import {IzmeneKorisnikaComponent} from '../components/izmene_korisnika/izmene_korisnika.component';
import {KorisniciComponent} from '../components/korisnici/korisnici.component';


const routes: Routes = [
 {path: 'home', component: HomeComponent},
 {path: 'about', component: AboutComponent},
  {path: 'login', component: LoginComponent},
  {path: 'register', component: RegisterComponent},
 
  {path: 'users', component: KorisniciComponent},
  //{path: 'updateUser', component: IzmeneKorisnikaComponent}
];

@NgModule({
  imports: [CommonModule, RouterModule.forRoot(routes)],
  exports: [RouterModule]
})
export class AppRoutingModule {
}
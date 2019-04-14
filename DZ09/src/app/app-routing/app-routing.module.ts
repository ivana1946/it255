import {NgModule} from '@angular/core';
import {CommonModule} from '@angular/common';
import {RouterModule, Routes} from '@angular/router';
import {HomeComponent} from '../component/home/home.component';
import {KontaktComponent} from '../component/kontakt/kontakt.component';
import {RegistracijaComponent} from '../component/registracija/registracija.component';

const routes: Routes = [
  {path: 'home', component: HomeComponent},
  {path: 'kontakt', component: KontaktComponent},
  {path: 'registracija', component: RegistracijaComponent}
];

@NgModule({
  imports: [CommonModule, RouterModule.forRoot(routes)],
  exports: [RouterModule]
})
export class AppRoutingModule {
}
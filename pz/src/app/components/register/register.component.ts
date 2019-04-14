import {Component, OnInit} from '@angular/core';
import {FormControl, FormGroup} from '@angular/forms';
import {Headers, Http} from '@angular/http';
import {Router} from '@angular/router';

@Component({
  selector: 'app-register',
  templateUrl: './register.component.html',
  styleUrls: ['./register.component.css']
})
export class RegisterComponent implements OnInit {
  public registerForm = new FormGroup({
    username: new FormControl(),
    sifra: new FormControl(),
    ime: new FormControl(),
    prezime: new FormControl()
  });

  constructor(private _http: Http, private _router: Router) {}

  ngOnInit() {}

  /**
   * Ova funkcija registruje novog korisnik au bazu
   */
  public register() {

    /**
     * Ovaj deo koda preuzima vrednosti koje korisnik unese u registracionu formu
     */

    // tslint:disable-next-line:max-line-length
    const data =
      'username=' +
      this.registerForm.value.username +
      '&sifra=' +
      this.registerForm.value.sifra +
      '&ime=' +
      this.registerForm.value.ime +
      '&prezime=' +
      this.registerForm.value.prezime;

      /**
       * Ovaj deo koda postavlja hedere, kako bi mogli da prosledjumemo krenecijale putem URL-a
       */
    const headers = new Headers();
    headers.append('Content-Type', 'application/x-www-form-urlencoded');

    /**
     * Ovaj deo koda salje prikupljene podatke backendu. To je ovaj URL ispod
     * data promenljiva sadrzi sve prikupljene podatke i poslace ih formatirane onako kako 
     * bi backend razumeo poruku
     */
    this._http
      .post('http://localhost/projects/registerservice.php', data, {
        headers: headers
      })
      .subscribe(
        result => {
          const obj = JSON.parse(result['_body']);
          localStorage.setItem('token', obj.token);
          localStorage.removeItem('token');
          this._router.navigateByUrl('/login');
        },
        err => {
          const obj = JSON.parse(err._body);
          const element = <HTMLElement>(
            document.getElementsByClassName('alert')[0]
          );
          element.style.display = 'block';
          element.innerHTML = obj.error.split('\\r\\n').join('<br/>').split('\"').join('');
        }
      );
  }
}
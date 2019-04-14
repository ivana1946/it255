import {Component, OnInit} from '@angular/core';
import {FormControl, FormGroup} from '@angular/forms';
import {Headers, Http} from '@angular/http';
import {Router} from '@angular/router';

@Component({
  selector: 'app-izmene_korisnika',
  templateUrl: './izmene_korisnika.component.html',
  styleUrls: ['./izmene_korisnika.component.css']
})
export class IzmeneKorisnikaComponent implements OnInit {

  korisnik: any = [];

  public searchForm = new FormGroup({
    searchUsername: new FormControl()
  });

  public updateForm = new FormGroup({
    noviUsername: new FormControl(),
    password: new FormControl(),
    firstName: new FormControl(),
    lastName: new FormControl()
  });

  constructor(private _http: Http, private router: Router) {
  }

  ngOnInit() {
  }

  public pronadji_korisnika() {
    const headers = new Headers();
    headers.append('Content-Type', 'application/x-www-form-urlencoded');
    headers.append('token', localStorage.getItem('token'));

    const data = 'username=' + this.searchForm.value.searchUsername;

    this._http.post('http://localhost/projects/pronadji_korisnika.php', data, {headers: headers}).subscribe(
      response => {
        this.korisnik = JSON.parse(response['_body']);
        console.log(response.toString());
        console.log(this.korisnik);
        // location.reload();
      },
      error => {
        console.log(error.toString());
      }
    );
  }

  public izmeni_korinsika() {
    const headers = new Headers();
    headers.append('Content-Type', 'application/x-www-form-urlencoded');
    headers.append('token', localStorage.getItem('token'));

    const data =
      'stariUsername=' + this.searchForm.value.searchUsername +
      '&noviUsername=' + this.updateForm.value.noviUsername +
      '&sifra=' + this.updateForm.value.sifra +
      '&ime=' + this.updateForm.value.ime +
      '&prezime=' + this.updateForm.value.prezime;

    this._http.post('http://localhost/projects/izmeni_korisnika.php', data, {headers: headers}).subscribe(
      response => {
        console.log(response.toString());
      },
      error1 => {
        console.log(error1.toString());
      }
    );
  }
}

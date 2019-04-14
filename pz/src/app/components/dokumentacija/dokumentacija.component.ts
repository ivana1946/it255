import {Component, OnInit} from '@angular/core';
import {FormControl, FormGroup} from '@angular/forms';
import {Headers, Http} from '@angular/http';
import {Router} from '@angular/router';

@Component({
  selector: 'app-dokumentacija',
  templateUrl: './dokumentacija.component.html',
  styleUrls: ['./dokumentacija.component.css']
})
export class DokumentacijaComponent implements OnInit {

  kategorijaDokumentacija = ['Reklamacija', 'Zahtev'];

  public dokumentacijaForm = new FormGroup({
    vremeDatumUnosa: new FormControl(),
    imeDokumentacija: new FormControl(),
    kategorijaDokumentacija: new FormControl()
  });

  constructor(private _http: Http, private _router: Router) {
  }

  ngOnInit() {
  }

  dokumentacija() {
    const data =
      'imeDokumentacija=' + this.dokumentacijaForm.value.imeDokumentacija +
      '&kategorijaDokumentacija=' + this.dokumentacijaForm.value.kategorijaDokumentacija +
      '&vremeDatumUnosa=' + this.dokumentacijaForm.value.vremeDatumUnosa;

    const headers = new Headers();
    headers.append('Content-Type', 'application/x-www-form-urlencoded');
    headers.append('token', localStorage.getItem('token'));

    this._http.post('http://localhost/projects/dokumentacija.php', data, {headers: headers}).subscribe(
      (result) => {
        console.log('Result: \n' + result.toString());
        location.reload();
      },
      (error) => {
        console.log('Error; \n' + error.toString());
      });
  }

}
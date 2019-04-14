import {Component, OnInit} from '@angular/core';
import {FormControl, FormGroup} from '@angular/forms';
import {Headers, Http} from '@angular/http';
import {Router} from '@angular/router';

@Component({
  selector: 'app-ugovor',
  templateUrl: './ugovor.component.html',
  styleUrls: ['./ugovor.component.css']
})
export class UgovorComponent implements OnInit {

  public ugovorForm = new FormGroup({
    vremeDatumUnosa: new FormControl(),
    imePaketa: new FormControl()
  });

  constructor(private _http: Http, private reouter: Router) {
  }

  ngOnInit() {
  }

  public dugovor() {
    const data =
      'imePaketa=' + this.ugovorForm.value.imePaketa +
      '&vremeDatumUnosa=' + this.ugovorForm.value.vremeDatumUnosa;

    const headers = new Headers();
    headers.append('Content-Type', 'application/x-www-form-urlencoded');
    headers.append('token', localStorage.getItem('token'));

    this._http.post('http://localhost/projects/ugovor.php', data, {headers: headers}).subscribe(
      (result) => {
        console.log(result.toString());
        location.reload();
      },
      (error) => {
        console.log(error.toString());
      }
    );
  }
}
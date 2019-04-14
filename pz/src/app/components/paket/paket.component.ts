import {Component, OnInit} from '@angular/core';
import {Headers, Http} from '@angular/http';
import {Router} from '@angular/router';

@Component({
  selector: 'app-paket',
  templateUrl: './paket.component.html',
  styleUrls: ['./paket.component.css']
})
export class PaketComponent implements OnInit {
  [x: string]: any;

  dnevnik: any = [];

  constructor(private _http: Http, private router: Router) {
  }

  ngOnInit() {
    const headers = new Headers();
    headers.append('Content-Type', 'application/x-www-form-urlencoded');
    headers.append('token', localStorage.getItem('token'));

    this._http.get('http://localhost/projects/getPaket.php', {headers: headers}).subscribe(
      data => {
        this.paket = JSON.parse(data['_body']).zapisi;
      },
      error => {
        console.log('Error paket.component.ts: \n' + error.toString());
      }
    );
  }

  public obirsi_unos(id: number) {
    const headers = new Headers();
    headers.append('Content-Type', 'application/x-www-form-urlencoded');
    headers.append('token', localStorage.getItem('token'));

    const data = 'id=' + id;

    this._http.post('http://localhost/projects/obrisi_unos.php', data, {headers: headers}).subscribe(
      response => {
        console.log(response.toString());
        location.reload();
      },
      error => {
        console.log(error.toString());
      }
    );
  }

}

import { Component, OnInit } from '@angular/core';
import { HttpClient, HttpHeaders } from '@angular/common/http';

@Component({
  selector: 'mail-btn',
  templateUrl: './app-mailer.component.html',
  styleUrls: ['./app-mailer.component.css'],
})
export class AppMailerComponent implements OnInit {
  email!: string;
  name!: string;
  message!: string;
  endpoint!: string;

  http: HttpClient;

  constructor(http: HttpClient) {
    this.http = http;
  }

  ngOnInit() {
    //This data could really come from some inputs on the interface - but let's keep it simple.
    this.email = 'support@dotnet-services.fr';
    this.name = 'Dotnet Services';
    this.message = 'Hello, this is Oussama.';

    //Start php via the built in server: $ php -S localhost:8000
    this.endpoint = 'http://localhost:8000/sendEmail.php';
  }

  sendEmail() {
    let postVars = {
      email: this.email,
      name: this.name,
      message: this.message,
    };
    var headers;
    headers = new HttpHeaders();
    headers.append('Access-Control-Allow-Headers', 'Content-Type');
    headers.append('Access-Control-Allow-Methods', 'POST');
    headers.append('Access-Control-Allow-Origin', '*');
    //You may also want to check the response. But again, let's keep it simple.
    this.http
      .post(this.endpoint, JSON.stringify(postVars), {
        headers: headers,
        responseType: 'text',
      })
      .subscribe(
        (response) => console.log(response),
        (response) => console.log(response)
      );
  }
}

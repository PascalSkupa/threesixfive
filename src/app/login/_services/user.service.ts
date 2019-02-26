import { Injectable } from '@angular/core';
import {HttpClient, HttpHeaders} from '@angular/common/http';

import {User} from '../_models';
import {environment} from '../../../environments/environment';

@Injectable({ providedIn: 'root' })
export class UserService {
    constructor(private http: HttpClient) { }

    getAll() {
        return this.http.get<User[]>(`${environment.apiUrl}/users`);
    }

    getById(id: number) {
        return this.http.get(`${environment.apiUrl}/user/${id}`);
    }

    register(user: User) {
      const httpOptions = {
        headers: new HttpHeaders({
          'Accept-Create': 'Allowed'
        })
      };
      return this.http.post(`${environment.apiUrl}/user/register`, user, httpOptions);
    }

    update(user: User) {
        // return this.http.put(`${environment.apiUrl}/user/${user.id}`, user);
    }

    delete(id: number) {
        return this.http.delete(`${environment.apiUrl}/user/${id}`);
    }
}

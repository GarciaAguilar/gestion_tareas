import { Injectable } from '@angular/core';
import { HttpClient, HttpHeaders } from '@angular/common/http';
import { environment } from '../../environments/environment';
import { AuthService } from './auth.service';
import { Observable } from 'rxjs';

@Injectable({
  providedIn: 'root'
})
export class TaskService {
  private apiUrl = "http://localhost/gestion_tareas/backend/api";
  //private apiUrl = environment.API_EndPoint; //Para probar en modo local ocupando environment.ts

  constructor(private http: HttpClient, private authService: AuthService) {}

  createTask(data: any) {
    const headers = new HttpHeaders({
      Authorization: `Bearer ${this.authService.getToken()}`
    });
    return this.http.post(`${this.apiUrl}/task.php`, data, { headers });
  }

  getExecutors() {
    const headers = new HttpHeaders({
      Authorization: `Bearer ${this.authService.getToken()}`
    });
    return this.http.get(`${this.apiUrl}/users.php`, { headers });
  }

  getTasks() {
  const headers = new HttpHeaders({
      Authorization: `Bearer ${this.authService.getToken()}`
    });
  return this.http.get<any>(`${this.apiUrl}/task.php`, { headers });
}

}

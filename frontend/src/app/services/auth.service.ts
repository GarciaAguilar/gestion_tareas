import { Injectable } from '@angular/core';
import { HttpClient } from '@angular/common/http';
import { BehaviorSubject, Observable, tap } from 'rxjs';
import { Router } from '@angular/router';
import { environment } from '../../environments/environment';


@Injectable({
  providedIn: 'root'
})
export class AuthService {
  private apiUrl = "http://localhost/gestion_tareas/backend/api";
  //private apiUrl = environment.API_EndPoint; //Para probar en modo local ocupando environment.ts
  private isAuthenticated = new BehaviorSubject<boolean>(false);
  private userRole: number = 0;

  constructor(private http: HttpClient, private router: Router) { }

  register(data: any) {
    return this.http.post(`${this.apiUrl}/register.php`, data);
  }


  login(credentials: { email: string; password: string }): Observable<any> {
    return this.http.post<any>(`${this.apiUrl}/login.php`, credentials).pipe(
      tap(res => {
        if (res.data && res.data.token) {
          localStorage.setItem('token', res.data.token);
          localStorage.setItem('user', JSON.stringify(res.data.user));
          this.isAuthenticated.next(true);
          this.userRole = res.data.user.role;
        }
      })
    );
  }

  logout(): void {
    localStorage.removeItem('token');
    localStorage.removeItem('user');
    this.isAuthenticated.next(false);
    this.router.navigate(['/login']);
  }

  getToken(): string | null {
    return localStorage.getItem('token');
  }

  getUser(): any {
    const user = localStorage.getItem('user');
    return user ? JSON.parse(user) : null;
  }

  getRole(): number {
    return this.getUser()?.role || 0;
  }

  isLoggedIn(): boolean {
    return !!this.getToken();
  }

  authStatus(): Observable<boolean> {
    return this.isAuthenticated.asObservable();
  }
}

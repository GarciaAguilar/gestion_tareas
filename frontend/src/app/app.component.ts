import { Component } from '@angular/core';
import { AuthService } from './services/auth.service';
import { MenuController } from '@ionic/angular';

@Component({
  selector: 'app-root',
  templateUrl: 'app.component.html'
})
export class AppComponent {
  constructor(private authService: AuthService, private menuCtrl: MenuController) {}

  isAdmin(): boolean {
    return this.authService.getRole() === 1;
  }

  isExecutor(): boolean {
    return this.authService.getRole() === 2;
  }

 logout() {
  this.menuCtrl.close();  // 👈 cerrar el menú antes de salir
  this.authService.logout();
}
}

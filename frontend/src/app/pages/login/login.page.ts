import { Component } from '@angular/core';

import { Router } from '@angular/router';
import { ToastController } from '@ionic/angular';
import { AuthService } from '../../services/auth.service';
import { NgForm } from '@angular/forms';

@Component({
  selector: 'app-login',
  templateUrl: './login.page.html',
  styleUrls: ['./login.page.scss'],
})

export class LoginPage {
  email: string = '';
  password: string = '';

  constructor(
    private authService: AuthService,
    private router: Router,
    private toastController: ToastController
  ) { }

  onLogin() {
    this.authService.login({ email: this.email, password: this.password }).subscribe({
      next: () => {
        const role = this.authService.getRole();
        if (role === 1) {
          this.router.navigate(['/admin/task-list']);
        } else if (role === 2) {
          this.router.navigate(['/executor/task-list']);
        }
      },
      error: err => {
        if (err.status === 401) {
          this.presentToast('Correo o contraseña incorrectos', 'danger');
        } else {
          this.presentToast('Error al iniciar sesión', 'warning');
        }
      }
    });
  }

  async presentToast(message: string, color: string = 'danger') {
    const toast = await this.toastController.create({
      message,
      duration: 2000,
      position: 'top',
      color
    });
    toast.present();
  }

  ionViewWillEnter() {
    this.email = '';
    this.password = '';
  }


}

import { Component } from '@angular/core';
import { Router } from '@angular/router';
import { ToastController } from '@ionic/angular';
import { AuthService } from '../../services/auth.service';

@Component({
  selector: 'app-register',
  templateUrl: './register.page.html',
  styleUrls: ['./register.page.scss'],
})
export class RegisterPage {
  nombre = '';
  email = '';
  password = '';
  rol: number = 2;

  constructor(
    private authService: AuthService,
    private router: Router,
    private toastController: ToastController
  ) {}

  onRegister() {
    const data = {
      name: this.nombre,
      email: this.email,
      password: this.password,
      role: this.rol
    };

    this.authService.register(data).subscribe({
      next: () => {
        this.presentToast('Usuario registrado con éxito', 'success');
        this.router.navigate(['/login']);
      },
      error: err => {
        if (err.status === 400) {
          this.presentToast('El correo ya está registrado');
        } else {
          this.presentToast('Error al registrar el usuario');
        }
      }
    });
  }

  async presentToast(msg: string, color: string = 'danger') {
    const toast = await this.toastController.create({
      message: msg,
      duration: 2000,
      position: 'top',
      color
    });
    toast.present();
  }
}

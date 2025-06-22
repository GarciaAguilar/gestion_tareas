import { Component, OnInit } from '@angular/core';

import { ToastController } from '@ionic/angular';
import { TaskService } from '../../../services/task.service';

@Component({
  selector: 'app-create-task',
  templateUrl: './create-task.page.html',
  styleUrls: ['./create-task.page.scss'],
})
export class CreateTaskPage implements OnInit {
  titulo = '';
  descripcion = '';
  fecha = '';
  ejecutor = '';
  ejecutores: any[] = [];

  constructor(
    private taskService: TaskService,
    private toastController: ToastController
  ) {}

  ngOnInit() {
    this.taskService.getExecutors().subscribe({
      next: (res: any) => {
        this.ejecutores = res.data || [];
      },
      error: () => this.presentToast('Error al cargar ejecutores')
    });
  }

  crearTarea() {
    const data = {
      title: this.titulo,
      description: this.descripcion,
      due_date: this.fecha,
      assigned_to: this.ejecutor
    };

    this.taskService.createTask(data).subscribe({
      next: () => {
        this.presentToast('Tarea creada correctamente', 'success');
        this.titulo = '';
        this.descripcion = '';
        this.fecha = '';
        this.ejecutor = '';
      },
      error: () => this.presentToast('Error al crear la tarea')
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
}

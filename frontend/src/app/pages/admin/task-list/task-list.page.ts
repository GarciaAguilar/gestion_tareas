import { Component, OnInit } from '@angular/core';
import { TaskService } from '../../../services/task.service';
import { ToastController } from '@ionic/angular';

@Component({
  selector: 'app-task-list',
  templateUrl: './task-list.page.html',
  styleUrls: ['./task-list.page.scss'],
})
export class TaskListPage implements OnInit {
  tareas: any[] = [];

  constructor(
    private taskService: TaskService,
    private toastController: ToastController
  ) { }

  ngOnInit() {
    this.cargarTareas();
  }

  cargarTareas() {
    this.taskService.getTasks().subscribe({
      next: res => {
        this.tareas = res.data || [];
      },
      error: err => {
        this.presentToast('Error al cargar tareas');
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
}

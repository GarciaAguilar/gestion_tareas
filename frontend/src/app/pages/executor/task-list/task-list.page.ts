import { Component, OnInit } from '@angular/core';
import { ToastController } from '@ionic/angular';
import { TaskService } from '../../../services/task.service';

@Component({
  selector: 'app-executor-task-list',
  templateUrl: './task-list.page.html',
  styleUrls: ['./task-list.page.scss'],
})
export class TaskListPage implements OnInit {
  tareas: any[] = [];

  constructor(
    private taskService: TaskService,
    private toastController: ToastController
  ) {}

  ngOnInit() {
    this.cargarTareas();
  }

  cargarTareas() {
    this.taskService.getTasks().subscribe({
      next: res => {
        this.tareas = res.data || [];
      },
      error: () => this.mostrarToast('Error al cargar tus tareas')
    });
  }

  async mostrarToast(msg: string) {
    const toast = await this.toastController.create({
      message: msg,
      duration: 2000,
      position: 'top',
      color: 'danger'
    });
    toast.present();
  }
}

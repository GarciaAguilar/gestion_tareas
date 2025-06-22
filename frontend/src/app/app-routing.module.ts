import { NgModule } from '@angular/core';
import { PreloadAllModules, RouterModule, Routes } from '@angular/router';
import { AuthGuard } from './guards/auth.guard';
import { RoleGuard } from './guards/role.guard';

const routes: Routes = [
  {
    path: '',
    redirectTo: 'login',
    pathMatch: 'full'
  },
  {
    path: 'login',
    loadChildren: () => import('./pages/login/login.module').then(m => m.LoginPageModule)
  },
  {
    path: 'register',
    loadChildren: () => import('./pages/register/register.module').then(m => m.RegisterPageModule)
  },
  //Protegiendo las rutas de los usuarios 
  {
    path: 'admin/create-task',
    canActivate: [AuthGuard, RoleGuard],
    data: { expectedRole: 1 },
    loadChildren: () => import('./pages/admin/create-task/create-task.module').then(m => m.CreateTaskPageModule)
  },
  {
    path: 'admin/task-list',
    canActivate: [AuthGuard, RoleGuard],
    data: { expectedRole: 1 },
    loadChildren: () => import('./pages/admin/task-list/task-list.module').then(m => m.TaskListPageModule)
  },
  {
    path: 'executor/task-list',
    canActivate: [AuthGuard, RoleGuard],
    data: { expectedRole: 2 },
    loadChildren: () => import('./pages/executor/task-list/task-list.module').then(m => m.TaskListPageModule)
  }
];

@NgModule({
  imports: [
    RouterModule.forRoot(routes, { preloadingStrategy: PreloadAllModules })
  ],
  exports: [RouterModule]
})
export class AppRoutingModule { }

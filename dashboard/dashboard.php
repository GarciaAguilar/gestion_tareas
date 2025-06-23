<?php
require_once 'includes/auth.php';
require_once '../backend/config/Database.php';
require_once '../backend/models/Task.php';

$usuario = AuthMiddleware::verificarToken();

$db = (new Database())->connect();
$task = new Task($db);

// Obtener tareas según el rol
if ($usuario->role == 1) {
    $tareas = $task->getTasksAdmin($usuario->id);
} else {
    $tareas = $task->getTasksEjecutor($usuario->id);
}
?>

<?php include 'includes/header.php'; ?>

<div class="container mt-4">
    <h2 class="text-center mb-4">Mis Tareas</h2>

    <?php if (!empty($tareas)): ?>
        <?php foreach ($tareas as $t): ?>
            <div class="card mb-3 p-3">
                <h5><?php echo htmlspecialchars($t['title']); ?></h5>
                <p><?php echo htmlspecialchars($t['description']); ?></p>
                <small>Fecha límite: <?php echo htmlspecialchars($t['due_date']); ?></small>
            </div>
        <?php endforeach; ?>
    <?php else: ?>
        <div class="alert alert-info text-center">No tienes tareas asignadas.</div>
    <?php endif; ?>
</div>

<?php include 'includes/footer.php'; ?>

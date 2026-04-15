<?php include 'includes/header.php'; ?>

<div class="contenedor" style="max-width: 400px; margin-top: 50px;">
    <h1>Crear Cuenta</h1>
    
    <?php if(isset($_GET['msg'])): ?>
        <?php if($_GET['msg'] == 'error'): ?>
            <p style="color: red; background: #ffe6e6; padding: 10px;">Error al registrarse. Intenta con otro email.</p>
        <?php endif; ?>
    <?php endif; ?>

    <form action="actions/auth/register.php" method="POST">
        
        <div style="margin-bottom: 15px;">
            <label>Nombre Completo:</label>
            <input type="text" name="nombre" required placeholder="Tu nombre" style="width: 100%; padding: 8px;">
        </div>

        <div style="margin-bottom: 15px;">
            <label>Email:</label>
            <input type="email" name="email" required placeholder="ejemplo@correo.com" style="width: 100%; padding: 8px;">
        </div>
        
        <div style="margin-bottom: 15px;">
            <label>Contraseña:</label>
            <input type="password" name="password" required minlength="6" placeholder="Mínimo 6 caracteres" style="width: 100%; padding: 8px;">
        </div>
        
        <button type="submit" style="background: #007bff; color: #fff; padding: 10px 20px; border: none; width: 100%; cursor: pointer;">
            Registrarme
        </button>

        <p style="margin-top: 15px; text-align: center;">
            ¿Ya tienes cuenta? <a href="login.php" style="color: blue;">Inicia Sesión aquí</a>
        </p>

    </form>
</div>

<?php include 'includes/footer.php'; ?>
<?php include 'includes/header.php'; ?>

<div>
    <h1>Inciar Sesion</h1>

    <?php if (isset($_GET['msg'])): ?>
        <p style="color: red;">Email o contraseña incorrectos</p>
    <?php endif; ?>

    <form action="actions/auth/login.php" method="POST">
        <div>
            <label>Email: </label>
            <input type="email" name="email" require_onced>
        </div>
        <div>
            <label>Contraseña: </label>
            <input type="password" name="password" require_onced>
        </div>

        <button type="submit">
            Ingresar
        </button>
    </form>

    <a href="register.php">No tienes una cuenta?</a>
</div>


<?php
include 'includes/footer.php';
?>
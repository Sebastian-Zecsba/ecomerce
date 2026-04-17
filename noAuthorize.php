<?php 
    http_response_code(403); 
    
    include 'includes/header.php'; 
?>

<div class="contenedor" style="text-align: center; margin-top: 100px; margin-bottom: 100px;">
    
    <div style="font-size: 5rem; margin-bottom: 20px;">🚫🐒</div>
    
    <h1 style="color: #dc3545; font-size: 2.5rem;">Acceso Denegado</h1>
    
    <p style="font-size: 1.2rem; color: #555;">
        Hola <b><?= $_SESSION['user_nombre'] ?? 'Usuario' ?></b>, <br> 
        No tienes los permisos de Administrador necesarios para entrar a esta zona.
    </p>
    
    <p style="margin-bottom: 30px; color: #888;">
        (Deja de estar curioseando las URLs o le diremos a tu mamá).
    </p>

    <a href="index.php" style="background-color: #333; color: white; padding: 12px 25px; text-decoration: none; border-radius: 5px; font-weight: bold;">
        Volver a la Tienda
    </a>
    
</div>

<?php include 'includes/footer.php'; ?>
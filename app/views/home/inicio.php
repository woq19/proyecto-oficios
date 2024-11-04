<!DOCTYPE html>
<html lang="es">
<head>
	<?=$head?>
	<title><?=$title?></title>
</head>
<body>
    <header>
        <div class="logo">Logo</div>
        <nav>
            <ul>
                <li><a href="#">Inicio</a></li>
                <li><a href="#">Anúnciate</a></li>
                <li><a href="#">Quiénes Somos</a></li>
            </ul>
        </nav>
        <div class="login">
            <form>
                <label for="usuario">Usuario</label>
                <input type="text" id="usuario" name="usuario">
                <label for="contrasena">Contraseña</label>
                <input type="password" id="contrasena" name="contrasena">
                <a href="#">¿Olvidó su contraseña?</a>
                <button type="submit">Ingresar</button>
            </form>
        </div>
        <div class="hamburger-menu">
            <button id="hamburger-btn">☰</button>
        </div>
    </header>
    <main>
        <div class="search-bar">
            <input type="text" placeholder="¿Qué oficio buscas?">
            <button><img src="lupa.png" alt="Buscar"></button>
        </div>
    </main>
    <footer>
        <div class="social-media">
            <a href="#"><img src="instagram.png" alt="Instagram"></a>
            <a href="#"><img src="x.png" alt="X"></a>
            <a href="#"><img src="facebook.png" alt="Facebook"></a>
        </div>
    </footer>
    <a href="#" class="whatsapp"><img src="whatsapp.png" alt="WhatsApp"></a>
    <script src="scripts.js"></script>
</body>
</html>
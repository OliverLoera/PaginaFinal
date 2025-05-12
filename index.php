<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Felcor Transportes</title>
    <link rel="stylesheet" href="style.css">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@500&family=Open+Sans&family=Poppins:wght@600&display=swap" rel="stylesheet">

</head>
<body>

    <header>
        <div class="logo">
        <img src="imagenes/Logo.jpg" alt="Felcor">
        </div>
        <nav>
            <ul>
                <li><a href="index.php">Inicio</a></li>
                <li><a href="destinos.html">Destinos</a></li>
                <li><a href="frontend.html">Vehículos</a></li>
                <li><a href="contacto.php">Contacto</a></li>
                <li><a href="login.php">Login</a></li>
            </ul>
        </nav>
    </header>

    <section class="hero">
    <div class="carousel-container">
        <button class="carousel-btn prev">&#10094;</button>
        <div class="carousel">
            <a href="frontend.html"><img src="imagenes/suburban.png" alt="Slide 1" class="active"></a>
            <a href="destinos.html"><img src="imagenes/Tijuana.jpg" alt="Slide 2"></a>
            <a href="frontend.html"><img src="imagenes/camion.jpg" alt="Slide 3"></a>
            <a href="destinos.html"><img src="imagenes/Playa.jpg" alt="Slide 4"></a>
        </div>
        <button class="carousel-btn next">&#10095;</button>
    </div>
    </section>


    <section class="bienvenida">
        <h1>Bienvenido a Felcor Transportes</h1>
        <p>Somos tu mejor opción para viajar cómodo, seguro y a tiempo. Explora nuestros destinos y elige el vehículo ideal para tu viaje.</p>
    </section>

    <section class="preview">
    <h2>Nuestros vehículos</h2>
    <div class="vehiculos">
        <a href="frontend.html" class="vehiculo-card">
            <img src="imagenes/Van.png" alt="Van 1">
            <h3>Van ejecutiva</h3>
            <p>Ideal para grupos pequeños. Comodidad y eficiencia.</p>
        </a>
        <a href="frontend.html" class="vehiculo-card">
            <img src="imagenes/Autobus.png" alt="Bus 1">
            <h3>Autobús turístico</h3>
            <p>Perfecto para excursiones largas. Totalmente equipado.</p>
        </a>
        <a href="frontend.html" class="vehiculo-card">
            <img src="imagenes/SedanVento2020.jpg" alt="Sedan 1">
            <h3>Sedan Vento</h3>
            <p>Perfecto para traslados sencillos de una hasta 4 personas.</p>
        </a>
        <a href="frontend.html" class="vehiculo-card">
            <img src="imagenes/Sprinter2023.jpg" alt="Sprinter 1">
            <h3>Sprinter</h3>
            <p>Lleva de viaje un grupo grande de personas.</p>
        </a>
    </div>
    </section>

    <section class="preview">
    <h2>Destinos recurrentes</h2>
    <div class="vehiculos">
        <a href="destinos.html" class="vehiculo-card">
            <img src="imagenes/Juarez.jpg" alt="Van 1">
            <h3>Ciudad Juarez</h3>
            <p>Ciudad fronteriza vibrante, conocida por su dinamismo industrial y su cultura fronteriza única.</p>
        </a>
        <a href="destinos.html" class="vehiculo-card">
            <img src="imagenes/Chihuahua.jpg" alt="Bus 1">
            <h3>Chihuahua</h3>
            <p>Capital del estado, combina historia, modernidad e industria.</p>
        </a>
        <a href="destinos.html" class="vehiculo-card">
            <img src="imagenes/Tijuana.jpg" alt="Sedan 1">
            <h3>Tijuana</h3>
            <p>Cultural, urbana y vibrante ciudad fronteriza.</p>
        </a>
        <a href="destinos.html" class="vehiculo-card">
            <img src="imagenes/Mexicali.jpg" alt="Sprinter 1">
            <h3>Mexicali</h3>
            <p>Fronteriza, moderna y con economía diversa.</p>
        </a>
    </div>
    </section>


    <footer>
        <p>&copy; 2025 Felcor Transportes. Todos los derechos reservados.</p>
        <p><a href="#">Política de privacidad</a> | <a href="#">Términos y condiciones</a></p>
    </footer>

    <script>
    const slides = document.querySelectorAll(".carousel img");
    const prevBtn = document.querySelector(".carousel-btn.prev");
    const nextBtn = document.querySelector(".carousel-btn.next");
    let current = 0;

    function showSlide(index) {
        slides[current].classList.remove("active");
        current = (index + slides.length) % slides.length;
        slides[current].classList.add("active");
    }

    prevBtn.addEventListener("click", () => showSlide(current - 1));
    nextBtn.addEventListener("click", () => showSlide(current + 1));
    </script>


</body>
</html>

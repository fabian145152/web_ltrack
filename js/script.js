// Interacciones simples: menú, año dinámico y manejo de formulario (front-end)
document.addEventListener('DOMContentLoaded', function () {
    // año en footer
    document.getElementById('year').textContent = new Date().getFullYear();


    // toggle móvil
    var nav = document.getElementById('mainNav');
    var btn = document.getElementById('navToggle');
    btn.addEventListener('click', function () {
        if (nav.style.display === 'flex') nav.style.display = '';
        else nav.style.display = 'flex';
        nav.style.flexDirection = 'column';
    });


    // reset form
    document.getElementById('resetBtn').addEventListener('click', function () {
        document.getElementById('contactForm').reset();
    });


    // submit front-end
    document.getElementById('contactForm').addEventListener('submit', function (e) {
        e.preventDefault();
        var data = {
            name: this.name.value,
            email: this.email.value,
            message: this.message.value
        };
        // por ahora solo mostramos en consola y un alert amigable
        console.log('Contacto enviado (front-end):', data);
        alert('Gracias, tu mensaje fue preparado para envío. Puedo añadir el backend para que llegue al email.');
        this.reset();
    });
});
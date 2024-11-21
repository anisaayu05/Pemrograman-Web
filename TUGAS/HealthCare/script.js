document.addEventListener('DOMContentLoaded', function() {
    // Menangani klik pada tautan navigasi untuk scroll halus
    const navLinks = document.querySelectorAll('nav ul li a');
    navLinks.forEach(link => {
        link.addEventListener('click', function(e) {
            e.preventDefault();
            const target = document.querySelector(link.getAttribute('href'));
            window.scrollTo({
                top: target.offsetTop,
                behavior: 'smooth'
            });
        });
    });

    // Menangani scroll untuk menambahkan/menghapus kelas 'scrolled' pada header
    window.addEventListener('scroll', function() {
        if (window.scrollY > 50) {
            document.querySelector('header').classList.add('scrolled');
        } else {
            document.querySelector('header').classList.remove('scrolled');
        }

        revealCardsOnScroll();
        revealServicesOnScroll();
        revealPriorityOnScroll();
        revealDoctorsOnScroll();
    });

    // Menangani klik pada ikon hamburger untuk membuka/tutup menu navigasi
    const hamburger = document.querySelector('.hamburger');
    hamburger.addEventListener('click', function() {
        hamburger.classList.toggle('active');
        document.querySelector('nav ul').classList.toggle('active');
    });

    // Menjalankan fungsi reveal untuk elemen yang berada di dalam viewport
    revealCardsOnScroll();
    revealServicesOnScroll();
    revealPriorityOnScroll();
    revealDoctorsOnScroll();
});

function isElementInViewport(el) {
    const rect = el.getBoundingClientRect();
    return (
        rect.top >= 0 &&
        rect.left >= 0 &&
        rect.bottom <= (window.innerHeight || document.documentElement.clientHeight) &&
        rect.right <= (window.innerWidth || document.documentElement.clientWidth)
    );
}

function revealPriorityOnScroll() {
    const priorityItems = document.querySelectorAll('.priority-item');
    priorityItems.forEach((item, index) => {
        if (isElementInViewport(item)) {
            setTimeout(() => {
                item.classList.add('visible');
            }, index * 100);
        }
    });
}

function revealServicesOnScroll() {
    const serviceItems = document.querySelectorAll('.service');
    serviceItems.forEach(item => {
        if (isElementInViewport(item)) {
            item.classList.add('visible');
        }
    });
}

function revealCardsOnScroll() {
    const cards = document.querySelectorAll('.facility-card');
    cards.forEach(card => {
        if (isElementInViewport(card)) {
            card.classList.add('visible');
        }
    });
}

function revealDoctorsOnScroll() {
    const doctorCards = document.querySelectorAll('.doctor-card');
    doctorCards.forEach((card, index) => {
        if (isElementInViewport(card)) {
            setTimeout(() => {
                card.classList.add('visible');
            }, index * 200);
        }
    });
}


// Fungsi untuk mengambil data dari API dan menampilkan di frontend
async function loadServices() {
    try {
        const response = await fetch('http://localhost:8000/api/services');
        if (!response.ok) {
            throw new Error('Failed to fetch services');
        }

        const services = await response.json();
        console.log("Data Services:", services); // Log data untuk melihat apa yang diterima

        renderServices(services);
    } catch (error) {
        console.error('Error loading services:', error);
    }
}

function renderServices(response) {
    const services = response.data; // Mengakses data dari properti 'data'
    const servicesGrid = document.querySelector('.services-grid');
    servicesGrid.innerHTML = '';

    services.forEach(service => {
        const serviceElement = `
            <div class="service">
                <div class="icon-container">
                    <img src="img/obat1.png" alt="${service.name} Icon">
                </div>
                <h3>${service.name}</h3>
                <p>${service.description}</p>
            </div>
        `;
        servicesGrid.innerHTML += serviceElement;
    });
}


// Panggil fungsi saat halaman dimuat
document.addEventListener('DOMContentLoaded', loadServices);

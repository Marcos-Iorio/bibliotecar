const imagenLibro = document.querySelectorAll('div.imagen-libro img');
/* const cardLibros = document.querySelectorAll('div#libro-prueba'); */

const lazyload = target => {
    const io = new IntersectionObserver((entries, observer) => { 
        entries.forEach(entry =>{
            if(entry.isIntersecting){
                const libro = entry.target;
                const src = libro.getAttribute('data-lazy');
                libro.setAttribute('src', src);
                libro.classList.add('fade');

                observer.disconnect();
            }
        });
    });
    io.observe(target);
};

imagenLibro.forEach(lazyload);

const lazyLibros = target => {
    const io = new IntersectionObserver((entries, observer) => { 
        entries.forEach(entry =>{
            if(entry.isIntersecting){
                console.log("adadsada");
                const libros = entry.target;
                libros.classList.add('fade');

                observer.disconnect();
            }
        });
    });
    io.observe(target);
};

cardLibros.forEach(lazyLibros);
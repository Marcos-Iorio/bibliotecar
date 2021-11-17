const imagenLibro = document.querySelectorAll('div.imagen-libro img');
/* const cardLibros = document.querySelectorAll('div#libro-prueba'); */

const observerOptions = {
    root: null,
    rootMargin: "0px",
    threshold: 0.7
  };

const lazyload = target => {
    const io = new IntersectionObserver((entries, observer) => { 
        entries.forEach(entry =>{
            const libro = entry.target;
            if(entry.isIntersecting){
                const src = libro.getAttribute('data-lazy');
                libro.setAttribute('src', src);
                libro.classList.add('fade')
                libro.classList.replace('fade-out', 'fade');
            }else{
                libro.classList.replace('fade', 'fade-out')
            }
        });
    });
    io.observe(target);
};

imagenLibro.forEach(lazyload);

/* const lazyLibros = target => {
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

cardLibros.forEach(lazyLibros); */
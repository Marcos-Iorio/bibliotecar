const targets = document.querySelectorAll('div.imagen-libro img');
/* const targets = document.querySelectorAll('div#libro-prueba'); */

const lazyload = target => {
    const io = new IntersectionObserver((entries, observer) => { 
        entries.forEach(entry =>{
            if(entry.isIntersecting){
                console.log("dasda");
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

targets.forEach(lazyload);
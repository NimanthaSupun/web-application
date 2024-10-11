const bar = document.getElementById('bar');
const close = document.getElementById('close');
const nav = document.getElementById('navbar');

if (bar){
    bar.addEventListener('click', () =>{
        nav.classList.add('active');
    })
}

if (close){
    close.addEventListener('click', (event) =>{
        event.preventDefault(); // This prevents the default behavior (scrolling to the top)
        nav.classList.remove('active');
    })
}

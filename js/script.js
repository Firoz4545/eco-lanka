let menu = document.querySelector('#menu-btn');
let navbar = document.querySelector('.navigation');

menu.onclick = () =>{
    menu.classList.toggle('fa-times');
    navbar.classList.toggle('active');
}
function searchPosts() {
    const searchTerm = document.getElementById('search').value.toLowerCase();
    const posts = document.querySelectorAll('.post');
    posts.forEach(post => {
        const title = post.querySelector('h3').innerText.toLowerCase();
        const content = post.querySelector('p').innerText.toLowerCase();
        if (title.includes(searchTerm) || content.includes(searchTerm)) {
            post.style.display = '';
        } else {
            post.style.display = 'none';
        }
    });
}

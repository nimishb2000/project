const category = localStorage.getItem('category');

function cookie() {
    let cookies = document.cookie.split(';');
    let cookie;
    cookies.forEach(x => {
        if (x.split('=')[0] == 'isloggedin') {
            cookie = x;
        }
    });
    const value = cookie.split('=')[1];
    if (value == 'true') {
        const loginDiv = document.getElementById('login');
        const logoutDiv = document.getElementById('logout');
        loginDiv.style.display = 'none';
        logoutDiv.style.display = 'inline-block';
    }
    if (value == 'false') {
        const loginDiv = document.getElementById('login');
        const logoutDiv = document.getElementById('logout');
        logoutDiv.style.display = 'none';
        loginDiv.style.display = 'inline-block';
    }
}

window.onload = function () {
    cookie();
    let cat;
    if (category == 'W') {
        document.title = 'WOMEN | Galipahinana';
        cat = 'WOMEN';
        const li = document.getElementById('women');
        li.className = 'active';
    }

    if (category == 'M') {
        document.title = 'MEN | Galipahinana';
        cat = 'MEN';
        const li = document.getElementById('men');
        li.className = 'active';
    }

    if (category == 'A') {
        document.title = 'ACCESSORIES | Galipahinana';
        cat = 'ACCESSORIES';
        const li = document.getElementById('acc');
        li.className = 'active';
    }

    const wrapper = document.getElementById('content-wrapper');

    const headingContainer = document.createElement('div');
    const heading = document.createElement('h1');
    headingContainer.className = 'heading-container';
    heading.innerHTML = cat;
    headingContainer.appendChild(heading);
    wrapper.appendChild(headingContainer);

    const titleArr = JSON.parse(localStorage.getItem('title'));
    const imageArr = JSON.parse(localStorage.getItem('image'));
    const priceArr = JSON.parse(localStorage.getItem('price'));

    const container = document.createElement('div');
    container.className = 'card-wrapper';
    wrapper.appendChild(container);

    for (let i = 0; i < titleArr.length; i++) {
        const title = titleArr[i];
        const image = imageArr[i];
        const price = priceArr[i];
        const div = document.createElement('div');
        div.className = 'card-container';
        div.onclick = () => { window.location.href = `products/${title}.html` };
        const img = document.createElement('img');
        img.src = `../assets/${image}`;
        div.appendChild(img);
        let p = document.createElement('p');
        p.appendChild(document.createTextNode(`${title}`));
        div.appendChild(p);
        p = document.createElement('p');
        p.appendChild(document.createTextNode(`₹${price}`));
        div.appendChild(p);
        container.appendChild(div);
    }
}

window.onunload = function () {
    localStorage.clear();
}
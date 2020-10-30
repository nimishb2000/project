function homeRedirect() {
    window.location.href = '../html/home.html';
}

function womenClick() {
    window.location.href = '../php/women.php';
}

function menClick() {
    window.location.href = '../php/men.php';
}

function accClick() {
    window.location.href = '../php/acc.php';
}

function aboutClick() {
    window.location.href = '../html/about.html';
}

function cartClick() {
    let cookies = document.cookie.split(';');
    let cookie;
    cookies.forEach(x => {
        if (x.split('=')[0] == 'isloggedin') {
            cookie = x;
        }
    });
    const value = cookie.split('=')[1];
    if(value == 'false'){
        alert('Log in to access the cart');
        window.location.href = '../html/login.html';
        return;
    }
    window.location.href = '../php/cart_open.php';
}

function loginClick() {
    window.location.href = '../html/login.html';
}

function logoutClick() {
    alert('Logged out successfully');
    window.location.href = '../php/logout.php';
}
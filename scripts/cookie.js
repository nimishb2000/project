window.onload = function () {
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
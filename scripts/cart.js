const productArr = JSON.parse(localStorage.getItem('product'));
const quantityArr = JSON.parse(localStorage.getItem('quantity'));
const costArr = JSON.parse(localStorage.getItem('cost'));
const imageNameArr = JSON.parse(localStorage.getItem('imageName'));

window.onload = function () {
    if (productArr.length == 0) {
        emptyCart();
    }
    else {
        fillCart();
    }
}

function emptyCart() {
    const wrapper = document.getElementById('cart-wrapper');
    wrapper.style.textAlign = 'center';
    wrapper.style.padding = '20vh 0';
    const container = document.getElementById('cart-container');

    const h1 = document.createElement('h1');
    const textNode = document.createTextNode('Cart is empty');
    h1.appendChild(textNode);
    h1.style.fontSize = '3em';
    h1.style.marginBottom = '1.5%';
    container.appendChild(h1);

    const button = document.createElement('button');
    button.innerHTML = 'Continue Shopping';
    button.className = 'continue';
    button.onclick = function () { window.location.href = 'home.html' };
    container.appendChild(button);
};

function fillCart() {
    const wrapper = document.getElementById('cart-wrapper');
    const container = document.getElementById('cart-container');
    const total = localStorage.getItem('total');
    for (let i = 0; i < productArr.length; i++) {
        const div = document.createElement('div');

        const title = productArr[i];
        const quantity = quantityArr[i];
        const cost = costArr[i];
        const imageName = imageNameArr[i];
        const net = cost * quantity;

        div.className = 'cart-card';
        container.appendChild(div);

        const table = document.createElement('table');
        table.style.width = '100%';
        let row = table.insertRow();

        let cell = row.insertCell();
        cell.rowSpan = 2;
        cell.width = '25%';
        const img = document.createElement('img');
        img.src = `../assets/${imageName}`;
        img.className = 'prodImg';
        cell.appendChild(img);

        cell = row.insertCell();
        cell.width = '50%';
        const h1 = document.createElement('h1');
        h1.appendChild(document.createTextNode(`${title}`));
        cell.appendChild(h1);

        cell = row.insertCell();
        cell.vAlign = 'middle';
        cell.align = 'center';
        cell.rowSpan = 2;
        let p = document.createElement('p');
        p.appendChild(document.createTextNode(`Total: ₹${net}`));
        cell.appendChild(p);

        row = table.insertRow();
        cell = row.insertCell();
        cell.width = '25%';
        p = document.createElement('p');
        p.appendChild(document.createTextNode(`Quantity: ${quantity}`));
        cell.appendChild(p);

        div.appendChild(table);
    }
    const div = document.createElement('div');
    div.className = 'total-container';
    const p = document.createElement('p');
    p.appendChild(document.createTextNode(`Order Total: ₹${total}`));
    const button = document.createElement('button');
    button.appendChild(document.createTextNode('Place Order'));
    button.className = 'btn';
    button.onclick = () => window.location.href = '../php/place_order.php';
    div.appendChild(p);
    div.appendChild(button);
    wrapper.appendChild(div);
}

window.onunload = function () {
    // localStorage.clear();
}
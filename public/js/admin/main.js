// Themes
const switch_button = document.querySelector('#switch');
const nav_bar = document.querySelector('#top_nav');
const nav_links = document.querySelectorAll('.nav .nav-link');
const body = document.querySelector('#body');
const tab_panes = document.querySelectorAll('.tab-pane');
const tables = document.querySelectorAll('.table');
const next = document.getElementById('nextP');
const prev = document.getElementById('prevP');

function darkTheme() {
    nav_bar.classList.remove('bg-primary');
    nav_bar.classList.add('bg-dark');
    for (const navLinksKey in nav_links) {
        if (typeof nav_links[navLinksKey] === 'object')
            nav_links[navLinksKey].classList.add('nav-link-dark');
    }
    for (const tabPanesKey in tab_panes) {
        if (typeof tab_panes[tabPanesKey] === 'object')
            tab_panes[tabPanesKey].classList.add('text-light');
    }
    for (const tablesKey in tables) {
        if (typeof tables[tablesKey] === 'object'){
            tables[tablesKey].classList.add('table-dark');
            tables[tablesKey].classList.remove('table-info');
        }
    }
    body.classList.add('dark-bg');
    next.classList.add('dark-bg');
    prev.classList.add('dark-bg');
}

function lightTheme() {
    nav_bar.classList.remove('bg-dark');
    nav_bar.classList.add('bg-primary');
    for (const navLinksKey in nav_links) {
        if (typeof nav_links[navLinksKey] === 'object')
            nav_links[navLinksKey].classList.remove('nav-link-dark');
    }
    for (const tabPanesKey in tab_panes) {
        if (typeof tab_panes[tabPanesKey] === 'object')
            tab_panes[tabPanesKey].classList.remove('text-light');
    }
    for (const tablesKey in tables) {
        if (typeof tables[tablesKey] === 'object'){
            tables[tablesKey].classList.add('table-info');
            tables[tablesKey].classList.remove('table-dark');
        }
    }
    body.classList.remove('dark-bg');
    next.classList.remove('dark-bg');
    prev.classList.remove('dark-bg');
}

// Switch Button Change Theme
switch_button.onclick = function () {
    if (this.checked) { // Dark Theme
        darkTheme();
        document.cookie = 'theme=dark';
    } else { // Light Theme
        lightTheme();
        document.cookie = 'theme=';
    }
};

// Cookie

function getCookie(cname) {
    let name = cname + "=";
    let decodedCookie = decodeURIComponent(document.cookie);
    let ca = decodedCookie.split(';');
    for(let i = 0; i < ca.length; i++) {
        let c = ca[i];
        while (c.charAt(0) == ' ') {
            c = c.substring(1);
        }
        if (c.indexOf(name) == 0) {
            return c.substring(name.length, c.length);
        }
    }
    return "";
}

// Next & Prev PAges...
function getUrlParameter(sParam) {
    var sPageURL = window.location.search.substring(1),
        sURLVariables = sPageURL.split('&'),
        sParameterName,
        i;

    for (i = 0; i < sURLVariables.length; i++) {
        sParameterName = sURLVariables[i].split('=');

        if (sParameterName[0] === sParam) {
            return typeof sParameterName[1] === undefined ? true : decodeURIComponent(sParameterName[1]);
        }
    }
    return false;
}

// After Load Change Theme & Prev AND Next Page fix
const urlParam = getUrlParameter('ft');

$(document).ready(function () {
    //Theme
    if (getCookie('theme') === 'dark') {
        if (!switch_button.checked)
            switch_button.click();
            else
                darkTheme();
    }
    //Next&Prev
    if (urlParam){
        next.href = '?ft=' + (parseInt(urlParam) + 50);
        if (parseInt(urlParam) >= 50)
        prev.href = '?ft=' + (parseInt(urlParam) - 50);
    }
});



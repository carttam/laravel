// Themes

const switch_button = document.querySelector('#switch');
const nav_bar = document.querySelector('#top_nav');
const nav_links = document.querySelectorAll('.nav .nav-link');
const body = document.querySelector('#body');
const tab_panes = document.querySelectorAll('.tab-pane');

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
    body.classList.add('dark-bg')
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
    body.classList.remove('dark-bg')
}

// Switch Button Change Theme
switch_button.onclick = function () {
    if (this.checked) { // Dark Theme
        darkTheme();
    } else { // Light Theme
        lightTheme();
    }
};

// After Load Change Theme
$(document).ready(function () {
    if (switch_button.checked) { // Dark Theme
        darkTheme();
    } else { // Light Theme
        lightTheme();
    }
});

window.addEventListener('DOMContentLoaded', () => {
    var sidebar = document.querySelector('#sidebar');
    var content = document.querySelector('#content');
    var btnTogglerSidebar = document.querySelector('#btn-toggler-sidebar'); 

    btnTogglerSidebar.addEventListener('click', (event) => {
        if (btnTogglerSidebar.dataset.open == 'true') {
            sidebar.style = 'left: -300px;';
            content.style = 'margin-left: 0';
            btnTogglerSidebar.dataset.open = 'false';
        } else {
            sidebar.style = 'left: 0;';
            content.style = 'margin-left: 300px';
            btnTogglerSidebar.dataset.open = 'true';
        }
    }, false);

    if (window.innerWidth < 800) {
        sidebar.style = 'left: -300px;';
        content.style = 'margin-left: 0';
        btnTogglerSidebar.dataset.open = 'false';
    }
});
let sidebarMenu = document.getElementById('sidebar-menu');

sidebarMenu.addEventListener('mouseenter', () => {
    sidebarMenu.style.overflow = 'auto';
}, false)

sidebarMenu.addEventListener('mouseleave', () => {
    sidebarMenu.style.overflow = 'hidden';
}, false)
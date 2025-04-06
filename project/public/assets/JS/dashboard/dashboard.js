
document.addEventListener('DOMContentLoaded', function() {
 
    const sidebarToggleBtn = document.getElementById('sidebarToggleBtn');
    const sidebarToggleTop = document.getElementById('sidebarToggleTop');
    const sidebar = document.getElementById('sidebar');
    const themeToggle = document.getElementById('theme-toggle');

   
    function toggleSidebar() {
        sidebar.classList.toggle('show');

     
        if (sidebar.classList.contains('show')) {
            document.body.style.overflow = 'hidden';
        } else {
            document.body.style.overflow = '';
        }
    }

  
    if (sidebarToggleBtn) {
        sidebarToggleBtn.addEventListener('click', toggleSidebar);
    }

    if (sidebarToggleTop) {
        sidebarToggleTop.addEventListener('click', toggleSidebar);
    }


    function setTheme(theme) {
        document.body.setAttribute('data-bs-theme', theme);
        localStorage.setItem('theme', theme);

       
        if (themeToggle) {
            const darkIcon = themeToggle.querySelector('.dark-icon');
            const lightIcon = themeToggle.querySelector('.light-icon');

            if (theme === 'dark') {
                darkIcon.style.display = 'none';
                lightIcon.style.display = 'inline-block';
            } else {
                darkIcon.style.display = 'inline-block';
                lightIcon.style.display = 'none';
            }
        }
    }

  
    function initTheme() {
        const savedTheme = localStorage.getItem('theme');
        const prefersDark = window.matchMedia('(prefers-color-scheme: dark)').matches;

        if (savedTheme) {
            setTheme(savedTheme);
        } else if (prefersDark) {
            setTheme('dark');
        } else {
            setTheme('light');
        }
    }

    initTheme();


    if (themeToggle) {
        themeToggle.addEventListener('click', () => {
            const currentTheme = document.body.getAttribute('data-bs-theme');
            const newTheme = currentTheme === 'dark' ? 'light' : 'dark';
            setTheme(newTheme);
        });
    }


    const alerts = document.querySelectorAll('.alert:not(.alert-permanent)');
    alerts.forEach(alert => {
        setTimeout(() => {
            alert.style.transition = 'opacity 0.5s ease';
            alert.style.opacity = '0';
            setTimeout(() => {
                alert.remove();
            }, 500);
        }, 5000);
    });

 
    const dropdownLinks = document.querySelectorAll('.sidebar .nav-link[data-bs-toggle="collapse"]');

    dropdownLinks.forEach(link => {
        link.addEventListener('click', function(e) {
            e.preventDefault();
            const targetId = this.getAttribute('data-bs-target');
            const targetCollapse = document.querySelector(targetId);
            const isExpanded = targetCollapse.classList.contains('show');

            document.querySelectorAll('.sidebar .collapse.show').forEach(openCollapse => {
                if (openCollapse.id !== targetCollapse.id) {
                    const associatedToggle = document.querySelector(`[data-bs-target="#${openCollapse.id}"]`);
                    if (associatedToggle) {
                        associatedToggle.setAttribute('aria-expanded', 'false');
                        associatedToggle.classList.add('collapsed');
                        const indicator = associatedToggle.querySelector('.submenu-indicator');
                        if (indicator) {
                            indicator.style.transform = '';
                        }
                    }
                    openCollapse.classList.remove('show');
                }
            });

            if (!isExpanded) {
                targetCollapse.classList.add('show');
                this.setAttribute('aria-expanded', 'true');
                this.classList.remove('collapsed');
                const indicator = this.querySelector('.submenu-indicator');
                if (indicator) {
                    indicator.style.transform = 'rotate(180deg)';
                }
            } else {
                targetCollapse.classList.remove('show');
                this.setAttribute('aria-expanded', 'false');
                this.classList.add('collapsed');
                const indicator = this.querySelector('.submenu-indicator');
                if (indicator) {
                    indicator.style.transform = '';
                }
            }
        });
    });

   
    document.addEventListener('click', function(e) {
        if (!e.target.closest('.submenu') && 
            !e.target.closest('.nav-link[data-bs-toggle="collapse"]')) {

            document.querySelectorAll('.sidebar .collapse.show').forEach(collapse => {
                collapse.classList.remove('show');
                const trigger = document.querySelector(`[data-bs-target="#${collapse.id}"]`);
                if (trigger) {
                    trigger.setAttribute('aria-expanded', 'false');
                    trigger.classList.add('collapsed');
                    const indicator = trigger.querySelector('.submenu-indicator');
                    if (indicator) {
                        indicator.style.transform = '';
                    }
                }
            });
        }

        if (window.innerWidth < 768 && 
            e.target.closest('.sidebar .nav-link:not([data-bs-toggle="collapse"])')) {
            if (sidebar && sidebar.classList.contains('show')) {
                toggleSidebar();
            }
        }
    });


    function handleResize() {
        if (window.innerWidth >= 992) {
            sidebar.classList.remove('show');
            document.body.style.overflow = '';
        }
    }

    window.addEventListener('resize', handleResize);
});

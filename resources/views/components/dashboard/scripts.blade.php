<script>
    (function(){
        const root = document.getElementById('dashboardRoot');
        const sidebarBtn = document.getElementById('sidebarToggle');
        const mobileBtn = document.getElementById('mobileSidebarBtn');
        const backdrop = document.getElementById('sidebarBackdrop');
        const profileMenuTrigger = document.getElementById('profileMenuTrigger');
        const profileMenuPanel = document.getElementById('profileMenuPanel');
        const sidebarAccountTrigger = document.getElementById('sidebarAccountTrigger');
        const sidebarAccountPanel = document.getElementById('sidebarAccountPanel');

        function isMobile(){
            return window.matchMedia('(max-width: 860px)').matches;
        }

        function setBodyLock(){
            document.body.classList.toggle('no-scroll', isMobile() && root.classList.contains('mobile-sidebar-open'));
        }

        function closeMobileSidebar(){
            root.classList.remove('mobile-sidebar-open');
            setBodyLock();
        }

        function closeAccountMenus(){
            if(profileMenuPanel && profileMenuTrigger){
                profileMenuPanel.classList.remove('open');
                profileMenuTrigger.setAttribute('aria-expanded', 'false');
            }
            if(sidebarAccountPanel && sidebarAccountTrigger){
                sidebarAccountPanel.classList.remove('open');
                sidebarAccountTrigger.setAttribute('aria-expanded', 'false');
            }
        }

        function syncState(){
            if(isMobile()){
                root.classList.add('sidebar-collapsed');
                closeMobileSidebar();
            } else {
                closeMobileSidebar();
            }
            closeAccountMenus();
            setBodyLock();
        }

        sidebarBtn.addEventListener('click', function(){
            if(isMobile()){
                root.classList.toggle('mobile-sidebar-open');
            } else {
                root.classList.toggle('sidebar-collapsed');
            }
            closeAccountMenus();
            setBodyLock();
        });

        mobileBtn.addEventListener('click', function(){
            root.classList.toggle('mobile-sidebar-open');
            closeAccountMenus();
            setBodyLock();
        });

        if(profileMenuTrigger && profileMenuPanel){
            profileMenuTrigger.addEventListener('click', function(e){
                e.stopPropagation();
                const willOpen = !profileMenuPanel.classList.contains('open');
                closeAccountMenus();
                if(willOpen){
                    profileMenuPanel.classList.add('open');
                    profileMenuTrigger.setAttribute('aria-expanded', 'true');
                }
            });
        }

        if(sidebarAccountTrigger && sidebarAccountPanel){
            sidebarAccountTrigger.addEventListener('click', function(e){
                e.stopPropagation();
                const willOpen = !sidebarAccountPanel.classList.contains('open');
                closeAccountMenus();
                if(willOpen){
                    sidebarAccountPanel.classList.add('open');
                    sidebarAccountTrigger.setAttribute('aria-expanded', 'true');
                }
            });
        }

        backdrop.addEventListener('click', function(){
            closeAccountMenus();
            closeMobileSidebar();
        });

        document.addEventListener('click', function(e){
            if(profileMenuPanel && profileMenuTrigger){
                if(!profileMenuPanel.contains(e.target) && !profileMenuTrigger.contains(e.target)){
                    profileMenuPanel.classList.remove('open');
                    profileMenuTrigger.setAttribute('aria-expanded', 'false');
                }
            }
            if(sidebarAccountPanel && sidebarAccountTrigger){
                if(!sidebarAccountPanel.contains(e.target) && !sidebarAccountTrigger.contains(e.target)){
                    sidebarAccountPanel.classList.remove('open');
                    sidebarAccountTrigger.setAttribute('aria-expanded', 'false');
                }
            }
        });

        document.addEventListener('keydown', function(e){
            if(e.key === 'Escape'){
                closeAccountMenus();
                closeMobileSidebar();
            }
        });

        window.addEventListener('resize', syncState);
        syncState();
    })();
</script>

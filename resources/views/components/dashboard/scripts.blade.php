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
        const loadDuration = 650;
        let lazyObserver = null;

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

        function initLazySections(){
            if(!root || !('IntersectionObserver' in window) || isMobile()){
                if(root){
                    root.querySelectorAll('.lazy-host').forEach(function(el){ el.classList.add('lazy-visible'); });
                }
                return;
            }

            const lazyTargets = root.querySelectorAll('.stats, .panel, .registry-wrap, .attendance-shell, .insight-shell, .ledger');
            if(!lazyTargets.length){ return; }

            lazyObserver = new IntersectionObserver(function(entries){
                entries.forEach(function(entry){
                    if(entry.isIntersecting){
                        const target = entry.target;
                        target.classList.add('lazy-visible');
                        const placeholder = target.previousElementSibling;
                        if(placeholder && placeholder.classList.contains('lazy-placeholder')){
                            placeholder.remove();
                        }
                        lazyObserver.unobserve(target);
                    }
                });
            }, { rootMargin: '40px 0px', threshold: 0.05 });

            lazyTargets.forEach(function(target){
                if(target.classList.contains('lazy-host')){ return; }
                target.classList.add('lazy-host');

                const ph = document.createElement('div');
                ph.className = 'skeleton-card lazy-placeholder';
                const h = Math.max(target.getBoundingClientRect().height || 0, 90);
                ph.style.height = Math.min(h, 260) + 'px';
                target.parentNode.insertBefore(ph, target);

                lazyObserver.observe(target);
            });
        }

        if(root){
            root.classList.add('is-loading');
            window.setTimeout(function(){
                root.classList.remove('is-loading');
                root.classList.add('ready');
                initLazySections();
            }, loadDuration);
        }
    })();
</script>

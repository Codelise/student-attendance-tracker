<style>
    @import url('https://fonts.googleapis.com/css2?family=DM+Sans:wght@400;500;600;700;800&display=swap');
    :root{
        --bg:#f2f5f7;
        --panel:#ffffff;
        --line:#d9e3ea;
        --ink:#0f172a;
        --muted:#75859a;
        --teal:#068a84;
        --teal-soft:#cfeff0;
        --salmon:#ffd9d9;
        --peach:#ffdfcd;
        --white-soft:#f8fafc;
    }
    *{box-sizing:border-box;margin:0;padding:0;}
    html,body{overflow-x:hidden;}
    body{
        min-height:100vh;
        font-family:'DM Sans',sans-serif;
        background:var(--bg);
        color:var(--ink);
    }
    body.no-scroll{overflow:hidden;}
    .dashboard{
        min-height:100vh;
        display:grid;
        grid-template-columns:260px 1fr;
        gap:16px;
        padding:12px;
        align-items:start;
        transition:grid-template-columns .35s ease;
    }
    .sidebar{
        background:#ecf1f4;
        border:1px solid var(--line);
        border-radius:10px;
        padding:12px 10px;
        position:sticky;
        top:12px;
        height:calc(100vh - 24px);
        display:flex;
        flex-direction:column;
        justify-content:space-between;
        transition:padding .35s ease;
        overflow:auto;
    }
    .sidebar-head{
        display:flex;
        align-items:center;
        justify-content:space-between;
        gap:8px;
        margin-bottom:10px;
    }
    .sidebar-toggle{
        width:28px;
        height:28px;
        border:1px solid var(--line);
        border-radius:8px;
        background:#fff;
        color:#475569;
        display:grid;
        place-items:center;
        cursor:pointer;
        transition:transform .25s ease, background .25s ease;
    }
    .sidebar-toggle:hover{background:#f8fbfd;}
    .sidebar-toggle svg{transition:transform .3s ease;}
    .brand{display:flex;align-items:center;gap:10px;min-width:0;}
    .brand-logo{
        width:26px;height:26px;border-radius:8px;background:var(--teal);
        display:grid;place-items:center;color:#fff;font-size:11px;font-weight:800;flex-shrink:0;
    }
    .brand-text strong{display:block;font-size:13px;line-height:1.1;white-space:nowrap;}
    .brand-text small{display:block;font-size:10px;color:var(--muted);white-space:nowrap;}
    .menu{display:grid;gap:6px;}
    .menu a{
        text-decoration:none;color:#4b6076;font-size:13px;font-weight:600;padding:10px;border-radius:8px;
        display:flex;align-items:center;gap:9px;transition:background .2s ease;
    }
    .menu-account-trigger{
        text-decoration:none;color:#4b6076;font-size:13px;font-weight:600;padding:10px;border-radius:8px;
        display:flex;align-items:center;gap:9px;transition:background .2s ease;
        background:transparent;border:none;width:100%;cursor:pointer;font-family:'DM Sans',sans-serif;
    }
    .menu-account-trigger svg{width:14px;height:14px;opacity:.85;flex-shrink:0;}
    .menu-account-trigger:hover{background:#f4f8fa;}
    .menu a:hover{background:#f4f8fa;}
    .menu a.active{background:#fff;color:#0a7d77;border:1px solid var(--line);}
    .menu a svg{width:14px;height:14px;opacity:.85;flex-shrink:0;}
    .menu-label{white-space:nowrap;}
    .new-entry{
        margin:12px 0;width:100%;border:none;border-radius:8px;background:var(--teal);color:#fff;
        font-size:13px;font-weight:700;padding:10px;cursor:pointer;display:block;text-align:center;text-decoration:none;
    }
    .main{padding:2px 2px 2px 0;min-width:0;}
    .main{
        display:flex;
        flex-direction:column;
    }
    .sidebar-backdrop{
        position:fixed;
        inset:0;
        background:rgba(15,23,42,.35);
        opacity:0;
        pointer-events:none;
        transition:opacity .25s ease;
        z-index:900;
    }
    .dashboard.mobile-sidebar-open .sidebar-backdrop{
        opacity:1;
        pointer-events:auto;
    }
    .mobile-open{display:none;}
    .topbar{
        display:flex;
        justify-content:space-between;
        align-items:center;
        margin:4px 4px 12px;
        gap:16px;
    }
    .topbar-left{
        display:flex;
        align-items:center;
        min-width:0;
    }
    .topbar.topbar-actions-only{
        margin-top:10px;
        margin-bottom:14px;
    }
    .dashboard-hero{
        margin:22px 4px 10px;
        padding-right:8px;
    }
    .hero-title,.hero-date{
        opacity:0;
        transform:translateY(10px);
    }
    #dashboardRoot.ready .hero-title{
        animation:fadeInUp .45s ease .08s forwards;
    }
    #dashboardRoot.ready .hero-date{
        animation:fadeInUp .45s ease .16s forwards;
    }
    .topbar-main{
        min-width:0;
        padding-right:8px;
    }
    .eyebrow{font-size:10px;letter-spacing:.14em;text-transform:uppercase;color:#8192a7;font-weight:800;margin-bottom:5px;}
    .title{font-size:clamp(30px,3.5vw,42px);line-height:1.04;font-weight:800;margin-bottom:4px;max-width:860px;word-break:break-word;}
    .date{font-size:12px;color:#8b9bad;font-weight:600;}
    .top-actions{display:flex;align-items:center;gap:10px;color:#8b9bad;flex-shrink:0;}
    .top-actions{position:relative;}
    .ledger-inline{
        display:flex;align-items:center;padding:0 12px 0 4px;margin-right:2px;
    }
    .ledger-inline-title{
        font-size:17px;font-weight:800;color:#0b7e78;white-space:nowrap;line-height:1;
    }
    .ledger-inline-nav{display:flex;gap:16px;}
    .ledger-inline-nav a{
        text-decoration:none;font-size:12px;font-weight:700;color:#76879b;
    }
    .ledger-inline-nav a:hover{color:#0b7e78;}
    .icon-btn{
        width:38px;height:38px;border:1px solid var(--line);background:#fff;border-radius:10px;
        display:grid;place-items:center;color:#0f2946;cursor:pointer;
    }
    .profile-chip{
        display:flex;align-items:center;gap:10px;border:1px solid var(--line);background:#fff;border-radius:10px;
        padding:5px 10px 5px 7px;max-width:min(45vw,300px);
        cursor:pointer;font-family:'DM Sans',sans-serif;
    }
    .account-popover{
        position:absolute;right:0;top:calc(100% + 8px);z-index:1200;width:min(280px,88vw);display:none;
        background:#fff;border:1px solid var(--line);border-radius:12px;padding:12px;box-shadow:0 12px 30px rgba(15,23,42,.12);
    }
    .account-popover.open{display:block;}
    .account-panel{
        display:none;margin-top:4px;background:#fff;border:1px solid var(--line);border-radius:10px;padding:10px;
    }
    .account-panel.open{display:block;}
    .account-name{font-size:13px;font-weight:700;color:#0f172a;line-height:1.2;margin-bottom:4px;}
    .account-email{font-size:12px;color:#64748b;line-height:1.2;margin-bottom:10px;word-break:break-word;}
    .logout-btn{
        width:100%;border:1px solid #fecaca;background:#fff1f2;color:#9f1239;border-radius:8px;padding:8px 10px;
        font-size:12px;font-weight:700;cursor:pointer;font-family:'DM Sans',sans-serif;
    }
    .logout-btn:hover{background:#ffe4e6;}
    .avatar{
        width:28px;height:28px;border-radius:50%;display:grid;place-items:center;background:#f1f5f9;font-size:18px;line-height:1;
    }
    .user-name{
        color:#334155;font-size:13px;font-weight:700;white-space:nowrap;
        overflow:hidden;text-overflow:ellipsis;
    }
    .stats{
        display:grid;grid-template-columns:1.12fr 1fr 1fr;
        grid-template-areas:"total low critical" "total monitoring weekly";
        gap:10px;margin-bottom:12px;
    }
    .card{
        border-radius:10px;padding:12px;border:1px solid transparent;min-height:96px;position:relative;overflow:hidden;
    }
    .card-icon{position:absolute;right:12px;top:12px;width:28px;height:28px;opacity:.65;}
    .card-icon svg{width:100%;height:100%;}
    .card h4{font-size:10px;letter-spacing:.12em;text-transform:uppercase;font-weight:800;margin-bottom:4px;}
    .big{font-size:clamp(36px,3.4vw,48px);line-height:.9;font-weight:800;}
    .num{font-size:clamp(32px,3vw,44px);line-height:.9;font-weight:800;}
    .sub{font-size:15px;font-weight:700;margin-top:4px;}
    .tiny{position:absolute;left:12px;bottom:10px;font-size:10px;font-weight:700;opacity:.85;}
    .card-total{grid-area:total;}
    .card-low{grid-area:low;}
    .card-critical{grid-area:critical;}
    .card-monitoring{grid-area:monitoring;}
    .card-weekly{grid-area:weekly;}
    .teal{background:var(--teal);color:#fff;}
    .cyan{background:var(--teal-soft);border-color:#b8e3e4;}
    .salmon{background:var(--salmon);border-color:#ffc2c2;color:#7f1d1d;}
    .peach{background:var(--peach);border-color:#ffd1b6;color:#7c2d12;}
    .white{background:var(--white-soft);border-color:var(--line);}
    .card-weekly{display:flex;flex-direction:column;justify-content:space-between;}
    .weekly-top{display:flex;align-items:flex-start;justify-content:space-between;gap:8px;}
    .weekly-icon{
        width:24px;height:24px;border-radius:7px;border:1px solid #d3dde6;display:grid;place-items:center;color:#3b4e66;background:#fff;
        flex-shrink:0;
    }
    .weekly-metric{text-align:right;margin-left:auto;}
    .weekly-metric .num{font-size:40px;line-height:.88;}
    .weekly-metric .sub{font-size:10px;color:#748399;margin-top:2px;}
    .weekly-label{font-size:17px;font-weight:700;color:#0f172a;text-transform:none !important;letter-spacing:0 !important;margin:0 !important;}
    .content{display:grid;grid-template-columns:minmax(0,1.55fr) minmax(280px,.95fr);gap:12px;}
    .content{flex:1;align-content:start;}
    .content > *{min-height:0;}
    .panel{background:#fff;border:1px solid var(--line);border-radius:10px;padding:12px;}
    .panel-head{display:flex;align-items:center;justify-content:space-between;margin-bottom:10px;}
    .panel-head h3{font-size:20px;}
    .panel-head a{font-size:11px;color:#0b7e78;text-decoration:none;font-weight:700;}
    .activity{display:grid;gap:8px;}
    .activity-row{
        display:flex;align-items:center;justify-content:space-between;gap:9px;padding:10px;border:1px solid #edf2f6;border-radius:8px;background:#fbfdff;
    }
    .left{display:flex;gap:8px;align-items:flex-start;}
    .dot{width:22px;height:22px;border-radius:7px;display:grid;place-items:center;font-size:11px;font-weight:800;}
    .dot svg{width:13px;height:13px;}
    .g{background:#dcfce7;color:#166534;}
    .o{background:#ffedd5;color:#9a3412;}
    .b{background:#dbeafe;color:#1d4ed8;}
    .txt strong{display:block;font-size:12px;color:#334155;}
    .txt span{display:block;font-size:11px;color:#94a3b8;}
    time{font-size:11px;color:#94a3b8;font-weight:700;white-space:nowrap;}
    .quick-list{display:grid;gap:8px;margin-top:2px;}
    .quick{
        border:1px solid #edf2f6;background:#fbfdff;border-radius:8px;display:flex;align-items:center;gap:8px;padding:10px;text-decoration:none;color:#334155;
        font-size:12px;font-weight:700;
    }
    .quick i{
        width:20px;height:20px;border-radius:6px;background:#e2e8f0;display:grid;place-items:center;font-style:normal;font-size:10px;font-weight:800;
    }
    .quick i svg{width:12px;height:12px;}
    .tip{margin-top:10px;padding:11px;border-radius:10px;border:1px dashed #9be5d2;background:#effffb;}
    .tip h4{font-size:10px;letter-spacing:.1em;text-transform:uppercase;color:#0f766e;margin-bottom:6px;}
    .tip p{font-size:11px;color:#334155;line-height:1.45;}
    .tip small{display:block;margin-top:7px;font-size:10px;color:#0f766e;font-weight:700;}
    .dashboard.sidebar-collapsed{grid-template-columns:84px 1fr;}
    .dashboard.sidebar-collapsed .sidebar{padding-left:8px;padding-right:8px;}
    .dashboard.sidebar-collapsed .brand-text,
    .dashboard.sidebar-collapsed .menu-label,
    .dashboard.sidebar-collapsed .new-entry span{display:none;}
    .dashboard.sidebar-collapsed .account-panel{display:none !important;}
    .dashboard.sidebar-collapsed .menu a{justify-content:center;padding-left:8px;padding-right:8px;}
    .dashboard.sidebar-collapsed .new-entry{padding:10px 8px;}
    .dashboard.sidebar-collapsed .new-entry::after{content:"+";font-size:18px;line-height:1;}
    .dashboard.sidebar-collapsed .new-entry{font-size:0;}
    .dashboard.sidebar-collapsed .sidebar-toggle svg{transform:rotate(180deg);}
    .page-skeleton{display:none;}
    .skeleton-card{
        background:linear-gradient(90deg,#ecf2f7 25%,#f6f9fc 37%,#ecf2f7 63%);
        background-size:400% 100%;
        animation:skeletonPulse 1.25s ease-in-out infinite;
        border:1px solid #e1eaf2;
        border-radius:10px;
    }
    .skeleton-line{height:12px;border-radius:8px;}
    .skeleton-line.lg{height:18px;}
    .skeleton-line.sm{height:9px;}
    .skeleton-grid{display:grid;gap:10px;}
    .fade-in-up{animation:fadeInUp .5s ease both;}
    #dashboardRoot.is-loading .page-skeleton{display:block;}
    #dashboardRoot.is-loading [data-page-content]{display:none;}
    #dashboardRoot.ready [data-animate]{animation:fadeInUp .45s ease both;}
    #dashboardRoot.ready [data-animate-delay="1"]{animation-delay:.06s;}
    #dashboardRoot.ready [data-animate-delay="2"]{animation-delay:.12s;}
    #dashboardRoot.ready [data-animate-delay="3"]{animation-delay:.18s;}
    #dashboardRoot.ready [data-animate-delay="4"]{animation-delay:.24s;}
    .lazy-host{
        opacity:0;
        transform:translateY(10px);
        transition:opacity .35s ease, transform .35s ease;
    }
    .lazy-host.lazy-visible{
        opacity:1;
        transform:translateY(0);
    }
    .lazy-placeholder{
        border-radius:10px;
        margin-bottom:10px;
    }
    @keyframes skeletonPulse{
        0%{background-position:100% 50%;}
        100%{background-position:0 50%;}
    }
    @keyframes fadeInUp{
        from{opacity:0;transform:translateY(8px);}
        to{opacity:1;transform:translateY(0);}
    }
    @media(min-width:1500px){
        .dashboard{
            grid-template-columns:290px 1fr;
            gap:20px;
            padding:16px;
        }
        .main{
            max-width:1700px;
            min-height:calc(100vh - 36px);
        }
        .title{
            font-size:clamp(38px,3.2vw,52px);
            max-width:980px;
        }
        .topbar{margin-bottom:16px;}
        .stats{gap:12px;margin-bottom:16px;}
        .content{
            gap:14px;
            min-height:calc(100vh - 290px);
        }
        .panel,.card{border-radius:12px;}
        .panel{padding:14px;}
        .card{padding:14px;}
    }
    @media(max-width:1240px){
        .dashboard{grid-template-columns:232px 1fr;}
        .title{font-size:clamp(26px,3.1vw,36px);}
        .num{font-size:38px;}
        .big{font-size:42px;}
        .sub{font-size:13px;}
    }
    @media(max-width:1024px){
        .stats{grid-template-columns:1fr 1fr;grid-template-areas:"total total" "low critical" "monitoring weekly";}
        .content{grid-template-columns:1fr;}
    }
    @media(max-width:920px){
        .topbar{gap:10px;}
        .dashboard-hero{margin-top:18px;}
        .title{font-size:clamp(24px,4vw,30px);}
        .top-actions{gap:6px;}
        .ledger-inline{display:none;}
        .icon-btn{width:34px;height:34px;}
        .profile-chip{padding:4px 8px 4px 6px;max-width:min(52vw,250px);}
        .avatar{width:24px;height:24px;}
        .user-name{font-size:12px;}
        .stats{grid-template-columns:1fr;grid-template-areas:"total" "low" "critical" "monitoring" "weekly";}
    }
    @media(max-width:860px){
        .dashboard{grid-template-columns:1fr;padding:10px;}
        .dashboard.sidebar-collapsed{grid-template-columns:1fr;}
        .sidebar{
            position:fixed;top:10px;bottom:10px;left:10px;width:250px;z-index:1000;box-shadow:0 10px 40px rgba(15,23,42,.22);
            transform:translateX(-112%);transition:transform .35s ease;
        }
        .dashboard.mobile-sidebar-open .sidebar{transform:translateX(0);}
        .dashboard.sidebar-collapsed .sidebar{transform:translateX(-112%);}
        .main{padding:0;}
        .topbar{padding-left:0;padding-top:42px;}
        .dashboard-hero{padding-top:42px;margin-top:0;}
        .mobile-open{
            position:fixed;top:14px;left:14px;width:34px;height:34px;z-index:1100;border:1px solid var(--line);border-radius:9px;background:#fff;
            color:#475569;display:grid;place-items:center;cursor:pointer;
        }
    }
    @media(max-width:700px){
        .topbar{gap:6px;padding-left:0;padding-top:42px;}
        .top-actions{margin-top:0;gap:6px;}
        .user-name{font-size:11px;max-width:120px;}
        .icon-btn{width:32px;height:32px;}
        .profile-chip{padding:3px 7px 3px 5px;max-width:160px;}
        .avatar{width:22px;height:22px;}
        .panel-head h3{font-size:17px;}
        .quick{font-size:11px;}
        .txt strong{font-size:11px;}
        .account-popover{right:0;top:calc(100% + 6px);}
    }
</style>

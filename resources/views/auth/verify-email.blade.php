<x-guest-layout>
<style>
    @import url('https://fonts.googleapis.com/css2?family=DM+Sans:wght@300;400;500;600;700&family=DM+Serif+Display&display=swap');
    *{box-sizing:border-box;margin:0;padding:0;}
    .auth-wrap{display:flex;min-height:100vh;font-family:'DM Sans',sans-serif;}
    .auth-left{width:420px;min-width:420px;background-color:#0d9488;background-image:radial-gradient(circle at 20% 80%,rgba(255,255,255,.08) 0%,transparent 50%),radial-gradient(circle at 80% 20%,rgba(255,255,255,.06) 0%,transparent 45%);color:white;padding:48px 40px;display:flex;flex-direction:column;justify-content:space-between;position:relative;overflow:hidden;}
    .auth-left::before{content:'';position:absolute;bottom:-50px;right:-50px;width:220px;height:220px;border:2px solid rgba(255,255,255,.08);border-radius:50%;}
    .auth-left::after{content:'';position:absolute;bottom:-100px;right:-100px;width:340px;height:340px;border:2px solid rgba(255,255,255,.05);border-radius:50%;}
    .left-logo{display:flex;align-items:center;gap:12px;margin-bottom:56px;}
    .left-logo-icon{background:rgba(255,255,255,.15);border-radius:12px;padding:10px;display:flex;}
    .left-logo span{font-size:11px;font-weight:700;letter-spacing:.15em;text-transform:uppercase;opacity:.9;}
    .left-eyebrow{font-size:10px;font-weight:700;letter-spacing:.15em;text-transform:uppercase;opacity:.55;margin-bottom:12px;}
    .left-heading{font-family:'DM Serif Display',serif;font-size:38px;line-height:1.15;margin-bottom:20px;}
    .left-sub{font-size:14px;color:rgba(255,255,255,.75);line-height:1.65;margin-bottom:36px;}
    .left-footer{font-size:11px;opacity:.45;position:relative;z-index:1;margin-top:40px;}
    .auth-right{flex:1;background:#f8fafc;display:flex;align-items:center;justify-content:center;padding:40px 24px;}
    .auth-form-wrap{width:100%;max-width:420px;}
    .fade-in{animation:fadeUp .45s ease both;}
    .fade-in-2{animation:fadeUp .45s .08s ease both;}
    .fade-in-3{animation:fadeUp .45s .16s ease both;}
    @keyframes fadeUp{from{opacity:0;transform:translateY(12px);}to{opacity:1;transform:translateY(0);}}
    .btn-primary{width:100%;background:#0d9488;color:white;border:none;border-radius:10px;padding:12px 20px;font-size:14px;font-weight:600;font-family:'DM Sans',sans-serif;cursor:pointer;display:flex;align-items:center;justify-content:center;gap:8px;transition:background .2s,box-shadow .2s,transform .1s;}
    .btn-primary:hover{background:#0f766e;box-shadow:0 4px 20px rgba(13,148,136,.3);transform:translateY(-1px);}
    .btn-primary:active{transform:translateY(0);}
    .page-heading{font-family:'DM Serif Display',serif;font-size:30px;color:#0f172a;margin-bottom:6px;}
    .page-sub{font-size:13px;color:#6b7280;line-height:1.55;}
    .icon-ring{width:72px;height:72px;border-radius:50%;background:rgba(13,148,136,.1);display:flex;align-items:center;justify-content:center;margin:0 auto 24px;}
    .info-card{background:white;border:1px solid #e5e7eb;border-radius:14px;padding:24px;margin-bottom:20px;}
    .info-card p{font-size:13px;color:#6b7280;margin-bottom:4px;}
    .info-card small{font-size:12px;color:#9ca3af;}
    .success-banner{display:flex;align-items:flex-start;gap:10px;background:#f0fdf9;border:1px solid #99f6e4;border-radius:10px;padding:14px;margin-bottom:20px;}
    .success-banner p{font-size:13px;color:#065f46;font-weight:500;}
    .logout-link{display:block;text-align:center;margin-top:20px;font-size:13px;color:#6b7280;text-decoration:underline;text-underline-offset:2px;background:none;border:none;cursor:pointer;font-family:'DM Sans',sans-serif;width:100%;}
    .logout-link:hover{color:#374151;}
    /* Step tracker */
    .steps{display:flex;flex-direction:column;gap:0;position:relative;z-index:1;}
    .step{display:flex;align-items:flex-start;gap:14px;}
    .step-num{width:28px;height:28px;border-radius:50%;background:white;color:#0d9488;font-size:12px;font-weight:700;display:flex;align-items:center;justify-content:center;flex-shrink:0;}
    .step-num.inactive{background:rgba(255,255,255,.2);color:white;}
    .step-text p{font-size:13px;font-weight:500;}
    .step-text small{font-size:11px;opacity:.6;}
    .step-line{width:2px;height:22px;background:rgba(255,255,255,.2);margin-left:13px;}
    @media(max-width:767px){.auth-left{display:none;}}
</style>

<div class="auth-wrap">

    <div class="auth-left">
        <div>
            <div class="left-logo">
                <div class="left-logo-icon"><svg width="18" height="18" fill="white" viewBox="0 0 20 20"><path d="M10.707 2.293a1 1 0 00-1.414 0l-7 7a1 1 0 001.414 1.414L4 10.414V17a1 1 0 001 1h2a1 1 0 001-1v-2a1 1 0 011-1h2a1 1 0 011 1v2a1 1 0 001 1h2a1 1 0 001-1v-6.586l.293.293a1 1 0 001.414-1.414l-7-7z"/></svg></div>
                <span>Gordon College</span>
            </div>
            <p class="left-eyebrow">The Scholarly Ledger</p>
            <h1 class="left-heading">One Step<br>Away from<br>Access.</h1>
            <p class="left-sub">Verify your institutional email address to complete registration and secure your account.</p>
            <div class="steps">
                <div class="step"><div class="step-num">1</div><div class="step-text"><p>Create Account</p><small>Registration complete</small></div></div>
                <div class="step-line"></div>
                <div class="step"><div class="step-num">2</div><div class="step-text"><p>Verify Email</p><small>Check your inbox</small></div></div>
                <div class="step-line" style="opacity:.1"></div>
                <div class="step" style="opacity:.4"><div class="step-num inactive">3</div><div class="step-text"><p>Access Dashboard</p><small>Start tracking attendance</small></div></div>
            </div>
        </div>
        <p class="left-footer">© 2026 Gordon College, Attendance Tracking System</p>
    </div>

    <div class="auth-right">
        <div class="auth-form-wrap">

            <div class="fade-in" style="text-align:center;margin-bottom:28px;">
                <div class="icon-ring">
                    <svg width="32" height="32" fill="none" stroke="#0d9488" stroke-width="1.5" viewBox="0 0 24 24"><path d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
                </div>
                <h2 class="page-heading">Verify Your Email</h2>
                <p class="page-sub" style="margin-top:8px;">Thanks for signing up! Click the verification link we sent to your inbox to get started.</p>
            </div>

            @if (session('status') == 'verification-link-sent')
                <div class="success-banner fade-in">
                    <svg width="18" height="18" fill="none" stroke="#059669" stroke-width="2" viewBox="0 0 24 24" style="flex-shrink:0;margin-top:1px"><path d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                    <p>A new verification link has been sent to your registered email address.</p>
                </div>
            @endif

            <div class="info-card fade-in-2">
                <p>Didn't receive the email?</p>
                <small>Check your spam folder, or request a new link below.</small>
                <form method="POST" action="{{ route('verification.send') }}" style="margin-top:16px;">
                    @csrf
                    <button type="submit" class="btn-primary">
                        <svg width="15" height="15" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"/><polyline points="22,6 12,12 2,6"/></svg>
                        Resend Verification Email
                    </button>
                </form>
            </div>

            <form method="POST" action="{{ route('logout') }}" class="fade-in-3">
                @csrf
                <button type="submit" class="logout-link">Sign out and use a different account</button>
            </form>

        </div>
    </div>
</div>
</x-guest-layout>
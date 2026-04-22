<x-guest-layout>
<style>
    @import url('https://fonts.googleapis.com/css2?family=DM+Sans:wght@300;400;500;600;700&family=DM+Serif+Display&display=swap');
    *{box-sizing:border-box;margin:0;padding:0;}
    .auth-wrap{--panel-width:420px;display:flex;gap:0;min-height:100vh;font-family:'DM Sans',sans-serif;justify-content:center;align-items:stretch;background:#f8fafc;padding:24px;}
    .auth-left{width:var(--panel-width);min-height:640px;background-color:#0d9488;background-image:radial-gradient(circle at 20% 80%,rgba(255,255,255,.08) 0%,transparent 50%),radial-gradient(circle at 80% 20%,rgba(255,255,255,.06) 0%,transparent 45%);color:white;padding:48px 40px;display:flex;flex-direction:column;justify-content:space-between;position:relative;overflow:hidden;border-radius:16px 0 0 16px;}
    .auth-left::before{content:'';position:absolute;bottom:-50px;right:-50px;width:220px;height:220px;border:2px solid rgba(255,255,255,.08);border-radius:50%;}
    .auth-left::after{content:'';position:absolute;bottom:-100px;right:-100px;width:340px;height:340px;border:2px solid rgba(255,255,255,.05);border-radius:50%;}
    .left-logo{display:flex;align-items:center;gap:12px;margin-bottom:56px;}
    .left-logo-icon{background:rgba(255,255,255,.15);border-radius:12px;padding:10px;display:flex;}
    .left-logo span{font-size:11px;font-weight:700;letter-spacing:.15em;text-transform:uppercase;opacity:.9;}
    .left-eyebrow{font-size:10px;font-weight:700;letter-spacing:.15em;text-transform:uppercase;opacity:.55;margin-bottom:12px;}
    .left-heading{font-family:'DM Serif Display',serif;font-size:38px;line-height:1.15;margin-bottom:20px;}
    .left-sub{font-size:14px;color:rgba(255,255,255,.75);line-height:1.65;margin-bottom:40px;}
    .stat-grid{display:grid;grid-template-columns:1fr 1fr;gap:14px;position:relative;z-index:1;}
    .stat-card{background:rgba(255,255,255,.1);border:1px solid rgba(255,255,255,.15);border-radius:12px;padding:16px 18px;}
    .stat-card .num{font-size:22px;font-weight:700;margin-bottom:4px;}
    .stat-card .lbl{font-size:11px;opacity:.65;}
    .left-footer{font-size:11px;opacity:.45;position:relative;z-index:1;margin-top:40px;}
    .auth-right{width:var(--panel-width);display:flex;align-items:stretch;justify-content:center;min-height:640px;}
    .auth-form-wrap{width:100%;height:100%;background:white;border-radius:0 16px 16px 0;padding:40px 32px;box-shadow:0 4px 6px rgba(0,0,0,.07),0 10px 20px rgba(0,0,0,.08);}
    .fade-in{animation:fadeUp .45s ease both;}
    .fade-in-2{animation:fadeUp .45s .08s ease both;}
    .fade-in-3{animation:fadeUp .45s .16s ease both;}
    @keyframes fadeUp{from{opacity:0;transform:translateY(12px);}to{opacity:1;transform:translateY(0);}}
    .form-label{display:block;font-size:13px;font-weight:500;color:#374151;margin-bottom:6px;}
    .input-wrap{position:relative;}
    .input-icon{position:absolute;left:12px;top:50%;transform:translateY(-50%);color:#94a3b8;display:flex;}
    .form-input{width:100%;border:1.5px solid #e2e8f0;border-radius:10px;padding:11px 14px 11px 38px;font-size:14px;font-family:'DM Sans',sans-serif;background:white;color:#111827;transition:border-color .2s,box-shadow .2s;outline:none;}
    .form-input:focus{border-color:#0d9488;box-shadow:0 0 0 3px rgba(13,148,136,.12);}
    .form-input.has-right{padding-right:42px;}
    .pwd-toggle{position:absolute;right:12px;top:50%;transform:translateY(-50%);background:none;border:none;cursor:pointer;color:#94a3b8;display:flex;padding:0;transition:color .15s;}
    .pwd-toggle:hover{color:#0d9488;}
    .divider{display:flex;align-items:center;gap:10px;color:#94a3b8;font-size:11px;letter-spacing:.08em;margin:4px 0;}
    .divider::before,.divider::after{content:'';flex:1;height:1px;background:#e5e7eb;}
    .btn-primary{width:100%;background:#0d9488;color:white;border:none;border-radius:10px;padding:12px 20px;font-size:14px;font-weight:600;font-family:'DM Sans',sans-serif;cursor:pointer;display:flex;align-items:center;justify-content:center;gap:8px;transition:background .2s,box-shadow .2s,transform .1s;letter-spacing:.02em;}
    .btn-primary:hover{background:#0f766e;box-shadow:0 4px 20px rgba(13,148,136,.3);transform:translateY(-1px);}
    .btn-primary:active{transform:translateY(0);}
    .btn-sso{width:100%;background:white;color:#374151;border:1.5px solid #e2e8f0;border-radius:10px;padding:11px 20px;font-size:14px;font-weight:500;font-family:'DM Sans',sans-serif;cursor:pointer;display:flex;align-items:center;justify-content:center;gap:8px;transition:border-color .2s,box-shadow .2s;}
    .btn-sso:hover{border-color:#0d9488;box-shadow:0 2px 8px rgba(0,0,0,.06);}
    .check-wrap{display:flex;align-items:center;gap:8px;}
    .check-wrap input[type=checkbox]{width:15px;height:15px;accent-color:#0d9488;cursor:pointer;}
    .check-wrap label{font-size:13px;color:#6b7280;cursor:pointer;}
    .page-heading{font-family:'DM Serif Display',serif;font-size:30px;color:#0f172a;margin-bottom:6px;}
    .page-sub{font-size:13px;color:#6b7280;line-height:1.5;margin-bottom:28px;}
    .label-row{display:flex;align-items:center;justify-content:space-between;margin-bottom:6px;}
    .label-link{font-size:12px;font-weight:500;color:#0d9488;text-decoration:none;}
    .label-link:hover{color:#0f766e;}
    .form-footer{margin-top:28px;text-align:center;font-size:13px;color:#6b7280;}
    .form-footer a{font-weight:600;color:#0d9488;text-decoration:none;margin-left:4px;}
    .form-footer a:hover{color:#0f766e;}
    .space-y>*+*{margin-top:18px;}
    @media(max-width:1100px){
        .auth-wrap{--panel-width:380px;gap:0;padding:20px;}
        .auth-left{padding:40px 30px;min-height:600px;}
        .auth-form-wrap{padding:34px 26px;}
    }
    @media(max-width:900px){
        .auth-wrap{--panel-width:100%;flex-direction:column;max-width:520px;margin:0 auto;gap:10px;padding:16px;}
        .auth-left,.auth-right{width:100%;min-height:auto;}
        .auth-left{padding:34px 24px;border-radius:16px;}
        .auth-form-wrap{border-radius:16px;}
    }
    @media(max-width:767px){
        .auth-wrap{padding:12px;}
        .auth-left{display:none;}
        .auth-right{width:100%;}
        .auth-form-wrap{padding:28px 18px;border-radius:14px;}
    }
</style>

<div class="auth-wrap">

    <div class="auth-left">
        <div>
            <div class="left-logo">
                <div class="left-logo-icon">
                    <svg width="18" height="18" fill="white" viewBox="0 0 20 20"><path d="M10.707 2.293a1 1 0 00-1.414 0l-7 7a1 1 0 001.414 1.414L4 10.414V17a1 1 0 001 1h2a1 1 0 001-1v-2a1 1 0 011-1h2a1 1 0 011 1v2a1 1 0 001 1h2a1 1 0 001-1v-6.586l.293.293a1 1 0 001.414-1.414l-7-7z"/></svg>
                </div>
                <span>Gordon College</span>
            </div>
            <p class="left-eyebrow">The Scholarly Ledger</p>
            <h1 class="left-heading">Precision in<br>Academic<br>Management.</h1>
            <p class="left-sub">A refined attendance ecosystem designed for educators who value institutional trust and data integrity.</p>
            <div class="stat-grid">
                <div class="stat-card"><div class="num">99.8%</div><div class="lbl">Data Accuracy</div></div>
                <div class="stat-card"><div class="num">Real-time</div><div class="lbl">Tracking System</div></div>
            </div>
        </div>
        <p class="left-footer">© 2026 Gordon College, Attendance Tracking System</p>
    </div>

    <div class="auth-right">
        <div class="auth-form-wrap">

            <div class="fade-in">
                <h2 class="page-heading">Welcome Back</h2>
                <p class="page-sub">Please enter your credentials to access the faculty dashboard.</p>
            </div>

            <x-auth-session-status class="mb-4" :status="session('status')" />

            <form method="POST" action="{{ route('login') }}" class="space-y fade-in-2">
                @csrf

                <div>
                    <label for="email" class="form-label">Institutional Email</label>
                    <div class="input-wrap">
                        <span class="input-icon"><svg width="16" height="16" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg></span>
                        <input id="email" name="email" type="email" value="{{ old('email') }}" class="form-input" placeholder="name@college.edu" required autofocus autocomplete="username"/>
                    </div>
                    <x-input-error :messages="$errors->get('email')" class="mt-1" />
                </div>

                <div>
                    <div class="label-row">
                        <label for="password" class="form-label" style="margin-bottom:0">Security Password</label>
                        @if (Route::has('password.request'))
                            <a href="{{ route('password.request') }}" class="label-link">Forgot password?</a>
                        @endif
                    </div>
                    <div class="input-wrap">
                        <span class="input-icon"><svg width="16" height="16" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/></svg></span>
                        <input id="password" name="password" type="password" class="form-input has-right" placeholder="••••••••" required autocomplete="current-password"/>
                        <button type="button" class="pwd-toggle" onclick="togglePwd('password',this)">
                            <svg width="16" height="16" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/></svg>
                        </button>
                    </div>
                    <x-input-error :messages="$errors->get('password')" class="mt-1" />
                </div>

                <div class="check-wrap">
                    <input id="remember_me" name="remember" type="checkbox"/>
                    <label for="remember_me">Remember this device for 30 days</label>
                </div>

                <button type="submit" class="btn-primary">
                    Access Ledger
                    <svg width="15" height="15" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path d="M13 7l5 5m0 0l-5 5m5-5H6"/></svg>
                </button>

                <div class="divider">OR AUTHENTICATE WITH</div>

                <button type="button" class="btn-sso">
                    <svg width="16" height="16" fill="#0d9488" viewBox="0 0 24 24"><path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm-2 15l-5-5 1.41-1.41L10 14.17l7.59-7.59L19 8l-9 9z"/></svg>
                    Single Sign-On (SSO)
                </button>
            </form>

            <div class="form-footer fade-in-3">
                New to the institution?<a href="{{ route('register') }}">Create an Account</a>
            </div>
        </div>
    </div>
</div>

<script>
function togglePwd(id,btn){const el=document.getElementById(id);const show=el.type==='password';el.type=show?'text':'password';btn.innerHTML=show?`<svg width="16" height="16" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l3.59 3.59m0 0A9.953 9.953 0 0112 5c4.478 0 8.268 2.943 9.543 7a10.025 10.025 0 01-4.132 5.411m0 0L21 21"/></svg>`:`<svg width="16" height="16" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/></svg>`;}
</script>
</x-guest-layout>

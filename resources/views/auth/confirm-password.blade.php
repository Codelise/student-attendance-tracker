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
    .notice-card{background:rgba(255,255,255,.1);border:1px solid rgba(255,255,255,.15);border-radius:12px;padding:18px 20px;display:flex;align-items:flex-start;gap:12px;position:relative;z-index:1;}
    .notice-card p{font-size:13px;color:rgba(255,255,255,.8);line-height:1.55;}
    .left-footer{font-size:11px;opacity:.45;position:relative;z-index:1;margin-top:40px;}
    .auth-right{flex:1;background:#f8fafc;display:flex;align-items:center;justify-content:center;padding:40px 24px;}
    .auth-form-wrap{width:100%;max-width:420px;}
    .fade-in{animation:fadeUp .45s ease both;}
    .fade-in-2{animation:fadeUp .45s .08s ease both;}
    @keyframes fadeUp{from{opacity:0;transform:translateY(12px);}to{opacity:1;transform:translateY(0);}}
    .form-label{display:block;font-size:13px;font-weight:500;color:#374151;margin-bottom:6px;}
    .input-wrap{position:relative;}
    .input-icon{position:absolute;left:12px;top:50%;transform:translateY(-50%);color:#94a3b8;display:flex;}
    .form-input{width:100%;border:1.5px solid #e2e8f0;border-radius:10px;padding:11px 42px 11px 38px;font-size:14px;font-family:'DM Sans',sans-serif;background:white;color:#111827;transition:border-color .2s,box-shadow .2s;outline:none;}
    .form-input:focus{border-color:#0d9488;box-shadow:0 0 0 3px rgba(13,148,136,.12);}
    .pwd-toggle{position:absolute;right:12px;top:50%;transform:translateY(-50%);background:none;border:none;cursor:pointer;color:#94a3b8;display:flex;padding:0;}
    .pwd-toggle:hover{color:#0d9488;}
    .btn-primary{width:100%;background:#0d9488;color:white;border:none;border-radius:10px;padding:12px 20px;font-size:14px;font-weight:600;font-family:'DM Sans',sans-serif;cursor:pointer;display:flex;align-items:center;justify-content:center;gap:8px;transition:background .2s,box-shadow .2s,transform .1s;}
    .btn-primary:hover{background:#0f766e;box-shadow:0 4px 20px rgba(13,148,136,.3);transform:translateY(-1px);}
    .btn-primary:active{transform:translateY(0);}
    .page-heading{font-family:'DM Serif Display',serif;font-size:30px;color:#0f172a;margin-bottom:6px;}
    .page-sub{font-size:13px;color:#6b7280;line-height:1.55;margin-bottom:28px;}
    .icon-ring{width:72px;height:72px;border-radius:50%;background:rgba(13,148,136,.1);display:flex;align-items:center;justify-content:center;margin:0 auto 24px;}
    .space-y>*+*{margin-top:18px;}
    .back-link{display:flex;align-items:center;justify-content:center;gap:6px;margin-top:24px;font-size:13px;color:#0d9488;text-decoration:none;font-weight:500;}
    .back-link:hover{color:#0f766e;}
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
            <h1 class="left-heading">Secure<br>Area<br>Checkpoint.</h1>
            <p class="left-sub">This extra verification step protects sensitive areas of your institutional account from unauthorized access.</p>
            <div class="notice-card">
                <svg width="18" height="18" fill="none" stroke="rgba(255,255,255,.7)" stroke-width="2" viewBox="0 0 24 24" style="flex-shrink:0;margin-top:1px"><path d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                <p>You're accessing a protected section. Re-enter your password to confirm your identity before proceeding.</p>
            </div>
        </div>
        <p class="left-footer">© 2026 Gordon College, Attendance Tracking System</p>
    </div>

    <div class="auth-right">
        <div class="auth-form-wrap">

            <div class="fade-in" style="text-align:center;margin-bottom:28px;">
                <div class="icon-ring">
                    <svg width="32" height="32" fill="none" stroke="#0d9488" stroke-width="1.5" viewBox="0 0 24 24"><path d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/></svg>
                </div>
                <h2 class="page-heading">Confirm Identity</h2>
                <p class="page-sub">This is a secure area. Please confirm your password before continuing.</p>
            </div>

            <form method="POST" action="{{ route('password.confirm') }}" class="space-y fade-in-2">
                @csrf
                <div>
                    <label for="password" class="form-label">Security Password</label>
                    <div class="input-wrap">
                        <span class="input-icon"><svg width="16" height="16" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/></svg></span>
                        <input id="password" name="password" type="password" class="form-input" placeholder="••••••••" required autocomplete="current-password"/>
                        <button type="button" class="pwd-toggle" onclick="togglePwd('password',this)">
                            <svg width="16" height="16" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/></svg>
                        </button>
                    </div>
                    <x-input-error :messages="$errors->get('password')" class="mt-1" />
                </div>
                <button type="submit" class="btn-primary">
                    Confirm &amp; Continue
                    <svg width="15" height="15" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path d="M13 7l5 5m0 0l-5 5m5-5H6"/></svg>
                </button>
            </form>

            <a href="{{ route('login') }}" class="back-link">
                <svg width="15" height="15" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M11 17l-5-5m0 0l5-5m-5 5h12"/></svg>
                Back to Sign In
            </a>
        </div>
    </div>
</div>

<script>
function togglePwd(id,btn){const el=document.getElementById(id);const show=el.type==='password';el.type=show?'text':'password';btn.innerHTML=show?`<svg width="16" height="16" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l3.59 3.59m0 0A9.953 9.953 0 0112 5c4.478 0 8.268 2.943 9.543 7a10.025 10.025 0 01-4.132 5.411m0 0L21 21"/></svg>`:`<svg width="16" height="16" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/></svg>`;}
</script>
</x-guest-layout>
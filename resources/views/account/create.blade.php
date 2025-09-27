<!doctype html>
<html lang="ja">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width,initial-scale=1" />
    <title>ユーザー登録</title>
    <style>
        :root{
            --bg: #f6f8fb;
            --card: #ffffff;
            --accent: #2563eb;
            --muted: #6b7280;
            --radius: 12px;
            --glass: rgba(255,255,255,0.6);
            --shadow: 0 6px 24px rgba(20,25,35,0.08);
            font-family: Inter, ui-sans-serif, system-ui, -apple-system, "Helvetica Neue", "Yu Gothic", "Hiragino Kaku Gothic ProN", "Noto Sans JP", "Segoe UI", Roboto, "Arial";
        }
        *{box-sizing:border-box}
        html,body{height:100%}
        body{
            margin:0;background:linear-gradient(180deg,#eef2ff 0%,var(--bg) 60%);
            color:#0f172a;display:flex;align-items:center;justify-content:center;padding:32px;
        }
        .wrap{max-width: 980px;display: grid;grid-template-columns: 1fr;gap: 28px;align-items: center;}
        .card{background:var(--card);border-radius:var(--radius);box-shadow:var(--shadow);padding:28px;min-height:360px}
        .hero{display:flex;flex-direction:column;gap:18px;padding:28px}
        h1{margin:0;font-size:20px}
        p.lead{margin:0;color:var(--muted);line-height:1.45}
        form{display:flex;flex-direction:column;gap:14px}
        label{font-size:13px;color:var(--muted);display:block;margin-bottom:6px}
        .field{display:flex;flex-direction:column;gap:6px}
        input[type="text"],input[type="email"],input[type="password"]{width:100%;padding:12px 14px;border-radius:10px;border:1px solid #e6e9ef;background:transparent;font-size:15px;outline:none;transition:box-shadow .15s,border-color .15s}
        input:focus{box-shadow:0 6px 18px rgba(37,99,235,0.08);border-color:var(--accent)}
        input:user-invalid{box-shadow:0 6px 18px rgba(37,99,235,0.08);border-color:var(--error)}
        .password-row{position:relative;display:flex}
        .password-row input{flex:1}
        .toggle-visibility{position:absolute;right:8px;top:50%;transform:translateY(-50%);background:none;border:none;padding:8px;border-radius:8px;cursor:pointer;font-size:13px;color:var(--muted)}
        .row{display:flex;align-items:center;justify-content:space-between}
        button.primary{width: 100%;margin-top: 40px;border:0;padding:12px 14px;border-radius:10px;background:linear-gradient(90deg,var(--accent),#7c3aed);color:white;font-weight:600;font-size:15px;cursor:pointer;box-shadow:0 8px 30px rgba(37,99,235,0.12); transition: .3s;}
        button.primary:hover{ opacity: .9;}
        .alt{display:flex;gap:10px;align-items:center;justify-content:center;margin-top:12px}
        .divider{display:flex;align-items:center;gap:10px;color:var(--muted);font-size:13px}
        .divider:before,.divider:after{content:"";height:1px;background:#e6e9ef;flex:1;border-radius:2px}
        .note{font-size:13px;color:var(--muted);text-align:center;}
        footer.small{font-size:12px;color:var(--muted);text-align:center;margin-top:10px}
    </style>
</head>
<body>
<main class="wrap">
    <section class="card hero" aria-labelledby="register-title">
        <div>
            <h1 id="register-title">ユーザー登録</h1>
            <p class="lead">必要事項を入力してアカウントを作成してください。</p>
        </div>
        <form id="registerForm" action="{{ route('account.store') }}" method="post" novalidate>
            @csrf
            <div class="field">
                <label for="name">お名前</label>
                <input id="name" name="name" type="text" placeholder="山田 太郎" value="{{ old('name') }}" required />
            </div>
            <div class="field">
                <label for="email">メールアドレス</label>
                <input id="email" name="email" type="email" autocomplete="email" placeholder="you@example.com" value="{{ old('email') }}" required />
            </div>
            <div class="field">
                <label for="password">パスワード</label>
                <div class="password-row">
                    <input id="password" name="password" type="password" autocomplete="new-password" placeholder="パスワード" required minlength="8" />
                    <button type="button" class="toggle-visibility" aria-pressed="false" id="togglePwd" aria-label="パスワード表示切替">表示</button>
                </div>
            </div>
            <div class="field">
                <label for="confirm">パスワード確認</label>
                <input id="confirm" name="password_confirmation" type="password" autocomplete="new-password" placeholder="もう一度入力" required minlength="8" />
            </div>
            <div>
                <button class="primary" type="submit">登録</button>
                <div class="alt"><div class="divider">または</div></div>
            </div>
            <div class="note">すでにアカウントをお持ちですか？ <a href="{{ route('login') }}" style="color:var(--accent);font-weight:600">ログイン</a></div>
        </form>
        <footer class="small">© <span id="year">2025</span> My Product. All rights reserved.</footer>
    </section>
</main>
<script>
    document.getElementById('year').textContent = new Date().getFullYear();
    const toggle = document.getElementById('togglePwd');
    const pwd = document.getElementById('password');
    toggle.addEventListener('click', ()=>{
        const isPassword = pwd.type === 'password';
        pwd.type = isPassword ? 'text' : 'password';
        toggle.textContent = isPassword ? '非表示' : '表示';
        toggle.setAttribute('aria-pressed', String(isPassword));
    });
    // シンプルなクライアントバリデーション
    const form = document.getElementById('registerForm');
    form.addEventListener('submit',()=>{
        // HTML5 validity を活用
        if(!form.checkValidity()){
            e.preventDefault()
            const firstInvalid = form.querySelector(':invalid');
            if(firstInvalid) firstInvalid.focus();
            return false;
        }
    });
</script>
</body>
</html>

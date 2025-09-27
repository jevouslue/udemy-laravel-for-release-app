<!doctype html>
<html lang="ja">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width,initial-scale=1" />
    <title>パスワードリセット</title>
    <style>
        :root{
            --bg: #f6f8fb;
            --card: #ffffff;
            --accent: #2563eb;
            --error: #e60007;
            --muted: #6b7280;
            --radius: 12px;
            --glass: rgba(255,255,255,0.6);
            --shadow: 0 6px 24px rgba(20,25,35,0.08);
            font-family: Inter, ui-sans-serif, system-ui, -apple-system, "Helvetica Neue", "Yu Gothic", "Hiragino Kaku Gothic ProN", "Noto Sans JP", "Segoe UI", Roboto, "Arial";
        }

        *{box-sizing:border-box}
        html,body{height:100%}
        body{
            margin:0;
            background:linear-gradient(180deg,#eef2ff 0%,var(--bg) 60%);
            color:#0f172a;
            -webkit-font-smoothing:antialiased;
            -moz-osx-font-smoothing:grayscale;
            display:flex;
            align-items:center;
            justify-content:center;
            padding:16px;
        }
        a { color: var(--accent); }

        .wrap{
            min-width: 400px;
            max-width:980px;
            display:grid;
            grid-template-columns: 1fr;
            gap:28px;
            align-items:center;
        }
        @media only screen and (max-width: 600px) {
            .wrap {
                min-width: auto;
                width: 100%;
            }
        }

        .card{
            background:var(--card);
            border-radius:var(--radius);
            box-shadow:var(--shadow);
        }

        .message-box {
            padding: 16px 28px;
            background: #f0fdf4;
            border: 1px solid #00a63d;
            color: #00a63d;
        }

        .message-box p {margin: 0;}

        .hero{
            display:flex;
            flex-direction:column;
            gap:18px;
            padding:28px;
            min-height:360px;
        }

        .logo{
            display:flex;
            gap:12px;
            align-items:center;
        }

        .logo .mark{
            width:48px;height:48px;border-radius:10px;background:linear-gradient(135deg,var(--accent),#7c3aed);display:flex;align-items:center;justify-content:center;color:white;font-weight:700;font-size:12px;box-shadow:0 6px 18px rgba(37,99,235,0.18);
        }

        h1{margin:0;font-size:20px}
        p.lead{margin:0;color:var(--muted);line-height:1.45}

        .error-box {
            margin-bottom: 8px;
            border: 1px solid #ffa1a3;
            background: #fef2f3;
        }

        .text-error {
            color: var(--error);
            margin: 12px;
        }

        /* form */
        form{display:flex;flex-direction:column;gap:14px}

        label{font-size:13px;color:var(--muted);display:block;margin-bottom:6px}

        .field{
            display:flex;flex-direction:column;gap:6px
        }

        input[type="email"],input[type="password"],input[type="text"]{
            width:100%;padding:12px 14px;border-radius:10px;border:1px solid #e6e9ef;background:transparent;font-size:15px;outline:none;transition:box-shadow .15s,border-color .15s;
        }
        input:focus{box-shadow:0 6px 18px rgba(37,99,235,0.08);border-color:var(--accent)}
        input:user-invalid{box-shadow:0 6px 18px rgba(37,99,235,0.08);border-color:var(--error)}

        .password-row{position:relative;display:flex}
        .password-row input{flex:1}
        .toggle-visibility{
            position:absolute;right:8px;top:50%;transform:translateY(-50%);background:none;border:none;padding:8px;border-radius:8px;cursor:pointer;font-size:13px;color:var(--muted);
        }

        .row{display:flex;align-items:center;justify-content:space-between}
        .checkbox{display:flex;gap:8px;align-items:center}
        .checkbox input{width:16px;height:16px}
        .forgot{font-size:13px;color:var(--accent);text-decoration:none}

        button.primary{
            width: 100%;border:0;padding:12px 14px;border-radius:10px;background:linear-gradient(90deg,var(--accent),#7c3aed);color:white;font-weight:600;font-size:15px;cursor:pointer;box-shadow:0 8px 30px rgba(37,99,235,0.12);
        }

        .alt{
            display:flex;gap:10px;align-items:center;justify-content:center;margin-top:12px
        }

        .divider{display:flex;align-items:center;gap:10px;color:var(--muted);font-size:13px}
        .divider:before,.divider:after{content:"";height:1px;background:#e6e9ef;flex:1;border-radius:2px}

        .socials{display:flex;gap:10px}
        .socials button{flex:1;padding:10px;border-radius:10px;border:1px solid #e6e9ef;background:transparent;font-weight:600;cursor:pointer}

        .note{font-size:13px;color:var(--muted);text-align:center;margin-top:12px}
        footer.small{font-size:12px;color:var(--muted);text-align:center;margin-top:10px}
    </style>
</head>
<body>
<main class="wrap">
    @if(session()->has('success'))
        <div class="message-box card">
            <p>{{ session('success') }}</p>
        </div>
    @endif

    <section class="card hero" aria-labelledby="login-title">
        <div style="margin-top:8px">
            <h1 id="login-title">パスワードリセット</h1>
        </div>

        @if(session()->has('status'))
            <div class="message-box card">
                <p>{{ session('status') }}</p>
            </div>
        @endif

        @if($errors->any())
            <ul class="error-box">
                @foreach ($errors->all() as $error)
                    <li class="text-error">{{ $error }}</li>
                @endforeach
            </ul>
        @endif

        <form action="{{ route('password.email') }}" method="POST" id="resetPasswordForm" novalidate>
            @csrf
            <div class="field">
                <label for="email">メールアドレス</label>
                <input id="email" name="email" type="email" inputmode="email" autocomplete="email" placeholder="you@example.com" required value="{{ old('email') }}" />
            </div>

            <div>
                <button class="primary" type="submit" style="margin-top: 20px;">パスワードをリセット</button>
            </div>
        </form>

        <footer class="small">&copy; <span id="year">2025</span> Kent Koyama</footer>
    </section>
</main>

<script>
    // 年号を自動挿入
    document.getElementById('year').textContent = new Date().getFullYear();

    // シンプルなクライアントバリデーション
    const form = document.getElementById('resetPasswordForm');
    form.addEventListener('submit', (e)=>{
        // HTML5 validity を活用
        if(!form.checkValidity()){
            e.preventDefault()
            // フォーカス可能な最初の無効要素へ
            const firstInvalid = form.querySelector(':invalid');
            if(firstInvalid) firstInvalid.focus();
        }
    });
</script>
</body>
</html>

<!doctype html>
<html lang="ja">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width,initial-scale=1" />
    <title>メールアドレス確認</title>
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
            padding:32px;
        }
        a { color: var(--accent); }

        .wrap{
            max-width:980px;
            display:grid;
            grid-template-columns: 1fr;
            gap:28px;
            align-items:center;
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
        p.lead{margin:24px 0 22px;color:var(--muted);line-height:1.65}

        button.primary{
            width: 100%;border:0;padding:12px 14px;border-radius:10px;background:linear-gradient(90deg,var(--accent),#7c3aed);color:white;font-weight:600;font-size:15px;cursor:pointer;box-shadow:0 8px 30px rgba(37,99,235,0.12);
        }
        footer.small{font-size:12px;color:var(--muted);text-align:center;margin-top:10px}
    </style>
</head>
<body>
<main class="wrap">
    @if(session()->has('message'))
        <div class="message-box card">
            <p>{{ session('message') }}</p>
        </div>
    @endif

    <section class="card hero" aria-labelledby="login-title">
        <div class="logo">
            <div class="mark">ララ<br>くじ</div>
            <div>
                <div style="font-weight:700">特賞当ててハワイに行こう! - ララくじ</div>
                {{-- Todo: Udemyリンク、コース名--}}
                <div style="font-size:12px;color:var(--muted)">Udeｍyの <a href="#" target="_blank">Laravel リリース編：作ったサイトを公開しよう!</a>の教材用サイト</div>
            </div>
        </div>

        <div style="margin-top:8px">
            <h1 id="login-title">続行するにはメールアドレスの確認が必要です</h1>
            <p class="lead">登録されたメールアドレスに確認リンクを送信しました。<br>
                そちらにアクセスしメールアドレスの確認を完了してください<br>
                リンクは発行されてから{{ config('auth.verification.expire') }}分のみ有効です
            </p>
        </div>

        <form action="{{ route('verification.send') }}" method="POST">
            @csrf
            <button class="primary" type="submit">確認リンクの再送</button>
        </form>

        <footer class="small">&copy; <span id="year">2025</span> Kent Koyama</footer>
    </section>
</main>

<script>
    // 年号を自動挿入
    document.getElementById('year').textContent = new Date().getFullYear();
</script>
</body>
</html>

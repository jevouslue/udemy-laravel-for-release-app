<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>【しっかり身につける】PHP基礎の学習後に見てほしい Laravel入門（Laravel12対応）</title>
    <style>
        :root {
            --spacing: .25rem;
        }
        body { font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; color: #333; margin: 0; padding: 0; }
        .grid { display: grid; }
        .grid-cols-5 { grid-template-columns: repeat(5, minmax(0, 1fr)); }
        .gap-4 { gap: calc(var(--spacing) * 4); }
        .col-span-2 { grid-column: span 2 / span 2; }
        .col-span-3 { grid-column: span 3 / span 3; }
        .text-left { text-align: left }
        @media screen and (max-width: 768px) {
            .md\:grid-cols-1 { grid-template-columns: repeat(1, minmax(0, 1fr)); }
        }
        header { background: #222; color: #fff; padding: 2rem 1rem; text-align: center; position: relative; }
        header img { width: 100%; max-width: 600px; height: auto; margin: auto; display: block; border-radius: 8px; }
        header h1 { margin: 1rem 0 0.5rem; font-size: 1.4rem; }
        header p { margin: 1.5rem 0 2.5rem; font-size: 1rem; }
        header a { color: #c0c4fc; }

        header .enrollment { margin: 1rem 0; }
        header .meta {
            display: flex;
            gap: 1rem;
        }
        header .enrollment, header .published-date, header .last-update-date {
            display: inline-flex;
            align-items: center;
            gap: .5rem;
        }
        header .meta svg {
            color: #fff;
            inline-size: 1.6rem;
            block-size: 1.6rem;
            fill: currentColor;
            display: inline-block;
            flex-shrink: 0;
        }
        .bestseller { background: #c2e9eb; color: #165666; padding: 0.25rem .5rem;
            margin-right: .5rem; display: inline-block;  border-radius: 4px; }
        .cta a { background: #6d28d2; color: #fff; padding: 1rem 1.5rem; border: none; display: block; border-radius: 4px; font-size: 1.1rem; cursor: pointer; text-decoration: none; transition: .3s; }
        .cta a:hover { background: #882de1; }
        header .container, section { padding: 2rem 1rem; max-width: 800px; margin: auto; }
        h2 { border-bottom: 3px solid #222; padding-bottom: 0.3em; margin-bottom: 1em; }
        ul { list-style: disc inside; margin-left: 1em; }

        /* 追加CSS（既存の style タグ内に追記） */
        .review-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(260px, 1fr));
            gap: 1.5rem;
        }
        .review-card {
            background: #ffffff;
            border-radius: 10px;
            padding: 1.2rem;
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.08);
            position: relative;
            transition: transform 0.2s ease;
        }
        .review-card:hover {
            transform: translateY(-5px);
        }
        .avatar {
            width: 60px;
            height: 60px;
            border-radius: 50%;
            float: left;
            margin-right: 0.8rem;
        }
        .review-name {
            font-weight: bold;
            margin-top: 0.2rem;
        }
        .stars {
            color: #f1c40f;
            margin: 0.3rem 0;
            font-size: 1.1rem;
        }
        .review-card p {
            clear: both;
            margin-top: 0.5rem;
            line-height: 1.5;
        }


        .instructor-img { width: 150px; height: auto; border-radius: 50%; display: block; margin: 1rem auto; }
        footer { background: #f5f5f5; padding: 1rem; text-align: center; font-size: 0.9em; margin-top: 2rem; }


        /* stylelint-disable no-descending-specificity */
        .star-rating-module--star-wrapper {
            display: inline-flex;
            align-items: center;
        }
        .star-rating-module--star-wrapper svg {
            inline-size: 10rem;
            block-size: 2rem;
        }
        .star-rating-module--star-wrapper svg {
            inline-size: 2rem;
        }
        .star-rating-module--star-wrapper.star-rating-module--rating-number {
            line-height: 1;
        }
        .star-rating-module--star-wrapper.star-rating-module--medium > svg {
            display: block;
            inline-size: 7rem;
            block-size: 1.6rem;
        }
        .star-rating-module--star-filled {
            fill: oklch(62.76% 0.1418 61.45deg);
        }
        .star-rating-module--dark-background .star-rating-module--star-filled {
            fill: oklch(76.62% 0.166 68.76deg);
        }
        .star-rating-module--star-bordered {
            stroke: oklch(62.76% 0.1418 61.45deg);
        }
        .star-rating-module--dark-background .star-rating-module--star-bordered {
            stroke: oklch(76.62% 0.166 68.76deg);
        }
        .star-rating-module--rating-number {
            margin-inline-end: -0.4rem;
            color: oklch(46.68% 0.1161 51.53deg);
        }
        .star-rating-module--dark-background .star-rating-module--rating-number {
            color: oklch(0.77 0.17 68.71);
        }
    </style>
</head>
<body>
<svg aria-hidden="true" style="position: absolute; width: 0; height: 0; overflow: hidden;" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"><defs>
        <symbol id="icon-people" viewBox="0 -960 960 960"><path d="M71.93-276.62q0-30.92 15.96-55.19t42.63-37.76q57.02-27.89 114.67-43.01 57.66-15.11 126.73-15.11 69.08 0 126.73 15.11 57.66 15.12 114.68 43.01 26.67 13.49 42.63 37.76t15.96 55.19v28.16q0 24.15-17.73 42.46t-43.04 18.31H132.69q-25.3 0-43.03-17.73-17.73-17.74-17.73-43.04zm755.38 88.93h-90.85q7.54-13.77 11.5-29.31t3.96-31.46v-33.08q0-39.38-19.28-75.07-19.29-35.68-54.72-61.23 40.23 6 76.39 18.57 36.15 12.58 69 29.73 31 16.54 47.88 38.99 16.88 22.44 16.88 49.01v33.08q0 25.3-17.73 43.04-17.73 17.73-43.03 17.73M371.92-492.31q-57.75 0-98.87-41.12-41.12-41.13-41.12-98.88t41.12-98.87q41.12-41.13 98.87-41.13t98.88 41.13q41.12 41.12 41.12 98.87t-41.12 98.88q-41.13 41.12-98.88 41.12m345.38-140q0 57.75-41.12 98.88-41.12 41.12-98.87 41.12-6.77 0-17.23-1.54-10.47-1.54-17.23-3.38 23.66-28.45 36.37-63.12 12.7-34.67 12.7-72 0-37.34-12.96-71.73-12.96-34.38-36.11-63.3 8.61-3.08 17.23-4 8.61-.93 17.23-.93 57.75 0 98.87 41.13 41.12 41.12 41.12 98.87M131.92-247.69h480v-28.93q0-12.53-6.27-22.3-6.26-9.77-19.88-17.08-49.38-25.46-101.69-38.58-52.31-13.11-112.16-13.11-59.84 0-112.15 13.11-52.31 13.12-101.69 38.58-13.62 7.31-19.89 17.08t-6.27 22.3zm240-304.62q33 0 56.5-23.5t23.5-56.5-23.5-56.5-56.5-23.5-56.5 23.5-23.5 56.5 23.5 56.5 56.5 23.5m0-80"></path></symbol>
        <symbol id="icon-rating-star" viewBox="0 -960 960 960"><path d="m480-292.46-155.61 93.84q-8.7 5.08-17.43 4.27t-15.8-5.88q-7.08-5.08-10.93-13.27-3.84-8.19-1.23-18.12l41.31-176.69-137.38-118.92q-7.7-6.69-9.81-15.5-2.12-8.81 1.11-17.12 3.23-8.3 9.31-13.57t16.62-6.89l181.3-15.84L451.85-763q3.84-9.31 11.65-13.77t16.5-4.46 16.5 4.46T508.15-763l70.39 166.85 181.3 15.84q10.54 1.62 16.62 6.89t9.31 13.57q3.23 8.31 1.11 17.12-2.11 8.81-9.81 15.5L639.69-408.31 681-231.62q2.61 9.93-1.23 18.12-3.85 8.19-10.93 13.27-7.07 5.07-15.8 5.88t-17.43-4.27z"></path></symbol>
        <symbol id="icon-new" viewBox="0 -960 960 960"><path d="m336.39-112.69-55.31-93-104.62-22.47q-13.46-2.61-21.5-14.15t-6.42-25l10.23-107.61-71.15-81.39q-9.23-9.84-9.23-23.69t9.23-23.69l71.15-81.39-10.23-107.61q-1.62-13.46 6.42-25t21.5-14.15l104.62-22.47 55.31-93q7.23-11.84 19.69-16.15t25.31 1.31L480-820.46l98.61-41.69q12.85-5.62 25.31-1.31t19.69 16.15l55.31 93 104.62 22.47q13.46 2.61 21.5 14.15t6.42 25l-10.23 107.61 71.15 81.39q9.23 9.84 9.23 23.69t-9.23 23.69l-71.15 81.39 10.23 107.61q1.62 13.46-6.42 25t-21.5 14.15l-104.62 22.47-55.31 93q-7.23 11.84-19.69 16.15t-25.31-1.31L480-139.54l-98.61 41.69q-12.85 5.62-25.31 1.31t-19.69-16.15M378-162l102-43.23L583.23-162 640-258l110-25.23L740-396l74-84-74-85.23L750-678l-110-24-58-96-102 43.23L376.77-798 320-702l-110 24 10 112.77L146-480l74 84-10 114 110 24zm102-128.77q13.54 0 22.92-9.38 9.39-9.39 9.39-22.93T502.92-346q-9.38-9.38-22.92-9.38T457.08-346q-9.39 9.38-9.39 22.92t9.39 22.93q9.38 9.38 22.92 9.38m0-146.15q12.77 0 21.38-8.62 8.62-8.61 8.62-21.38v-180q0-12.77-8.62-21.39-8.61-8.61-21.38-8.61t-21.38 8.61q-8.62 8.62-8.62 21.39v180q0 12.77 8.62 21.38 8.61 8.62 21.38 8.62"></path></symbol>
        <symbol id="icon-schedule" viewBox="0 -960 960 960"><path d="M510-492.15V-650q0-12.75-8.63-21.38-8.63-8.62-21.38-8.62-12.76 0-21.37 8.62Q450-662.75 450-650v167.08q0 7.06 2.62 13.68 2.61 6.62 8.23 12.24l137 137q8.3 8.31 20.88 8.5T640-320t8.69-21.08q0-12.38-8.69-21.07zM480.07-100q-78.84 0-148.21-29.92t-120.68-81.21-81.25-120.63Q100-401.1 100-479.93q0-78.84 29.92-148.21t81.21-120.68 120.63-81.25Q401.1-860 479.93-860q78.84 0 148.21 29.92t120.68 81.21 81.25 120.63Q860-558.9 860-480.07q0 78.84-29.92 148.21t-81.21 120.68-120.63 81.25Q558.9-100 480.07-100m-.07-60q133 0 226.5-93.5T800-480t-93.5-226.5T480-800t-226.5 93.5T160-480t93.5 226.5T480-160"></path></symbol>
    </defs></svg>
<header>
    <div class="grid md:grid-cols-1 grid-cols-5 gap-4 container">
        <div class="col-span-3 text-left">
            <h1>【しっかり身につける】<br>PHP基礎の学習後に見てほしい Laravel入門（Laravel12対応）</h1>
            <p>実務をする前に習得すべきLaravelを使った効率的で安全な開発</p>
            <div>
                <div class="bestseller">Bestseller</div>
                <span class="star-rating-module--star-wrapper star-rating-module--medium star-rating-module--dark-background">
                    <span class="star-rating-module--rating-number" aria-hidden="true" data-purpose="rating-number">4.5</span>
                    <svg aria-hidden="true" width="100%" height="100%" viewBox="0 0 52 14" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <mask id="u62-star-rating-mask--3" data-purpose="star-rating-mask"><rect x="0" y="0" width="90%" height="100%" fill="white"></rect></mask>
                        <g class="star-rating-module--star-filled" mask="url(#u62-star-rating-mask--3)" data-purpose="star-filled">
                            <use xlink:href="#icon-rating-star" width="14" height="14" x="0"></use>
                            <use xlink:href="#icon-rating-star" width="14" height="14" x="10"></use>
                            <use xlink:href="#icon-rating-star" width="14" height="14" x="20"></use>
                            <use xlink:href="#icon-rating-star" width="14" height="14" x="30"></use>
                            <use xlink:href="#icon-rating-star" width="14" height="14" x="40"></use>
                        </g>
                        <g fill="transparent" class="star-rating-module--star-bordered" stroke-width="80" data-purpose="star-bordered">
                            <use xlink:href="#icon-rating-star" width="12" height="12" x="1" y="1"></use>
                            <use xlink:href="#icon-rating-star" width="12" height="12" x="11" y="1"></use>
                            <use xlink:href="#icon-rating-star" width="12" height="12" x="21" y="1"></use>
                            <use xlink:href="#icon-rating-star" width="12" height="12" x="31" y="1"></use>
                            <use xlink:href="#icon-rating-star" width="12" height="12" x="41" y="1"></use>
                        </g>
                    </svg>
                </span>
                <a href="#reviews">(556 ratings)</a>
            </div>
            <div class="meta">
                <div class="enrollment"><svg aria-hidden="true" focusable="false" class="ud-icon ud-icon-medium"><use xlink:href="#icon-people"></use></svg><span>3,389</span></div>

                <div class="published-date"><svg><use xlink:href="#icon-schedule"></use></svg><span>Published 2022/03</span></div>
                <div class="last-update-date"><svg><use xlink:href="#icon-new"></use></svg><span>Last updated 2025/6</span></div>
            </div>
        </div>
        <div class="grid col-span-2 gap-4">
            <img src="https://img-c.udemycdn.com/course/750x422/4602110_2829_4.jpg" alt="Laravel 入門">

            <div class="cta">
                <a href="https://www.udemy.com/course/laravel9/?referralCode=2C87AF8B5825D3BF9606">今すぐ受講する</a>
            </div>
        </div>
    </div>
</header>

<section>
    <h2>この講座で学べる内容</h2>
    <ul>
        <li>Docker環境での開発準備から本格的なアプリ開発まで</li>
        <li>MySQL を用いたリレーショナルデータベース設計</li>
        <li>認証システムやセキュリティ対策を理解し実装</li>
        <li>ねこカフェをテーマにしたサイト構築（ブログ、お問い合わせ機能など）</li>
        <li>WordPress風管理画面によるコンテンツ管理機能の構築</li>
    </ul>
</section>

<section>
    <h2>受講対象</h2>
    <ul>
        <li>HTMLおよびPHPの基礎（変数・関数・クラス・名前空間など）が理解できている方</li>
        <li>Laravelを効率的に学び、実務で活用したい方</li>
    </ul>
</section>

<section>
    <h2>講座概要</h2>
    <p>この講座では、PHP基礎を学んだ方向けに、Laravel12をメインとして実務で役立つスキルを学べるよう設計されています。Docker環境構築からデータベース連携、認証、セキュリティ対策まで丁寧にサポート。Mac／Windows両環境対応で、実務を見据えたスキル習得が可能です。さらに、講師による迅速なQ&A対応も高評価のポイントです。</p>
</section>

<section>
    <h2>講師紹介</h2>
    <img src="https://img-c.udemycdn.com/user/200_H/96827346_7f68_2.jpg" alt="講師・Kent Koyama" class="instructor-img">
    <p><strong>Kent Koyama</strong>（講師）</p>
    <p>ウェブ制作やシステム開発（鉄道・百貨店など）の現場経験をもち、現在はフリーランス兼プログラミング講師として活動。実務で使えるスキルの習得と学習者の成長を重視する教育スタイルです。</p>
</section>

<section id="reviews">
    <h2>受講者の声</h2>
    <div class="review-grid">
        <div class="review-card">
            <img src="https://via.placeholder.com/60x60?text=Y" alt="山田さんのアイコン" class="avatar">
            <div class="review-name">山田 太郎 さん</div>
            <div class="stars">★★★★★</div>
            <p><strong>「Docker導入から認証まで、一貫して学べて実務感覚が身につきました。」</strong></p>
        </div>
        <div class="review-card">
            <img src="https://via.placeholder.com/60x60?text=H" alt="佐藤さんのアイコン" class="avatar">
            <div class="review-name">佐藤 花子 さん</div>
            <div class="stars">★★★★☆</div>
            <p>「講師のレスポンスが早く、<strong>疑問を即解決</strong>できたのが助かりました。」</p>
        </div>
        <div class="review-card">
            <img src="https://via.placeholder.com/60x60?text=J" alt="鈴木さんのアイコン" class="avatar">
            <div class="review-name">鈴木 次郎 さん</div>
            <div class="stars">★★★★★</div>
            <p>「セキュリティの説明がとてもクリアで、学びに深みが出ました。」</p>
        </div>
        <div class="review-card">
            <img src="https://via.placeholder.com/60x60?text=S" alt="高橋さんのアイコン" class="avatar">
            <div class="review-name">高橋 三郎 さん</div>
            <div class="stars">★★★★☆</div>
            <p>「学びの順序が自然で、<strong>迷うことなく</strong>最後まで進めました。」</p>
        </div>
    </div>
</section>

<footer>
    <p>&copy; 2025 Kent Koyama</p>
</footer>

</body>
</html>

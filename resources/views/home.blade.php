<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ガラガラ抽選アプリ</title>
    <style>
        body {
            margin: 0;
            padding: 20px;
            background: linear-gradient(135deg, #ff9a9e 0%, #fecfef 50%, #fecfef 100%);
            font-family: 'Arial', sans-serif;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            overflow-x: hidden;
        }

        .lottery-container {
            text-align: center;
            background: rgba(255, 255, 255, 0.95);
            padding: 40px;
            border-radius: 30px;
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.1);
            max-width: 700px;
            width: 100%;
        }

        h1 {
            color: #d63384;
            font-size: 2.5em;
            margin-bottom: 30px;
            text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.1);
        }

        @media screen and (max-width: 768px) {
            h1 {
                font-size: 1.8em;
            }
        }

        .garagara-machine {
            position: relative;
            margin: 0 auto 30px;
            width: 500px;
            height: 330px;
            perspective: 800px;
        }

        @media screen and (max-width: 768px) {
            .garagara-machine {
                width: auto;
                height: 306px;
            }
        }

        /* 木製台座 */
        .base {
            position: absolute;
            top: 270px;
            left: 50%;
            transform: translateX(-50%);
            width: min(450px, 100%);
            height: 30px;
            background: linear-gradient(to bottom, #deb887, #d2b48c, #bc9a6a);
            border: 2px solid #8b7355;
            border-radius: 8px;
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.3);
        }

        .base::before {
            content: '';
            position: absolute;
            top: -8px;
            left: 5px;
            right: 5px;
            height: 15px;
            background: linear-gradient(to bottom, #f4e4bc, #deb887);
            border: 2px solid #8b7355;
            border-bottom: none;
            border-radius: 6px 6px 0 0;
        }

        /* 金属フレーム（右側） */
        .support {
            z-index: 6;
            position: absolute;
            top: 130px;
            right: 50%;
            transform: translateX(50%);
            width: 80px;
            height: 130px;
            background: linear-gradient(45deg, #b0b0b0, #d0d0d0, #a0a0a0);
            clip-path: polygon(0 100%, 30% 0%, 70% 0%, 100% 100%);
            border: 2px solid #808080;
            box-shadow: -2px 2px 8px rgba(0, 0, 0, 0.2);
        }

        /* 六角形ドラム */
        .drum {
            position: absolute;
            top: 70px;
            left: 50%;
            transform: translateX(-50%);
            width: 160px;
            height: 140px;
            background: linear-gradient(135deg, #cd7f32, #d2691e, #b8860b);
            clip-path: polygon(25% 0%, 75% 0%, 100% 50%, 75% 100%, 25% 100%, 0% 50%);
            border: 3px solid #8b4513;
            box-shadow:
                inset 0 0 20px rgba(0, 0, 0, 0.2),
                0 5px 15px rgba(0, 0, 0, 0.3);
            transition: transform 0.1s ease-out;
            z-index: 5;
        }

        .drum.spinning {
            animation: drumSpin 3s cubic-bezier(0.25, 0.46, 0.45, 0.94);
        }

        @keyframes drumSpin {
            0% { transform: translateX(-50%) rotateZ(0deg); }
            100% { transform: translateX(-50%) rotateZ(900deg); }
        }

        /* ドラム内部の線 */
        .drum::before {
            content: '';
            position: absolute;
            top: 20px;
            left: 20px;
            right: 20px;
            bottom: 20px;
            clip-path: polygon(30% 10%, 70% 10%, 90% 50%, 70% 90%, 30% 90%, 10% 50%);
            border: 2px solid #8b4513;
            opacity: 0.6;
        }

        /* 中心軸 */
        .center-axis {
            position: absolute;
            top: 135px;
            left: 50%;
            transform: translateX(-50%);
            width: 20px;
            height: 20px;
            background: radial-gradient(circle, #808080, #606060);
            border-radius: 50%;
            border: 2px solid #404040;
            z-index: 10;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.3);
        }

        /* ハンドル軸（水平部分） */
        .handle-axis {
            position: absolute;
            top: 140px;
            left: 50%;
            width: 100px;
            height: 10px;
            background: linear-gradient(to right, #808080, #a0a0a0, #808080);
            border: 2px solid #606060;
            border-radius: 5px;
            transform-origin: left center;
            z-index: 6;
        }

        /* ハンドル（垂直部分） */
        .handle {
            transform-origin: 50% 5px;
            position: absolute;
            right: 3px;
            top: 0;
            width: 12px;
            height: 45px;
            background: linear-gradient(to bottom, #8b4513, #a0522d, #8b4513);
            border: 2px solid #654321;
            border-radius: 6px;
            cursor: pointer;
            transition: scale 0.3s
            ease;
            box-shadow: 2px 2px 6px rgba(0, 0, 0, 0.3);
            z-index: 7;
            transform: rotate(5deg);
        }

        .handle:hover {
            background: linear-gradient(to bottom, #a0522d, #cd853f, #a0522d);
            scale: 1.05;
            box-shadow: 2px 2px 8px rgba(0, 0, 0, 0.4);
        }

        .handle:active {
            scale: 0.95;
        }

        /* ハンドルグリップ */
        .handle::after {
            content: '';
            position: absolute;
            bottom: -8px;
            left: 50%;
            transform: translateX(-50%);
            width: 20px;
            height: 10px;
            background: linear-gradient(to right, #654321, #8b4513);
            border: 1px solid #654321;
            border-radius: 5px;
        }

        /* 出口部分 */
        .output-tray {
            position: absolute;
            top: 250px;
            left: 72%;
            transform: translateX(-50%);
            width: 100px;
            height: 10px;
            background: linear-gradient(to bottom, #c0c0c0, #a0a0a0);
            border: 2px solid #808080;
            border-radius: 10px;
            z-index: 8;

            @media screen and (max-width: 768px) {
                left: 80%;
            }
        }

        /* 玉 */
        .ball {
            position: absolute;
            width: 25px;
            height: 25px;
            border-radius: 50%;
            font-size: 10px;
            font-weight: bold;
            color: white;
            display: flex;
            align-items: center;
            justify-content: center;
            opacity: 0;
            z-index: 1;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.3);
        }

        .ball.rolling {
            animation: rollOut 1.5s ease-out forwards;
        }

        @keyframes rollOut {
            0% {
                opacity: 1;
                left: 300px;
                top: 170px;
                transform: rotate(0deg);
            }
            20% {
                left: 310px;
                top: 165px;
                transform: rotate(120deg);
            }
            40% {
                left: 320px;
                top: 225px;
                transform: rotate(300deg);
            }
            100% {
                opacity: 1;
                left: 370px;
                top: 225px;
                transform: rotate(750deg) scale(1.3);
            }
        }

        @media screen and (max-width: 768px) {
            @keyframes rollOut {
                0% {
                    opacity: 1;
                    left: 62%;
                    top: 57%;
                    transform: rotate(0deg);
                }
                20% {
                    left: 68%;
                    top: 56%;
                    transform: rotate(120deg);
                }
                40% {
                    left: 77%;
                    top: 74%;
                    transform: rotate(300deg);
                }
                100% {
                    opacity: 1;
                    left: 86%;
                    top: 74%;
                    transform: rotate(750deg) scale(1.3);
                }
            }
        }
        .spin-button {
            background: linear-gradient(45deg, #ff6b6b, #ee5a24);
            color: white;
            border: none;
            padding: 15px 40px;
            font-size: 1.2em;
            border-radius: 25px;
            cursor: pointer;
            transition: all 0.3s ease;
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2);
            margin: 20px;

            @media screen and (max-width: 768px) {
                margin: 0;
            }
        }

        .spin-button:hover {
            transform: translateY(-2px);
            box-shadow: 0 12px 20px rgba(0, 0, 0, 0.3);
        }

        .spin-button:disabled {
            background: #ccc;
            cursor: not-allowed;
            transform: none;
            box-shadow: none;
        }

        .result {
            margin-top: 30px;
            padding: 20px;
            background: linear-gradient(45deg, #f093fb 0%, #f5576c 100%);
            border-radius: 15px;
            color: white;
            font-size: 1.5em;
            font-weight: bold;
            opacity: 0;
            transform: translateY(20px);
            transition: all 0.5s ease;

            @media screen and (max-width: 768px) {
                font-size: 1.2em;
            }
        }

        .result.show {
            opacity: 1;
            transform: translateY(0);
        }

        .prizes {
            margin-top: 20px;
            background: rgba(255, 255, 255, 0.7);
            border-radius: 10px;
        }

        .prize-item {
            display: inline-block;
            margin: 5px;
            padding: 8px 15px;
            background: #fff;
            border-radius: 20px;
            font-size: 0.9em;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }
    </style>
</head>
<body>
<div class="lottery-container">
    <h1>🎊 ガラガラ抽選 🎊</h1>

    <div class="prizes">
        <h3>景品一覧</h3>
        <div class="prize-item">🏆 特等: 商品券 10,000円</div>
        <div class="prize-item">🥇 1等: 商品券 5,000円</div>
        <div class="prize-item">🥈 2等: 商品券 1,000円</div>
        <div class="prize-item">🥉 3等: お菓子セット</div>
        <div class="prize-item">🎁 4等: ティッシュ</div>
        <div class="prize-item">😅 残念: また挑戦してね</div>
    </div>

    <div class="garagara-machine">
        <div class="base"></div>
        <div class="support"></div>
        <div class="drum" id="drum"></div>
        <div class="center-axis"></div>
        <div class="handle-axis" id="handleAxis">
            <div class="handle" id="handle"></div>
        </div>
        <div class="output-tray"></div>
        <div class="ball" id="ball"></div>
    </div>

    <button class="spin-button" id="spinButton">ハンドルを回す！</button>

    <div class="result" id="result"></div>
</div>

<script>
    const prizes = [
        { title: '🏆 特等: 商品券 10,000円', color: '#FFD700', weight: 1 },
        { title: '🥇 1等: 商品券 5,000円', color: '#C0C0C0', weight: 3 },
        { title: '🥈 2等: 商品券 1,000円', color: '#CD7F32', weight: 8 },
        { title: '🥉 3等: お菓子セット', color: '#FF69B4', weight: 15 },
        { title: '🎁 4等: ティッシュ', color: '#87CEEB', weight: 25 },
        { title: '😅 残念: また挑戦してね', color: '#BBBBBB', weight: 48 }
    ];

    let isSpinning = false;

    function getRandomPrize() {
        const totalWeight = prizes.reduce((sum, prize) => sum + prize.weight, 0);
        let random = Math.random() * totalWeight;

        for (let prize of prizes) {
            random -= prize.weight;
            if (random <= 0) {
                return prize;
            }
        }
        return prizes[prizes.length - 1];
    }

    function spinLottery() {
        if (isSpinning) return;

        isSpinning = true;
        const spinButton = document.getElementById('spinButton');
        const drum = document.getElementById('drum');
        const ball = document.getElementById('ball');
        const result = document.getElementById('result');
        const handleAxis = document.getElementById('handleAxis');
        const handle = document.getElementById('handle');

        spinButton.disabled = true;
        result.classList.remove('show');
        ball.classList.remove('rolling');

        // ハンドルとハンドル軸の回転アニメーション
        handleAxis.style.transform = 'rotate(360deg)';
        handleAxis.style.transition = 'transform 1.0s cubic-bezier(.44,.03,.22,.58)';
        handle.style.transform = 'rotate(-355deg)';
        handle.style.transition = 'transform 1.0s cubic-bezier(.44,.03,.22,.58)';

        setTimeout(() => {
            handleAxis.style.transform = 'rotate(0deg)';
            handleAxis.style.transition = '';
            handle.style.transform = 'rotate(5deg)';
            handle.style.transition = '';
        }, 1000);

        setTimeout(() => {
            // ドラム回転
            drum.classList.add('spinning');
        }, 150);


        // 景品決定
        const selectedPrize = getRandomPrize();

        setTimeout(() => {

            // 玉の設定と転がりアニメーション
            ball.style.background = `radial-gradient(circle at 30% 30%, ${selectedPrize.color}, ${selectedPrize.color}dd)`;
            ball.textContent = selectedPrize.title.split(':')[0].split(' ')[1] || '？';
            ball.classList.add('rolling');

            setTimeout(() => {
                drum.classList.remove('spinning');
                result.textContent = selectedPrize.title;
                result.classList.add('show');

                setTimeout(() => {
                    spinButton.disabled = false;
                    isSpinning = false;
                }, 300);
            }, 3000);
        }, 2700);
    }

    // イベントリスナー
    document.getElementById('spinButton').addEventListener('click', spinLottery);
    document.getElementById('handle').addEventListener('click', spinLottery);
</script>
</body>
</html>

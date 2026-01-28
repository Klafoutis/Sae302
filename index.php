<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>HORIZONS | Defined by Place</title>
    
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300;400;500;600;800&family=Playfair+Display:ital,wght@0,400;0,700;1,400&family=Share+Tech+Mono&display=swap" rel="stylesheet">
    
    <!-- Libraries -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://unpkg.com/lucide@latest"></script>

    <style>
        /* --- VARIABLES & RESET --- */
        :root {
            --bg-color: #0a0a0a;
            --text-main: #f0f0f0;
            --metal-light: #e0e0e0;
            --metal-dark: #444;
            --glass-shine: rgba(255, 255, 255, 0.8);
            
            /* Emotional Colors */
            --color-north: #00ced1; /* Cyan - Hope/Return */
            --color-south: #cd853f; /* Ochre - Roots */
            --color-east: #ffe600;  /* Gold - Ambition */
            --color-west: #ff4d4d;  /* Red - The Barrier */
        }

        body, html {
            margin: 0;
            padding: 0;
            width: 100%;
            height: 100%;
            overflow: hidden;
            background-color: var(--bg-color);
            color: var(--text-main);
            font-family: 'Montserrat', sans-serif;
            cursor: none; /* Custom cursor */
            opacity: 1; 
            transition: opacity 0.5s ease;
        }

        /* --- IMMERSIVE BACKGROUND --- */
        .immersive-bg {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            z-index: 0;
            /* Darkened background image - using a high-res placeholder if original is local */
            background: 
                linear-gradient(to bottom, rgba(10,10,10,0.7), rgba(10,10,10,0.85)),
                url('https://images.unsplash.com/photo-1451187580459-43490279c0fa?q=80&w=2072&auto=format&fit=crop');
            background-size: cover;
            background-position: center;
            opacity: 0.6;
            transition: opacity 1s ease;
        }

        /* Spotlight Effect */
        .spotlight {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            pointer-events: none;
            z-index: 1;
            background: radial-gradient(
                circle at var(--x, 50%) var(--y, 50%), 
                rgba(255, 255, 255, 0.06) 0%, 
                rgba(10, 10, 10, 0.95) 45%, 
                rgba(10, 10, 10, 1) 100%
            );
            mix-blend-mode: hard-light;
        }

        /* --- UI CONTAINER --- */
        .ui-layer {
            position: relative;
            z-index: 10;
            width: 100%;
            height: 100%;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            align-items: center;
            padding: 0 2rem 1.5rem 2rem;
            box-sizing: border-box;
        }

        /* --- TYPOGRAPHY --- */
        .header-content {
            display: flex;
            flex-direction: column;
            align-items: center;
            margin-top: 2vh;
        }

        .main-title {
            font-family: 'Playfair Display', serif;
            font-size: clamp(3rem, 8vw, 6rem);
            letter-spacing: 0.2em;
            text-transform: uppercase;
            background: linear-gradient(to bottom, #fff, #999);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            text-shadow: 0 10px 30px rgba(0,0,0,0.5);
            margin-bottom: 0.5rem;
            animation: fadeInDown 2s ease-out;
            line-height: 1;
        }

        .profiles-tag {
            font-size: 0.75rem;
            text-transform: uppercase;
            letter-spacing: 0.3em;
            color: var(--color-south);
            margin-bottom: 0.5rem;
            opacity: 0.8;
            animation: fadeIn 2s ease-out 1s backwards;
        }

        .subtitle {
            font-size: clamp(0.9rem, 1.5vw, 1.1rem);
            font-weight: 300;
            letter-spacing: 0.05em;
            color: rgba(240, 240, 240, 0.8);
            text-align: center;
            animation: fadeInUp 2s ease-out 0.5s backwards;
        }

        /* --- COMPASS --- */
        .compass-container {
            position: relative;
            width: min(350px, 80vw);
            height: min(350px, 80vw);
            display: flex;
            justify-content: center;
            align-items: center;
            margin: 2rem 0;
        }

        /* Metallic Ring */
        .compass-ring {
            position: absolute;
            width: 100%;
            height: 100%;
            border-radius: 50%;
            border: 1px solid rgba(255,255,255,0.1);
            box-shadow: 
                0 0 50px rgba(0,0,0,0.8),
                inset 0 0 30px rgba(0,0,0,0.9),
                0 0 0 2px rgba(255,255,255,0.05);
            background: radial-gradient(circle, rgba(20,20,20,0.9) 0%, rgba(5,5,5,1) 100%);
            transition: all 0.5s ease;
        }
        
        /* Glow Effects */
        .compass-ring.glow-n { border-color: var(--color-north); box-shadow: 0 0 15px var(--color-north), inset 0 0 20px rgba(0, 206, 209, 0.2); }
        .compass-ring.glow-s { border-color: var(--color-south); box-shadow: 0 0 15px var(--color-south), inset 0 0 20px rgba(205, 133, 63, 0.2); }
        .compass-ring.glow-e { border-color: var(--color-east); box-shadow: 0 0 15px var(--color-east), inset 0 0 20px rgba(255, 230, 0, 0.2); }
        .compass-ring.glow-w { border-color: var(--color-west); box-shadow: 0 0 15px var(--color-west), inset 0 0 20px rgba(255, 77, 77, 0.2); }
        
        .compass-ticks {
            position: absolute;
            width: 90%;
            height: 90%;
            border-radius: 50%;
            border: 1px dashed rgba(255,255,255,0.1);
        }

        /* Needle */
        .needle-wrapper {
            position: absolute;
            width: 100%;
            height: 100%;
            display: flex;
            justify-content: center;
            align-items: center;
            will-change: transform; 
        }

        .needle {
            width: 4px;
            height: 74%; /* Relative to container */
            position: relative;
            background: transparent;
        }

        /* North Tip (White) */
        .needle::before {
            content: '';
            position: absolute;
            top: 0;
            left: 50%;
            transform: translateX(-50%);
            width: 0; 
            height: 0; 
            border-left: 6px solid transparent;
            border-right: 6px solid transparent;
            border-bottom: 130px solid rgba(255, 255, 255, 0.95);
            filter: drop-shadow(0 0 8px rgba(255,255,255,0.6));
        }

        /* South Tip (Dark) */
        .needle::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 50%;
            transform: translateX(-50%);
            width: 0; 
            height: 0; 
            border-left: 6px solid transparent;
            border-right: 6px solid transparent;
            border-top: 130px solid #333;
        }
        
        /* Pivot */
        .pivot {
            position: absolute;
            width: 16px;
            height: 16px;
            background: radial-gradient(circle at 30% 30%, #fff, #666);
            border-radius: 50%;
            box-shadow: 0 2px 5px rgba(0,0,0,0.5);
            z-index: 10;
        }

        /* --- CARDINAL POINTS & PROFILES --- */
        .cardinal-point {
            position: absolute;
            font-family: 'Playfair Display', serif;
            font-size: 1.5rem;
            color: rgba(255,255,255,0.3);
            transition: all 0.4s cubic-bezier(0.25, 0.46, 0.45, 0.94);
            cursor: pointer;
            text-align: center;
            display: flex;
            justify-content: center;
            align-items: center;
            z-index: 20;
            padding: 30px; /* Larger hit area */
        }

        .point-n { top: -75px; left: 50%; transform: translateX(-50%); }
        .point-s { bottom: -75px; left: 50%; transform: translateX(-50%); }
        .point-e { right: -80px; top: 50%; transform: translateY(-50%); }
        .point-w { left: -80px; top: 50%; transform: translateY(-50%); }

        /* Labels */
        .label-text {
            font-family: 'Montserrat', sans-serif;
            font-size: 0.8rem;
            text-transform: uppercase;
            letter-spacing: 0.1em;
            opacity: 0;
            position: absolute;
            white-space: nowrap;
            font-weight: 600;
            transition: all 0.4s ease;
            pointer-events: none;
            text-align: center;
            line-height: 1.4;
        }
        
        .label-sub {
            display: block;
            font-size: 0.65rem;
            font-weight: 300;
            opacity: 0.8;
            text-transform: none;
            letter-spacing: 0;
            font-style: italic;
        }

        /* --- LABEL POSITIONING --- */
        /* North */
        .point-n .label-text { bottom: 65%; transform: translateY(10px); }
        .point-n:hover .label-text { opacity: 1; transform: translateY(-5px); color: var(--color-north); }
        
        /* South */
        .point-s .label-text { top: 65%; transform: translateY(-10px); }
        .point-s:hover .label-text { opacity: 1; transform: translateY(5px); color: var(--color-south); }

        /* East */
        .point-e .label-text { left: 80%; transform: translateX(-10px); text-align: left;}
        .point-e:hover .label-text { opacity: 1; transform: translateX(10px); color: var(--color-east); }

        /* West */
        .point-w .label-text { right: 80%; transform: translateX(10px); text-align: right; }
        .point-w:hover .label-text { opacity: 1; transform: translateX(-10px); color: var(--color-west); }

        /* Hover Colors */
        .point-n:hover { color: var(--color-north); text-shadow: 0 0 20px var(--color-north); }
        .point-s:hover { color: var(--color-south); text-shadow: 0 0 20px var(--color-south); }
        .point-e:hover { color: var(--color-east); text-shadow: 0 0 20px var(--color-east); }
        .point-w:hover { color: var(--color-west); text-shadow: 0 0 20px var(--color-west); }

        /* --- FOOTER INSTRUCTION --- */
        .instruction {
            font-size: 0.75rem;
            color: #888;
            letter-spacing: 0.15em;
            text-transform: uppercase;
            margin-bottom: 0.5rem;
            opacity: 0;
            animation: fadeIn 3s ease-out 1.5s forwards;
            text-align: center;
        }

        /* --- ANIMATIONS --- */
        @keyframes fadeInDown {
            from { opacity: 0; transform: translateY(-30px); }
            to { opacity: 1; transform: translateY(0); }
        }
        @keyframes fadeInUp {
            from { opacity: 0; transform: translateY(30px); }
            to { opacity: 1; transform: translateY(0); }
        }
        @keyframes fadeIn {
            to { opacity: 1; }
        }

        /* Custom Cursor Dot */
        .cursor-dot {
            width: 8px;
            height: 8px;
            background-color: white;
            border-radius: 50%;
            position: fixed;
            pointer-events: none;
            z-index: 9999;
            mix-blend-mode: difference;
            transform: translate(-50%, -50%);
            transition: width 0.3s, height 0.3s;
        }

        /* Mobile tweaks */
        @media (max-width: 600px) {
            .main-title { font-size: 3rem; }
            .subtitle { font-size: 0.9rem; padding: 0 1rem; }
            .point-n .label-text { bottom: 85%; }
            .point-s .label-text { top: 85%; }
            .point-e .label-text { left: 60%; }
            .point-w .label-text { right: 60%; }
        }
    </style>
</head>
<body>

    <div class="immersive-bg"></div>
    <div class="spotlight" id="spotlight"></div>
    
    <div class="cursor-dot" id="cursor-dot"></div>
    <nav class="fixed top-0 left-0 w-full z-50 flex justify-end items-center px-6 py-6 pointer-events-none">
        
        <a href="final.php" class="pointer-events-auto flex items-center gap-3 px-5 py-3 bg-[#0a0a0a]/60 backdrop-blur-xl border border-white/10 rounded-full text-[#f0f0f0] hover:text-[#cd853f] hover:border-[#cd853f]/50 transition-all duration-300 group shadow-lg hover:shadow-[0_0_15px_rgba(205,133,63,0.2)]">
            <span class="font-medium text-xs tracking-[0.2em] uppercase hidden md:block opacity-90 group-hover:opacity-100">Final Page</span>
            <div class="p-1 rounded-full bg-white/5 group-hover:bg-[#cd853f]/10 transition-colors group-hover:translate-x-1 transition-transform duration-500">
                <i data-lucide="arrow-right" width="16"></i>
            </div>
        </a>
    </nav>
    <div class="ui-layer">
        
        <header class="header-content">
            <h1 class="main-title">Horizons</h1>
            <div class="profiles-tag">4 Paths &bull; 4 Profiles</div>
            <p class="subtitle">Was your future decided on the day you were born somewhere?</p>
        </header>

        <div class="compass-container" id="compassContainer">
            <div class="compass-ring" id="compassRing"></div>
            <div class="compass-ticks"></div>
            
            <!-- NORTH: Revenir / Le Sens -->
            <div class="cardinal-point point-n" data-angle="0" data-link="module/north.php" data-dir="n">
                <span>N</span>
                <span class="label-text">
                    Profile : Marc The Freedman
                    <span class="label-sub">Finding purpose in coming back</span>
                </span>
            </div>
            
            <!-- EAST: Partir / L'Ambition -->
            <div class="cardinal-point point-e" data-angle="90" data-link="module/east.php" data-dir="e">
                <span>E</span>
                <span class="label-text">
                    Profile : Clément The Dreamer
                    <span class="label-sub">Leaving to chase ambition</span>
                </span>
            </div>
            
            <!-- SOUTH: Rester / Les Racines -->
            <div class="cardinal-point point-s" data-angle="180" data-link="module/south.php" data-dir="s">
                <span>S</span>
                <span class="label-text">
                    Profile : Chloé The Confident
                    <span class="label-sub">Staying rooted in tradition</span>
                </span>
            </div>
            
            <!-- WEST: Subir / La Barrière -->
            <div class="cardinal-point point-w" data-angle="270" data-link="module/west.php" data-dir="w">
                <span>W</span> 
                <span class="label-text">
                    Profile : Sarah The Outsider
                    <span class="label-sub">Enduring the barriers</span>
                </span>
            </div>

            <div class="needle-wrapper" id="needle">
                <div class="needle"></div>
            </div>
            <div class="pivot"></div>
        </div>

        <div class="instruction">
            Select a cardinal point to explore a life profile
        </div>
    </div>

    <script>
        lucide.createIcons();
        // --- BFCache Fix ---
        window.addEventListener('pageshow', function(event) {
            document.body.style.transition = 'none';
            document.body.style.opacity = '1';
            setTimeout(() => {
                document.body.style.transition = 'opacity 1s ease-in-out';
            }, 100);
        });

        // --- CONFIG ---
        const lerpFactor = 0.08; 
        const magnetStrength = 0.2; 

        // --- DOM ELEMENTS ---
        const needle = document.getElementById('needle');
        const compassContainer = document.getElementById('compassContainer');
        const compassRing = document.getElementById('compassRing'); 
        const spotlight = document.getElementById('spotlight');
        const cursorDot = document.getElementById('cursor-dot');
        const cardinalPoints = document.querySelectorAll('.cardinal-point');

        // --- STATE ---
        let mouseX = window.innerWidth / 2;
        let mouseY = window.innerHeight / 2;
        let currentRotation = 0;
        let targetRotation = 0;
        let isMagnetized = false;
        let magnetAngle = 0;

        // --- MOUSE TRACKING ---
        document.addEventListener('mousemove', (e) => {
            mouseX = e.clientX;
            mouseY = e.clientY;

            spotlight.style.setProperty('--x', `${mouseX}px`);
            spotlight.style.setProperty('--y', `${mouseY}px`);

            cursorDot.style.left = `${mouseX}px`;
            cursorDot.style.top = `${mouseY}px`;
        });

        // --- INTERACTION ---
        cardinalPoints.forEach(point => {
            point.addEventListener('mouseenter', () => {
                isMagnetized = true;
                magnetAngle = parseInt(point.getAttribute('data-angle'));
                
                const dir = point.getAttribute('data-dir');
                if(dir) compassRing.classList.add('glow-' + dir);

                cursorDot.style.width = '40px'; 
                cursorDot.style.height = '40px';
                cursorDot.style.opacity = '0.3';
            });

            point.addEventListener('mouseleave', () => {
                isMagnetized = false;
                
                const dir = point.getAttribute('data-dir');
                if(dir) compassRing.classList.remove('glow-' + dir);

                cursorDot.style.width = '8px';
                cursorDot.style.height = '8px';
                cursorDot.style.opacity = '1';
            });
            
            // Link Navigation
            point.addEventListener('click', () => {
               const destination = point.getAttribute('data-link');
               
               // Animation Fade Out
               document.body.style.transition = "opacity 1s ease-in-out";
               document.body.style.opacity = "0";
               
               setTimeout(() => {
                   // Since these PHP links don't exist in this preview, 
                   // I'm logging them. In your real site, keep the redirection.
                   console.log("Navigating to:", destination);
                   window.location.href = destination; 
               }, 1000);
            });
        });

        // --- ANIMATION LOOP ---
        function animate() {
            if (isMagnetized) {
                targetRotation = magnetAngle;
            } else {
                const rect = compassContainer.getBoundingClientRect();
                const centerX = rect.left + rect.width / 2;
                const centerY = rect.top + rect.height / 2;

                const dx = mouseX - centerX;
                const dy = mouseY - centerY;

                // +90 to align 0 degrees with North (Up)
                let angleDeg = (Math.atan2(dy, dx) * 180 / Math.PI) + 90;
                targetRotation = angleDeg;
            }

            // Smallest angle interpolation
            let delta = targetRotation - currentRotation;
            while (delta <= -180) delta += 360;
            while (delta > 180) delta -= 360;

            const factor = isMagnetized ? magnetStrength : lerpFactor;
            currentRotation += delta * factor;

            needle.style.transform = `rotate(${currentRotation}deg)`;

            requestAnimationFrame(animate);
        }

        animate();

    </script>
</body>
</html>
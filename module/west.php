<?php
// --- DONNÉES CÔTÉ SERVEUR ---

$audioTracks = [
    'senan' => [
        'title' => "Zone: senan (Original Location)",
        'ambiance' => "Heavy silence, wind gusts, isolation.",
        'icon' => "wind"
    ],
    'troyes' => [
        'title' => "Zone: Troyes (Current Location)",
        'ambiance' => "City traffic, bus engines, voices.",
        'icon' => "activity"
    ]
];

$datas = [
    'license_cost' => "1800", // Utilisé dans le popup du jeu
    'stat_mobility' => "IGAS Report: In rural zones, lack of transport is the #1 employment barrier for youth."
];
?>

<!DOCTYPE html>
<html lang="en" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>West — Sarah</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300;400;600;800&family=Playfair+Display:ital,wght@0,400;0,700;1,400&family=Share+Tech+Mono&display=swap" rel="stylesheet">
    
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://unpkg.com/lucide@latest"></script>

    <style>
        :root {
            --bg-deep: #050000;
            --text-main: #f0f0f0;
            --accent-alert: #ff4d4d; /* Rouge Alerte */
            --accent-dark: #3d0000;
        }

        body {
            background-color: var(--bg-deep);
            color: var(--text-main);
            font-family: 'Montserrat', sans-serif;
            overflow-x: hidden;
        }

        h1, h2, h3, h4 {
            font-family: 'Playfair Display', serif;
        }

        .font-mono {
            font-family: 'Share Tech Mono', monospace;
        }

        /* --- VFX: Danger & Blockage --- */
        
        /* Particle Animation */
        @keyframes floatParticle {
            0% { transform: translateY(0) translateX(0); opacity: 0; }
            20% { opacity: 0.8; }
            80% { opacity: 0.5; }
            100% { transform: translateY(-100px) translateX(20px); opacity: 0; }
        }

        /* Scanlines for "Screen" effect */
        .scanlines {
            background: linear-gradient(
                to bottom,
                rgba(255,255,255,0),
                rgba(255,255,255,0) 50%,
                rgba(0,0,0,0.2) 50%,
                rgba(0,0,0,0.2)
            );
            background-size: 100% 4px;
            position: fixed;
            pointer-events: none;
            inset: 0;
            z-index: 50;
        }

        .alert-glow {
            box-shadow: 0 0 15px rgba(255, 77, 77, 0.4);
            border-color: var(--accent-alert) !important;
        }
        
        .text-glow {
            text-shadow: 0 0 10px rgba(255, 77, 77, 0.8);
        }

        /* Hazard Stripe Background */
        .hazard-bg {
            background-image: repeating-linear-gradient(
                45deg,
                rgba(255, 77, 77, 0.05),
                rgba(255, 77, 77, 0.05) 10px,
                transparent 10px,
                transparent 20px
            );
        }

        /* Glitch / Shake Animation for errors */
        @keyframes shake {
            0% { transform: translate(1px, 1px) rotate(0deg); }
            10% { transform: translate(-1px, -2px) rotate(-1deg); }
            20% { transform: translate(-3px, 0px) rotate(1deg); }
            30% { transform: translate(3px, 2px) rotate(0deg); }
            40% { transform: translate(1px, -1px) rotate(1deg); }
            50% { transform: translate(-1px, 2px) rotate(-1deg); }
            60% { transform: translate(-3px, 1px) rotate(0deg); }
            70% { transform: translate(3px, 1px) rotate(-1deg); }
            80% { transform: translate(-1px, -1px) rotate(1deg); }
            90% { transform: translate(1px, 2px) rotate(0deg); }
            100% { transform: translate(1px, -2px) rotate(-1deg); }
        }

        .shake-anim {
            animation: shake 0.5s;
            animation-iteration-count: 1;
        }

        @keyframes pulse-red {
            0% { box-shadow: 0 0 0 0 rgba(255, 77, 77, 0.4); }
            70% { box-shadow: 0 0 0 10px rgba(255, 77, 77, 0); }
            100% { box-shadow: 0 0 0 0 rgba(255, 77, 77, 0); }
        }

        .pulse-alert {
            animation: pulse-red 2s infinite;
        }

        /* Tech Borders */
        .clip-corner {
            clip-path: polygon(
                0 0, 
                100% 0, 
                100% calc(100% - 15px), 
                calc(100% - 15px) 100%, 
                0 100%
            );
        }

        /* GPS Dot Animation */
        @keyframes ping {
            75%, 100% { transform: scale(2); opacity: 0; }
        }
        .animate-ping-slow {
            animation: ping 3s cubic-bezier(0, 0, 0.2, 1) infinite;
        }

    </style>
</head>
<body class="selection:bg-[#ff4d4d] selection:text-white bg-[#050000]">

    <!-- PARTICLES CONTAINER - Fixed at a low Z-index but visible -->
    <div id="particles-container" class="fixed inset-0 pointer-events-none z-[1] overflow-hidden"></div>

    
    <!-- Navigation (Shared Style) -->
    <nav class="fixed top-0 left-0 w-full z-50 flex justify-between items-center px-6 py-6 pointer-events-none">
        <a href="../" class="pointer-events-auto flex items-center gap-3 px-5 py-3 bg-[#0a0a0a]/80 backdrop-blur-xl border border-white/10 rounded-full text-[#f0f0f0] hover:text-[#ff4d4d] hover:border-[#ff4d4d]/50 transition-all duration-300 group shadow-lg hover:shadow-[0_0_15px_rgba(255,77,77,0.3)]">
            <div class="p-1 rounded-full bg-white/5 group-hover:bg-[#ff4d4d]/20 transition-colors">
                <i data-lucide="compass" width="16" class="group-hover:-rotate-45 transition-transform duration-700"></i>
            </div>
            <span class="font-medium text-xs tracking-[0.2em] uppercase hidden md:block opacity-90 group-hover:opacity-100">Compass</span>
        </a>
        
        <a href="../final.php" class="pointer-events-auto flex items-center gap-3 px-5 py-3 bg-[#0a0a0a]/60 backdrop-blur-xl border border-white/10 rounded-full text-[#f0f0f0] hover:text-[#ff4d4d] hover:border-[#ff4d4d]/50 transition-all duration-300 group shadow-lg hover:shadow-[0_0_15px_rgba(255,77,77,0.2)]">
            <span class="font-medium text-xs tracking-[0.2em] uppercase hidden md:block opacity-90 group-hover:opacity-100">Final Page</span>
            <div class="p-1 rounded-full bg-white/5 group-hover:bg-[#ff4d4d]/10 transition-colors group-hover:translate-x-1 transition-transform duration-500">
                <i data-lucide="arrow-right" width="16"></i>
            </div>
        </a>
    </nav>

    <!-- HERO SECTION -->
    <div class="relative h-screen w-full overflow-hidden z-10 bg-transparent">
        <!-- Video Background -->
         <!-- Global Visual Overlay -->
    <div class="scanlines"></div>
    <div class="fixed inset-0 pointer-events-none z-[2] bg-gradient-to-b from-transparent via-red-900/5 to-black/80"></div>

        

        
        <!-- Hero Content -->
        <div class="absolute inset-0 z-30 flex flex-col justify-center items-center px-6">
            <!-- Overlays -->
            <div class="absolute inset-0 bg-gradient-to-t from-black via-transparent to-black/60 z-10"></div>
            <div class="absolute inset-0 bg-red-900/10 z-10 mix-blend-overlay"></div>
        
            <div class="max-w-5xl w-full relative text-center z-40">
                <div class="inline-flex items-center gap-2 border border-[#ff4d4d] bg-[#ff4d4d]/10 px-4 py-2 mb-8 animate-pulse">
                    <i data-lucide="alert-triangle" class="text-[#ff4d4d]" width="16"></i>
                    <h1 class="text-xs md:text-sm font-mono tracking-[0.3em] uppercase text-[#ff4d4d] glitch-hover">
                        WEST — SARAH
                    </h1>
                </div>

                <h2 class="text-5xl md:text-8xl font-serif italic text-white drop-shadow-[0_0_10px_rgba(255,0,0,0.5)] leading-none mb-8">
                    TERRITORIAL<br/>
                    <span class="text-transparent bg-clip-text bg-gradient-to-r from-[#ff4d4d] to-white text-glow">ASSIGNMENT</span>
                </h2>
                
                <p class="max-w-2xl mx-auto text-[#ccc] font-light text-lg mb-12 text-center italic">
                    "At Troyes, there are buses, I can go anywhere. <br>
                    <span class="text-[#ff4d4d] not-italic">Where I lived, silence was the only neighbor.</span>"
                </p>

                <!-- FIXED: Changed button to simple Anchor link with href -->
                <button onclick="scrollToSection('testimony')" class="inline-block group relative px-8 py-4 bg-transparent border border-[#ff4d4d] text-[#ff4d4d] font-mono uppercase tracking-widest text-xs hover:bg-[#ff4d4d] hover:text-black transition-all duration-300 clip-corner">
                    <span class="relative z-10 flex items-center gap-3">
                        Begin with the testimony <i data-lucide="chevron-down" width="16"></i>
                    </span>
                </button>
            </div>
        </div>
        <div class="absolute bottom-10 left-1/2 -translate-x-1/2 flex flex-col items-center gap-2 z-30 opacity-50">
           <div class="w-[1px] h-12 bg-gradient-to-b from-[#ff4d4d] to-transparent"></div>
           <span class="font-mono text-[10px] text-[#ff4d4d]">SCROLL</span>
        </div>
    </div>

    <!-- TESTIMONY SECTION -->
    <section id="testimony" class="w-full py-20 md:py-32 px-4 md:px-8 relative z-20 bg-transparent border-t border-[#333]">
        <div class="max-w-5xl mx-auto">
            <div class="flex flex-col md:flex-row items-center gap-8 mb-12">
                <div class="w-16 h-16 border-2 border-[#ff4d4d] bg-black/50 rounded-full flex items-center justify-center animate-ping-slow">
                    <div class="w-4 h-4 bg-[#ff4d4d] rounded-full"></div>
                </div>
                <div class="bg-black/40 p-4 rounded-lg backdrop-blur-sm">
                    <h3 class="text-3xl font-serif text-white">The Breakthrough</h3>
                    <p class="font-mono text-[#ff4d4d] text-xs uppercase tracking-widest">Transition Complete</p>
                </div>
            </div>

            <div class="relative w-full aspect-video bg-black border border-[#333] group overflow-hidden shadow-[0_0_30px_rgba(255,77,77,0.1)]">
                 <!-- Video Element -->
                 <video 
                    id="interview-video"
                    class="w-full h-full object-cover opacity-60 transition-all duration-500 grayscale group-hover:grayscale-0 group-hover:opacity-100"
                    controls
                >
                    <source src="https://mmi24f12.mmi-troyes.fr/webdocumentaire/interview/sarah.mp4" type="video/mp4" />
                </video>

                <!-- Custom Play Overlay -->
                <div id="video-overlay" class="absolute inset-0 flex items-center justify-center cursor-pointer bg-black/40" onclick="playVideo()">
                    <div class="w-20 h-20 border border-[#ff4d4d] flex items-center justify-center hover:bg-[#ff4d4d] transition-all duration-300 clip-corner">
                        <i data-lucide="play" width="32" class="text-[#ff4d4d] group-hover:text-black"></i>
                    </div>
                </div>
            </div>

        </div>
    </section>

    <!-- MINI-GAME: THE IMPOSSIBLE COMMUTE -->
    <!-- Added scroll-mt-32 to handle fixed header offset -->
    <section class="w-full py-20 md:py-32 px-4 md:px-8 relative z-20 bg-transparent hazard-bg border-t border-[#ff4d4d]/30 scroll-mt-32">
        <div id="commute-game" class="max-w-4xl mx-auto">
            
            <div class="mb-12 flex items-end justify-between border-b border-[#333] pb-4">
                <div>
                    <h3 class="text-3xl font-serif text-white mb-2">The Impossible Commute</h3>
                    <p class="font-mono text-[#ff4d4d] text-xs uppercase tracking-widest">Simulation: Senan &#8594; Troyes</p>
                </div>
                <div class="font-mono text-xs text-[#555]">
                    STATUS: <span id="commute-status" class="text-red-500 font-bold blink">LOCKED</span>
                </div>
            </div>

            <!-- "Ajout d'un bg-black/90 ici pour la lisibilité du contenu spécifique" -->
            <div class="grid md:grid-cols-2 gap-8 bg-[#0a0a0a]/90 backdrop-blur-md border border-[#333] p-2 rounded-lg relative overflow-hidden">
                
                <!-- Map Viz -->
                <div class="relative h-[300px] md:h-full min-h-[300px] bg-[#111] border border-[#222] flex items-center justify-center overflow-hidden group">
                    <!-- Map Grid -->
                    <div class="absolute inset-0 bg-[linear-gradient(rgba(50,50,50,0.2)_1px,transparent_1px),linear-gradient(90deg,rgba(50,50,50,0.2)_1px,transparent_1px)] bg-[length:20px_20px]"></div>
                    
                    <!-- Points -->
                    <div class="absolute z-10" style="left: 15%; top: 85%;">
                        <div class="absolute w-4 h-4 bg-[#ff4d4d] rounded-full pulse-alert z-20 -translate-x-1/2 -translate-y-1/2"></div>
                        <span class="absolute top-4 left-1/2 -translate-x-1/2 text-[10px] font-mono text-[#ff4d4d] bg-black/50 px-1 whitespace-nowrap">SENAN (Home)</span>
                    </div>

                    <div class="absolute z-10" style="left: 85%; top: 15%;">
                        <div class="absolute w-4 h-4 border-2 border-white bg-black rounded-full z-20 -translate-x-1/2 -translate-y-1/2"></div>
                        <span class="absolute bottom-4 left-1/2 -translate-x-1/2 text-[10px] font-mono text-white bg-black/50 px-1 whitespace-nowrap">TROYES</span>
                    </div>

                    <!-- Path Line -->
                    <svg class="absolute inset-0 w-full h-full pointer-events-none z-10" viewBox="0 0 100 100" preserveAspectRatio="none">
                        <path id="route-path" d="M 15 85 Q 50 50 85 15" fill="transparent" stroke="#ff4d4d" stroke-width="0.5" stroke-dasharray="2" class="opacity-0 transition-opacity duration-500 vector-effect-non-scaling-stroke" />
                    </svg>

                    <!-- Feedback Overlay -->
                    <div id="game-feedback" class="absolute inset-0 bg-black/80 flex items-center justify-center opacity-0 transition-opacity duration-300 pointer-events-none z-20">
                        <p class="text-[#ff4d4d] font-mono text-xl border border-[#ff4d4d] p-4 text-center bg-black">
                            <i data-lucide="alert-octagon" class="inline mb-1"></i><br>
                            <span id="feedback-text">ERROR</span>
                        </p>
                    </div>
                </div>

                <!-- Controls -->
                <div class="p-6 flex flex-col justify-center space-y-4">
                    <p class="text-sm text-[#888] mb-4 font-mono">
                        > SYSTEM DIAGNOSTIC<br>
                        > USER HAS NO CAR.<br>
                        > SELECT TRANSPORT MODE:
                    </p>

                    <button onclick="tryCommute('walk')" class="game-btn w-full text-left p-4 border border-[#333] hover:border-[#ff4d4d] hover:bg-[#ff4d4d]/10 transition-all font-mono text-sm flex justify-between group">
                        <span>[A] WALK TO CITY</span>
                        <i data-lucide="footprints" class="text-[#555] group-hover:text-[#ff4d4d]"></i>
                    </button>

                    <button onclick="tryCommute('bus')" class="game-btn w-full text-left p-4 border border-[#333] hover:border-[#ff4d4d] hover:bg-[#ff4d4d]/10 transition-all font-mono text-sm flex justify-between group">
                        <span>[B] TAKE THE BUS</span>
                        <i data-lucide="bus" class="text-[#555] group-hover:text-[#ff4d4d]"></i>
                    </button>

                    <div class="relative">
                        <div class="absolute inset-0 flex items-center">
                            <div class="w-full border-t border-[#333]"></div>
                        </div>
                        <div class="relative flex justify-center text-xs">
                            <span class="bg-[#0a0a0a] px-2 text-[#555]">SOLUTION</span>
                        </div>
                    </div>

                    <button id="btn-solution" onclick="tryCommute('work')" class="w-full text-center p-4 bg-[#222] text-[#555] font-mono text-sm cursor-not-allowed transition-all border border-transparent">
                        [C] DRIVE CAR
                    </button>

                </div>
            </div>

            <!-- Context Popup -->
            <div id="data-popup" class="mt-8 bg-[#1a0505] border-l-4 border-[#ff4d4d] p-6 hidden animate-fade-in-up">
                <div class="flex gap-4 items-start">
                    <i data-lucide="database" class="text-[#ff4d4d] shrink-0 mt-1"></i>
                    <div>
                        <h4 class="text-white font-serif text-lg mb-2">The Financial Wall</h4>
                        <p class="text-[#ccc] text-sm leading-relaxed">
                            Sarah had to work at McDonald's in Troyes solely to finance her driver's license.
                            <br><br>
                            <span class="font-mono text-[#ff4d4d]">DATA:</span> The average license cost is 
                            <strong class="text-white text-lg"><?php echo $datas['license_cost']; ?> €</strong>. 
                            An insurmountable sum for rural youth without student jobs.
                        </p>
                    </div>
                </div>
            </div>

        </div>
    </section>

    <!-- BALANCE OF INDEPENDENCE -->
    <section class="w-full py-20 md:py-32 px-4 md:px-8 relative z-20 bg-transparent">
        <div class="max-w-6xl mx-auto">
            <h3 class="text-4xl md:text-5xl font-serif text-center mb-16 drop-shadow-md">The Balance of Independence</h3>
            
            <div class="grid md:grid-cols-2 gap-0 border border-[#333]">
                
                <!-- SENAN SIDE -->
                <div class="relative p-12 bg-[#080808]/90 backdrop-blur-sm group overflow-hidden border-b md:border-b-0 md:border-r border-[#333]">
                    <div class="absolute inset-0 bg-[url('https://www.transparenttextures.com/patterns/diagmonds-light.png')] opacity-5"></div>
                    <div class="relative z-10 text-right opacity-100">
                        <h4 class="text-2xl font-mono text-[#ff4d4d] mb-4 uppercase tracking-widest">Yesterday<br>Senan</h4>
                        <ul class="space-y-4 font-light text-[#888]">
                            <li class="flex items-center justify-end gap-3">
                                Dependency on Mom <i data-lucide="user-minus" width="16"></i>
                            </li>
                            <li class="flex items-center justify-end gap-3">
                                Isolated / Stuck <i data-lucide="lock" width="16"></i>
                            </li>
                            <li class="flex items-center justify-end gap-3">
                                "Waiting for a ride" <i data-lucide="clock" width="16"></i>
                            </li>
                        </ul>
                    </div>
                </div>

                <!-- TROYES SIDE -->
                <div class="relative p-12 bg-[#0c0c0c]/90 backdrop-blur-sm group overflow-hidden">
                    <div class="absolute top-0 right-0 p-2">
                        <i data-lucide="unlock" class="text-[#ff4d4d]"></i>
                    </div>
                    
                    <div class="relative z-10">
                        <h4 class="text-2xl font-mono text-white mb-4 uppercase tracking-widest">Today<br>Troyes</h4>
                        <ul class="space-y-4 font-light text-[#ccc]">
                            <li class="flex items-center gap-3">
                                <i data-lucide="check" width="16" class="text-[#ff4d4d]"></i> My own apartment
                            </li>
                            <li class="flex items-center gap-3">
                                <i data-lucide="check" width="16" class="text-[#ff4d4d]"></i> "I decide what I eat"
                            </li>
                            <li class="flex items-center gap-3">
                                <i data-lucide="check" width="16" class="text-[#ff4d4d]"></i> Total Mobility
                            </li>
                        </ul>

                        <!-- Totem Object -->
                        <div class="mt-8 border border-[#333] bg-[#111] p-4 flex items-center gap-4">
                            <div class="p-3 bg-[#ff4d4d]/10 rounded-full">
                                <i data-lucide="laptop" class="text-[#ff4d4d]"></i>
                            </div>
                            <div>
                                <span class="block text-xs font-mono text-[#555] uppercase">Totem Object</span>
                                <span class="font-serif text-white text-lg">The Laptop</span>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section>

    

    <!-- NEW SECTION: DATA VERIFICATION -->
    <section class="w-full py-20 px-4 md:px-8 relative z-20 bg-transparent hazard-bg border-t border-[#ff4d4d]">
        <div class="max-w-6xl mx-auto">
            <div class="flex justify-between items-end mb-12 border-b border-[#333] pb-4">
                 <div class="bg-black/40 p-2 backdrop-blur-sm">
                    <h3 class="text-3xl font-serif text-white">Data Verification</h3>
                    <p class="font-mono text-[#ff4d4d] text-xs uppercase tracking-widest">Source Code & Analysis</p>
                 </div>
                 
            </div>

            <div class="grid md:grid-cols-3 gap-6">
                <!-- Card 1 -->
                <div class="bg-[#050000] border border-[#333] p-6 hover:border-[#ff4d4d] transition-colors group relative overflow-hidden">
                    <div class="absolute top-0 right-0 p-2 opacity-50">
                        <i data-lucide="car-front" class="text-[#ff4d4d]" width="20"></i>
                    </div>
                    <h4 class="font-mono text-white text-lg mb-2">The Public Transit Void</h4>
                    <div class="text-3xl font-bold text-[#ff4d4d] mb-2">3%</div>
                    <p class="text-[#888] text-sm leading-relaxed mb-4">
                        Only 3% of trips in rural areas are made by public transport. Without a car, you simply don't move.
                    </p><br>
                    <div class="border-t border-[#222] pt-2 mt-auto">
                        <span class="text-[10px] font-mono text-[#555] uppercase">Source: SDES Mobility Survey</span>
                    </div>
                </div>

                <!-- Card 2 -->
                <div class="bg-[#050000] border border-[#333] p-6 hover:border-[#ff4d4d] transition-colors group relative overflow-hidden">
                    <div class="absolute top-0 right-0 p-2 opacity-50">
                        <i data-lucide="map-off" class="text-[#ff4d4d]" width="20"></i>
                    </div>
                    <h4 class="font-mono text-white text-lg mb-2">The Rural Trap</h4>
                    <div class="text-3xl font-bold text-[#ff4d4d] mb-2">46%</div>
                    <p class="text-[#888] text-sm leading-relaxed mb-4">
                        Of young people in rural areas have already <span class="text-white">refused a job or training</span> solely due to a lack of transportation solutions.
                    </p><br>
                    <div class="border-t border-[#222] pt-2 mt-auto">
                        <span class="text-[10px] font-mono text-[#555] uppercase">Source: IGAS (Social Affairs Inspection)</span>
                    </div>
                </div>

                <!-- Card 3 -->
                <div class="bg-[#050000] border border-[#333] p-6 hover:border-[#ff4d4d] transition-colors group relative overflow-hidden">
                    <div class="absolute top-0 right-0 p-2 opacity-50">
                        <i data-lucide="graduation-cap" class="text-[#ff4d4d]" width="20"></i>
                    </div>
                    <h4 class="font-mono text-white text-lg mb-2">Forced Migration</h4>
                    <div class="text-3xl font-bold text-[#ff4d4d] mb-2">Exodus</div>
                    <p class="text-[#888] text-sm leading-relaxed mb-4">
                        Rural youth leave the parental home earlier than urban youth, often not by choice but by <span class="text-white">territorial necessity</span> to access higher education.
                    </p>
                    <div class="border-t border-[#222] pt-2 mt-auto">
                        <span class="text-[10px] font-mono text-[#555] uppercase">Source: INJEP / INSEE Studies</span>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- FINAL NAVIGATION (NEW SECTION) -->
    <section class="w-full py-24 px-6 relative z-20 bg-transparent border-t border-[#ff4d4d]/30 text-center">
        <div class="max-w-4xl mx-auto">
            <div class="mb-12 bg-black/50 p-6 backdrop-blur-sm inline-block rounded border border-[#ff4d4d]/20">
                 <p class="font-serif text-2xl md:text-3xl text-white italic leading-relaxed">
                    "If you hesitate at 18, it means you already want to leave."
                </p>
            </div>

            <div class="flex flex-col md:flex-row justify-center gap-6">
                <a href="../" class="group px-8 py-4 border border-[#333] hover:border-[#ff4d4d] bg-black/80 backdrop-blur-md transition-all duration-300">
                    <span class="font-mono text-xs text-[#888] group-hover:text-[#ff4d4d] uppercase tracking-widest flex items-center gap-2">
                        <i data-lucide="users" width="14"></i> Browse another profile
                    </span>
                </a>
                
                <a href="../final.php" class="group px-8 py-4 bg-[#ff4d4d] text-black border border-[#ff4d4d] hover:bg-transparent hover:text-[#ff4d4d] transition-all duration-300">
                    <span class="font-mono text-xs font-bold uppercase tracking-widest flex items-center gap-2">
                        End navigation <i data-lucide="arrow-right" width="14"></i>
                    </span>
                </a>
            </div>
        </div>
    </section>

    <!-- FOOTER -->
    <footer class="bg-black text-[#444] py-12 text-center text-xs border-t border-[#222] relative z-10 font-mono">
        <div class="absolute top-0 left-1/2 -translate-x-1/2 -translate-y-1/2 bg-black px-4 text-[#ff4d4d]">
            <i data-lucide="triangle" width="12" class="fill-current rotate-180"></i>
        </div>
        <p class="tracking-widest uppercase mb-4 opacity-50">© 2026 Horizons - West Module</p>
        <div class="flex justify-center gap-6 items-center">
            <p>Produced by Peuvot Klara, Ledroit Léo, Mauclair Ethan</p>
            <span class="w-1 h-1 bg-[#ff4d4d] rounded-full"></span>
            <a href="../credits.php" class="text-[#666] hover:text-[#ff4d4d] flex items-center gap-2 transition-colors">
                <i data-lucide="file-text" width="12"></i>
                CREDITS
            </a>
        </div>
    </footer>

    <script>
        // Init Icons
        lucide.createIcons();
        
        // --- PARTICLES ---
        document.addEventListener('DOMContentLoaded', () => {
            const container = document.getElementById('particles-container');
            if (container) {
                for(let i = 0; i < 50; i++) {
                    const p = document.createElement('div');
                    const size = Math.random() * 3 + 1;
                    const duration = Math.random() * 15 + 10;
                    
                    p.className = 'absolute rounded-full bg-[#ff4d4d] blur-[1px]';
                    p.style.left = Math.random() * 100 + '%';
                    p.style.top = Math.random() * 100 + '%';
                    p.style.width = size + 'px';
                    p.style.height = size + 'px';
                    p.style.opacity = '0';
                    p.style.animation = `floatParticle ${duration}s linear infinite`;
                    p.style.animationDelay = Math.random() * 5 + 's';
                    p.style.boxShadow = `0 0 ${size * 2}px #ff4d4d`; 
                    
                    container.appendChild(p);
                }
            }
        });

        // 3. NAVIGATION SCROLL
        function scrollToSection(id) {
            const element = document.getElementById(id);
            if (element) element.scrollIntoView({ behavior: 'smooth' });
        }

        // --- GAME LOGIC ---
        function tryCommute(mode) {
            const feedbackBox = document.getElementById('game-feedback');
            const feedbackText = document.getElementById('feedback-text');
            const container = document.querySelector('.grid');
            
            // Reset
            feedbackBox.classList.remove('opacity-0', 'pointer-events-none');
            container.classList.remove('shake-anim');
            void container.offsetWidth; // Trigger reflow

            if (mode === 'walk') {
                feedbackText.innerHTML = "DISTANCE > 15KM<br>TOO FAR TO WALK";
                container.classList.add('shake-anim');
                updateStatus("FAILURE");
            } 
            else if (mode === 'bus') {
                feedbackText.innerHTML = "ERROR 404<br>NO BUS STOP FOUND";
                container.classList.add('shake-anim');
                updateStatus("FAILURE");
                
                // Unlock solution after failure
                setTimeout(() => {
                    const btn = document.getElementById('btn-solution');
                    btn.classList.remove('cursor-not-allowed', 'bg-[#222]', 'text-[#555]', 'border-transparent');
                    btn.classList.add('bg-[#ff4d4d]', 'text-black', 'font-bold', 'animate-pulse', 'border-[#ff4d4d]');
                    btn.innerHTML = "[C] WORK AT MCDO => GET LICENSE";
                }, 1500);
            } 
            else if (mode === 'work') {
                const btn = document.getElementById('btn-solution');
                if (btn.classList.contains('cursor-not-allowed')) return; // Prevent clicking if locked

                feedbackText.innerHTML = "ACCESS GRANTED<br>LICENSE ACQUIRED";
                feedbackBox.querySelector('p').classList.replace('border-[#ff4d4d]', 'border-green-500');
                feedbackBox.querySelector('p').classList.replace('text-[#ff4d4d]', 'text-green-500');
                
                // Show Route
                document.getElementById('route-path').classList.remove('opacity-0');
                updateStatus("UNLOCKED");

                // Show Data Popup
                document.getElementById('data-popup').classList.remove('hidden');
                
                // Hide feedback after success
                setTimeout(() => {
                    feedbackBox.classList.add('opacity-0', 'pointer-events-none');
                }, 2000);
                return;
            }

            // Hide feedback after delay for failures
            setTimeout(() => {
                feedbackBox.classList.add('opacity-0', 'pointer-events-none');
            }, 2000);
        }

        function updateStatus(status) {
            const el = document.getElementById('commute-status');
            el.innerText = status;
            if(status === "UNLOCKED") {
                el.classList.replace('text-red-500', 'text-green-500');
                el.classList.remove('blink');
            }
        }

        // --- VIDEO LOGIC ---
        function playVideo() {
            const video = document.getElementById('interview-video');
            const overlay = document.getElementById('video-overlay');
            
            video.play();
            video.classList.remove('opacity-60', 'grayscale');
            video.classList.add('opacity-100', 'grayscale-0');
            overlay.classList.add('hidden');
        }

    </script>
    
    <style>
        .blink { animation: blinker 1s linear infinite; }
        @keyframes blinker { 50% { opacity: 0; } }
    </style>
</body>
</html>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>East — Clément</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300;400;500;600;800&family=Playfair+Display:ital,wght@0,400;0,700;1,400&family=Share+Tech+Mono&display=swap" rel="stylesheet">
    
    <script src="https://cdn.tailwindcss.com"></script>
    
    <script src="https://unpkg.com/lucide@latest"></script>

    <style>
        :root {
            --bg-deep: #050505;
            --text-main: #f0f0f0;
            --text-muted: #888;
            --accent-electric: #ffe600; /* Jaune Électrique */
            --accent-dim: rgba(255, 230, 0, 0.15);
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

        /* VFX Glows */
        .electric-glow {
            box-shadow: 0 0 15px rgba(255, 230, 0, 0.3), inset 0 0 10px rgba(255, 230, 0, 0.1);
            border-color: var(--accent-electric) !important;
        }
        
        .text-glow {
            text-shadow: 0 0 10px rgba(255, 230, 0, 0.5);
        }

        .glass-panel {
            background: rgba(10, 10, 10, 0.6);
            backdrop-filter: blur(8px);
            border: 1px solid rgba(255, 255, 255, 0.1);
            position: relative;
        }

        /* Glitch Effect Animation */
        @keyframes glitch-skew {
            0% { transform: skew(0deg); }
            10% { transform: skew(-2deg); }
            20% { transform: skew(2deg); }
            30% { transform: skew(0deg); }
            100% { transform: skew(0deg); }
        }

        @keyframes floatParticle {
            0% { transform: translateY(0) translateX(0); opacity: 0; }
            20% { opacity: 0.4; }
            80% { opacity: 0.3; }
            100% { transform: translateY(-100px) translateX(20px); opacity: 0; }
        }

        .glitch-hover:hover {
            animation: glitch-skew 0.3s cubic-bezier(0.25, 0.46, 0.45, 0.94) both infinite;
            color: var(--accent-electric);
        }

        @keyframes spin-slow {
            from { transform: rotate(0deg); }
            to { transform: rotate(360deg); }
        }

        .animate-spin-slow {
            animation: spin-slow 8s linear infinite;
        }
        
        .paused {
            animation-play-state: paused !important;
        }

        /* Custom Range Slider */
        input[type=range] {
            -webkit-appearance: none; 
            background: transparent; 
        }
        
        input[type=range]::-webkit-slider-thumb {
            -webkit-appearance: none;
            height: 24px;
            width: 24px;
            border-radius: 0; /* Square for digital feel */
            background: var(--accent-electric);
            cursor: pointer;
            margin-top: -10px; 
            box-shadow: 0 0 10px var(--accent-electric);
        }

        input[type=range]::-webkit-slider-runnable-track {
            width: 100%;
            height: 2px;
            background: #333;
        }

        /* Tech/Cut Corner Shape */
        .clip-path-polygon {
            clip-path: polygon(10px 0, 100% 0, 100% calc(100% - 10px), calc(100% - 10px) 100%, 0 100%, 0 10px);
        }

        /* Scanline Animation */
        @keyframes scan {
            0% { background-position: 100% 0; }
            100% { background-position: -100% 0; }
        }
        .scan-anim {
            background-size: 200% 100%;
            animation: scan 2s linear infinite;
        }

        /* Animation Utils */
        @keyframes fadeInUp {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }
        .animate-fade-in-up {
            animation: fadeInUp 0.5s ease-out forwards;
        }
    </style>
</head>
<body class="selection:bg-[#ffe600] selection:text-black">

    <div id="particles-container" class="fixed inset-0 pointer-events-none z-[1] overflow-hidden">
        <div class="absolute inset-0 bg-[url('https://www.transparenttextures.com/patterns/carbon-fibre.png')] opacity-5 mix-blend-overlay"></div>
    </div>

    <nav class="fixed top-0 left-0 w-full z-50 flex justify-between items-center px-6 py-6 pointer-events-none">
        <a href="../" class="pointer-events-auto flex items-center gap-3 px-5 py-3 bg-[#0a0a0a]/60 backdrop-blur-xl border border-white/10 rounded-full text-[#f0f0f0] hover:text-[#ffe600] hover:border-[#ffe600]/50 transition-all duration-300 group shadow-lg hover:shadow-[0_0_15px_rgba(255,230,0,0.2)]">
            <div class="p-1 rounded-full bg-white/5 group-hover:bg-[#ffe600]/10 transition-colors">
                <i data-lucide="compass" width="16" class="group-hover:-rotate-45 transition-transform duration-700"></i>
            </div>
            <span class="font-medium text-xs tracking-[0.2em] uppercase hidden md:block opacity-90 group-hover:opacity-100">Compass</span>
        </a>
        
        <a href="../final.php" class="pointer-events-auto flex items-center gap-3 px-5 py-3 bg-[#0a0a0a]/60 backdrop-blur-xl border border-white/10 rounded-full text-[#f0f0f0] hover:text-[#ffe600] hover:border-[#ffe600]/50 transition-all duration-300 group shadow-lg hover:shadow-[0_0_15px_rgba(205,133,63,0.2)]">
            <span class="font-medium text-xs tracking-[0.2em] uppercase hidden md:block opacity-90 group-hover:opacity-100">Final Page</span>
            <div class="p-1 rounded-full bg-white/5 group-hover:bg-[#ffe600]/10 transition-colors group-hover:translate-x-1 transition-transform duration-500">
                <i data-lucide="arrow-right" width="16"></i>
            </div>
        </a>
    </nav>

    <div class="relative h-screen w-full overflow-hidden z-10 bg-black">
        
        <div class="absolute inset-0 z-0 pointer-events-none">
            <video 
                class="absolute inset-0 w-full h-full object-cover scale-[1.15] opacity-60 grayscale-[0.3] contrast-125"
                autoPlay 
                muted 
                loop 
                playsInline
            >
                <source src="https://mmi24f12.mmi-troyes.fr/webdocumentaire/clement.mp4" type="video/mp4" />
                Your browser does not support the video tag.
            </video>
        </div>

        <div class="absolute inset-0 bg-gradient-to-b from-black/60 via-transparent to-black z-10"></div>
        <div class="absolute inset-0 bg-[linear-gradient(rgba(18,16,16,0)_50%,rgba(0,0,0,0.25)_50%),linear-gradient(90deg,rgba(255,0,0,0.06),rgba(0,255,0,0.02),rgba(0,0,255,0.06))] z-20 bg-[length:100%_2px,3px_100%] pointer-events-none"></div>

        <div class="absolute inset-0 z-30 flex flex-col justify-center items-center px-6">
            <div class="max-w-5xl w-full relative text-center">
                <h1 class="text-xs md:text-sm font-mono tracking-[0.5em] uppercase text-[#ffe600] mb-6 inline-block glitch-hover">
                    EAST — Clément
                </h1>
                <h2 class="text-5xl md:text-8xl font-serif italic text-white drop-shadow-[0_0_15px_rgba(255,255,255,0.3)] leading-none mb-8">
                    EXILE BY <br/>
                    <span class="text-transparent bg-clip-text bg-gradient-to-r from-[#ffe600] to-white">PASSION</span>
                </h2>
                
                <div class="flex flex-col items-center gap-6 mt-12">
                   <p class="font-mono text-[#888] text-xs uppercase tracking-widest bg-black/50 px-4 py-2 border border-[#333]">
                     Subject: VFX Student // Loc: Paris Suburbs
                   </p>
                   <button onclick="scrollToSection('testimony')" class="px-6 py-3 font-mono font-bold tracking-widest uppercase text-xs transition-all duration-300 flex items-center justify-center gap-2 relative overflow-hidden group clip-path-polygon bg-[#ffe600] text-black hover:bg-white hover:shadow-[0_0_20px_#ffe600]">
                     <span class="relative z-10 flex items-center gap-2">Initiate Sequence <i data-lucide="arrow-right" width="14"></i></span>
                     <div class="absolute inset-0 bg-white opacity-0 group-hover:opacity-20 transition-opacity duration-100"></div>
                   </button>
                </div>
            </div>
        </div>

        <div class="absolute bottom-10 left-1/2 -translate-x-1/2 flex flex-col items-center gap-2 z-30 opacity-50">
           <div class="w-[1px] h-12 bg-gradient-to-b from-[#ffe600] to-transparent"></div>
           <span class="font-mono text-[10px] text-[#ffe600]">SCROLL</span>
        </div>
    </div>

    <section id="totem" class="w-full py-20 md:py-32 px-4 md:px-8 relative overflow-hidden z-10 bg-transparent border-t border-[#222]">
        <div class="max-w-4xl mx-auto text-center">
            <div class="mb-12">
                <h3 class="text-3xl md:text-4xl font-serif mb-2">The Totem Object</h3>
                <p class="font-mono text-[#ffe600] text-xs uppercase tracking-widest">Inception DVD // The Catalyst</p>
            </div>

            <div class="relative h-[400px] flex items-center justify-center">
                 <div 
                   id="totem-container"
                   class="relative cursor-pointer group"
                   onclick="handleTotemClick()"
                 >
                    <div id="totem-blur" class="absolute inset-0 rounded-full blur-xl transition-all duration-700 bg-transparent"></div>
                    
                    <div id="totem-spinner" class="w-48 h-48 border-2 border-[#ffe600] rounded-full flex items-center justify-center transition-all duration-1000 animate-spin-slow">
                        <div class="w-40 h-40 border border-[#333] rounded-full flex items-center justify-center">
                           <i id="totem-icon" data-lucide="disc" width="64" class="text-[#ffe600] animate-pulse"></i>
                        </div>
                        <div class="absolute top-0 left-1/2 -translate-x-1/2 -translate-y-2 w-4 h-4 bg-[#ffe600] rounded-none shadow-[0_0_10px_#ffe600]"></div>
                    </div>

                    <div id="totem-hint" class="absolute -bottom-16 left-1/2 -translate-x-1/2 whitespace-nowrap font-mono text-xs transition-opacity duration-300 opacity-100 animate-pulse text-[#888]">
                        [ CLICK HERE TO STABILIZE ]
                    </div>
                 </div>

                 <div id="totem-content" class="absolute inset-0 flex items-center justify-center pointer-events-none transition-all duration-700 opacity-0 scale-90">
                    <div class="bg-black/90 border border-[#ffe600] p-8 max-w-lg shadow-[0_0_50px_rgba(255,230,0,0.2)] pointer-events-auto relative">
                       <div class="absolute top-0 right-0 w-8 h-8 bg-[#ffe600] clip-path-polygon opacity-20"></div>
                       <div class="flex justify-between items-start mb-4 relative z-10">
                          <i data-lucide="film" class="text-[#ffe600]" width="24"></i>
                          <button onclick="handleTotemClick()" class="text-[#555] hover:text-white"><i data-lucide="x" width="16"></i></button>
                       </div>
                       <h4 class="font-serif text-xl mb-4 italic">Intense. Passion. Sacrifice.</h4>
                       <p class="text-[#ccc] text-sm leading-relaxed mb-4">
                         Clément gives 200% to break into the VFX industry. Even if it means 90 minutes of transport daily. 
                         "Inception was the starting point. But Paris is a constraint. The city is too big, too intense. 
                         I am here because the industry is here. It’s a sacrifice I accept to build my future."
                       </p>
                       <div class="flex gap-2 mt-4">
                          <span class="text-[10px] font-mono bg-[#ffe600]/10 text-[#ffe600] px-2 py-1">PASSION > COMFORT</span>
                       </div>
                    </div>
                 </div>
            </div>
        </div>
    </section>

    <section id="testimony" class="w-full py-20 md:py-32 px-4 md:px-8 relative overflow-hidden z-10 bg-transparent border-t border-[#222]">
        <div class="max-w-6xl mx-auto">
            <div class="flex flex-col md:flex-row items-end justify-between mb-12 border-b border-[#222] pb-6">
                <div>
                    <h3 class="text-3xl font-serif text-[#f0f0f0] mb-2">The Testimony</h3>
                    <p class="font-mono text-[#666] text-xs uppercase tracking-[0.2em]">Witness account // Audio Log</p>
                </div>
                <div class="hidden md:flex items-center gap-2 text-[#ffe600] font-mono text-xs uppercase tracking-widest animate-pulse">
                    <div class="w-2 h-2 bg-[#ffe600]"></div>
                    REC ●
                </div>
            </div>
            
            <div class="relative w-full aspect-video bg-[#050505] border border-[#222] hover:border-[#ffe600]/50 transition-all duration-500 group overflow-hidden clip-path-polygon shadow-[0_0_50px_rgba(0,0,0,0.5)]">
                <video 
                    id="interview-video"
                    class="w-full h-full object-cover transition-all duration-1000 grayscale opacity-40 group-hover:opacity-60"
                    controls
                >
                    <source src="https://mmi24f12.mmi-troyes.fr/webdocumentaire/interview/clement.mp4" type="video/mp4" />
                    Your browser does not support the video tag.
                </video>
                
                <div 
                    id="video-overlay"
                    class="absolute inset-0 flex items-center justify-center cursor-pointer z-10" 
                    onclick="playVideo()"
                >
                    <div class="w-24 h-24 border border-[#ffe600] flex items-center justify-center pl-1 backdrop-blur-sm group-hover:bg-[#ffe600] transition-all duration-300 clip-path-polygon hover:scale-105 shadow-[0_0_20px_rgba(255,230,0,0.2)]">
                        <i data-lucide="play" width="32" class="text-[#ffe600] group-hover:text-black transition-colors"></i>
                    </div>
                    
                    <div class="absolute bottom-16 left-8 text-left pointer-events-none">
                        <p class="font-serif text-2xl text-[#f0f0f0] mb-1 drop-shadow-md">Clément: "Intense. Passion. Sacrifice."</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="w-full py-20 md:py-32 px-4 md:px-8 relative overflow-hidden z-10 bg-transparent">
        <div class="max-w-6xl mx-auto">
            <div class="flex flex-col md:flex-row justify-between items-end mb-16 border-b border-[#222] pb-6">
                <div>
                    <h3 class="text-3xl md:text-5xl font-serif">The Trade-off</h3>
                    <p class="font-mono text-[#666] text-xs mt-2 uppercase">Analysis of the Parisian Compromise</p>
                </div>
                <div class="hidden md:block">
                    <i data-lucide="scale" width="32" class="text-[#ffe600]"></i>
                </div>
            </div>

            <div class="grid md:grid-cols-2 gap-8 md:gap-24 relative">
                <div class="hidden md:block absolute left-1/2 top-10 bottom-10 w-[1px] bg-[#222]">
                    <div class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-8 h-8 bg-[#050505] border border-[#ffe600] rotate-45 flex items-center justify-center">
                        <div class="w-2 h-2 bg-[#ffe600]"></div>
                    </div>
                </div>

                <div class="space-y-6 text-right md:pr-12">
                    <h4 class="font-mono text-red-500/80 text-sm uppercase tracking-widest mb-8 border-b border-red-500/20 pb-2 inline-block">System Load (High)</h4>
                    
                    <div class="group">
                        <div class="text-2xl font-serif text-[#ccc] group-hover:text-white transition-colors">Expensive Rent</div>
                        <p class="text-[#666] text-sm mt-1">Paying for 20m² what gets you 60m² elsewhere.</p>
                    </div>
                    
                    <div class="group">
                        <div class="text-2xl font-serif text-[#ccc] group-hover:text-white transition-colors">Commute Hell</div>
                        <p class="text-[#666] text-sm mt-1">1h30 daily in the Line P. Noise, crowd, fatigue.</p>
                    </div>

                    <div class="group">
                        <div class="text-2xl font-serif text-[#ccc] group-hover:text-white transition-colors">Metropolitan Intensity</div>
                        <p class="text-[#666] text-sm mt-1">Too big. Too intense. Far from the balance of the medium-sized cities he prefers.</p>
                    </div>
                </div>

                <div class="space-y-6 text-left md:pl-12">
                    <h4 class="font-mono text-[#ffe600] text-sm uppercase tracking-widest mb-8 border-b border-[#ffe600]/20 pb-2 inline-block">Output Power (Max)</h4>

                    <div class="group">
                        <div class="text-2xl font-serif text-white electric-glow inline-block px-2">Dream Job</div>
                        <p class="text-[#888] text-sm mt-1">VFX Artist. Working on movies & high-end ads.</p>
                    </div>
                    
                    <div class="group">
                        <div class="text-2xl font-serif text-white">The Network</div>
                        <p class="text-[#888] text-sm mt-1">Meeting the best studios. They are all here.</p>
                    </div>

                    <div class="group">
                        <div class="text-2xl font-serif text-white">Top Schools</div>
                        <p class="text-[#888] text-sm mt-1">Access to specialized equipment & training.</p>
                    </div>
                </div>
            </div>

            <div class="mt-20 grid grid-cols-1 md:grid-cols-3 gap-4">
                <div class="bg-[#111] p-6 border border-[#222] hover:border-[#ffe600]/50 transition-colors">
                    <h5 class="text-[#ffe600] font-mono text-xs mb-2">THE METROPOLITAN VACUUM</h5>
                    <p class="text-sm text-[#ccc] mb-4">Higher education graduates are channeled towards major metropolises. For niche sectors like visual effects, moving to Paris is not a choice, it is a prerequisite.</p>
                    <div class="text-[10px] text-[#666] font-mono border-t border-[#333] pt-2">
                        Source: Parcoursup / Ministry of Higher Education
                    </div>
                </div>
                <div class="bg-[#111] p-6 border border-[#222] hover:border-[#ffe600]/50 transition-colors">
                    <h5 class="text-[#ffe600] font-mono text-xs mb-2">THE PARISIAN BILL</h5>
                    <p class="text-sm text-[#ccc] mb-4">To avoid rent swallowing 60% of his budget, the only option is often to move further away. Clément trades money for commuting time.</p><br>
                    <div class="text-[10px] text-[#666] font-mono border-t border-[#333] pt-2">
                        Source: EESR (State of Higher Education and Research)
                    </div>
                </div>
                <div class="bg-[#111] p-6 border border-[#222] hover:border-[#ffe600]/50 transition-colors">
                    <h5 class="text-[#ffe600] font-mono text-xs mb-2">THE CALL OF MEDIUM CITIES</h5>
                    <p class="text-sm text-[#ccc] mb-4">Part of the youth dreams of medium-sized cities (100k inhabitants). A trend accelerating since 2020: leaving the 'jungle' to find room to breathe.</p>
                    <div class="text-[10px] text-[#666] font-mono border-t border-[#333] pt-2">
                        Source: INSEE (Post-2020 Demographic Analyses)
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="w-full py-20 md:py-32 px-4 md:px-8 relative overflow-hidden z-10 bg-transparent border-y border-[#222]">
        <div class="max-w-5xl mx-auto flex flex-col md:flex-row gap-12 items-center">
            
            <div class="w-full md:w-1/2 relative">
                <div class="absolute inset-0 bg-[#ffe600] blur-[100px] opacity-10"></div>
                <div class="border border-[#333] bg-[#050505] p-8 relative overflow-hidden">
                    <div class="absolute top-0 right-0 p-2 bg-[#ffe600] text-black font-bold font-mono text-xs">WORK-STUDY</div>
                    
                    <div class="space-y-6">
                        <div class="flex justify-between items-end border-b border-[#333] pb-4">
                            <span class="text-[#888] font-mono text-sm">INCOME (WORK-STUDY)</span>
                            <span class="text-2xl text-[#ffe600] font-mono">1300 €</span>
                        </div>
                        <div class="flex justify-between items-end border-b border-[#333] pb-4">
                            <span class="text-[#888] font-mono text-sm">CAF (HOUSING AID)</span>
                            <span class="text-xl text-[#ffe600] font-mono">+ 370 €</span>
                        </div>
                        <div class="flex justify-between items-end border-b border-[#333] pb-4">
                            <span class="text-[#888] font-mono text-sm">RENT (SHARED)</span>
                            <span class="text-xl text-red-400 font-mono">- 650 €</span>
                        </div>
                        <div class="flex justify-between items-end">
                            <span class="text-[#888] font-mono text-sm">LIVING MONEY</span>
                            <span class="text-3xl text-white font-mono">~ 1020 €</span>
                        </div>
                    </div>

                    <div class="absolute inset-0 pointer-events-none bg-[linear-gradient(transparent_50%,rgba(0,0,0,0.5)_50%)] bg-[length:100%_4px]"></div>
                </div>
                <p class="mt-4 text-xs text-[#555] font-mono text-center">
                    * Unlike pure students, Clément earns a salary while studying.
                </p>
            </div>

            <div class="w-full md:w-1/2 space-y-6">
                <h3 class="text-4xl font-serif">System D</h3>
                <p class="text-[#ccc] font-light leading-relaxed">
                    "I have a salary. Rent is divided by two." <br/>
                    Clément embodies the <strong>Apprentice Strategy</strong>. By securing a work-study contract, he bypasses the student poverty trap.
                </p>
                <p class="text-[#888] text-sm">
                    By choosing a work-study program (Alternance), he solves the financial equation of Paris. The cost? Double workload. School weeks alternating with corporate weeks. No holidays.
                </p>
                <div class="flex items-center gap-4 pt-4">
                    <i data-lucide="monitor" class="text-[#ffe600]" width="24"></i>
                    <span class="font-mono text-xs tracking-widest text-[#ffe600]">PROFESSIONALIZATION</span>
                </div>
            </div>
        </div>
    </section>

    <section class="w-full py-20 md:py-32 px-4 md:px-8 relative overflow-hidden z-10 bg-transparent">
        <div class="max-w-4xl mx-auto text-center">
            <h3 class="text-4xl font-serif mb-4">In 10 Years?</h3>
            <p class="text-[#888] mb-12">Drag to explore his possible futures.</p>

            <div class="bg-[#111] p-8 border border-[#222] relative rounded-lg">
                <div class="flex justify-between text-xs font-mono text-[#555] mb-2 uppercase tracking-widest">
                    <span>Paris (Career)</span>
                    <span>Province (Peace)</span>
                </div>

                <input 
                    type="range" 
                    id="futureRange"
                    min="0" 
                    max="100" 
                    value="50" 
                    oninput="updateFuture(this.value)"
                    class="w-full relative z-20 focus:outline-none"
                />

                <div id="futureContent" class="mt-12 min-h-[120px] transition-all duration-300">
                    </div>
            </div>

            <div class="mt-16 text-[#888] italic font-serif text-lg">
                "Leaving to succeed means accepting to live where you wouldn't have chosen."
            </div>
        </div>
        <section class="w-full py-24 px-6 relative z-20 bg-transparent text-center">

    <div class="flex flex-col md:flex-row justify-center gap-6">
                <a href="../" class="group px-8 py-4 border border-[#333] hover:border-[#ffe600] bg-black/80 backdrop-blur-md transition-all duration-300">
                    <span class="font-mono text-xs text-[#888] group-hover:text-[#ffe600] uppercase tracking-widest flex items-center gap-2">
                        <i data-lucide="users" width="14"></i> Browse another profile
                    </span>
                </a>
                
                <a href="../final.php" class="group px-8 py-4 bg-[#ffe600] text-black border border-[#ffe600] hover:bg-transparent hover:text-[#ffe600] transition-all duration-300">
                    <span class="font-mono text-xs font-bold uppercase tracking-widest flex items-center gap-2">
                        End navigation <i data-lucide="arrow-right" width="14"></i>
                    </span>
                </a>
            </div>
    </section>
    </section>
    

    <footer class="bg-[#020202] text-[#333] py-12 text-center text-xs border-t border-[#111] relative z-10 font-mono">
        <p class="tracking-widest uppercase mb-4 opacity-50">© 2026 Horizons - East Module</p>
        <div class="flex justify-center gap-6 items-center">
            <p>Produced by Peuvot Klara, Ledroit Léo, Mauclair Ethan</p>
            <span class="w-1 h-1 bg-[#ffe600] rounded-full"></span>
            <a href="../credits.php" class="text-[#666] hover:text-[#ffe600] flex items-center gap-2 transition-colors">
                <i data-lucide="file-text" width="12"></i>
                CREDITS
            </a>
        </div>
    </footer>

    <script>
        // Init Icons
        lucide.createIcons();

        // 1. PARTICLES
        document.addEventListener('DOMContentLoaded', () => {
            const container = document.getElementById('particles-container');
            for(let i = 0; i < 50; i++) {
                const p = document.createElement('div');
                const size = Math.random() * 2 + 0.5;
                const duration = Math.random() * 15 + 15;
                
                p.className = 'absolute rounded-full bg-[#ffe600] blur-[0.5px]';
                p.style.left = Math.random() * 100 + '%';
                p.style.top = Math.random() * 100 + '%';
                p.style.width = size + 'px';
                p.style.height = size + 'px';
                p.style.opacity = '0';
                p.style.animation = `floatParticle ${duration}s linear infinite`;
                p.style.animationDelay = Math.random() * 5 + 's';
                p.style.boxShadow = `0 0 ${size}px #ffe600`;
                
                container.appendChild(p);
            }
            // Init Future UI
            updateFuture(50);
        });

        // 2. TOTEM LOGIC
        let isSpinning = true;
        
        function handleTotemClick() {
            const spinner = document.getElementById('totem-spinner');
            const blur = document.getElementById('totem-blur');
            const icon = document.getElementById('totem-icon');
            const content = document.getElementById('totem-content');
            const hint = document.getElementById('totem-hint');

            if (isSpinning) {
                // Stop Spin
                isSpinning = false;
                spinner.classList.remove('animate-spin-slow');
                spinner.classList.add('rotate-0', 'shadow-[0_0_30px_#ffe600]');
                icon.classList.remove('animate-pulse');
                blur.classList.remove('bg-transparent');
                blur.classList.add('bg-[#ffe600]/20');
                hint.classList.remove('opacity-100', 'animate-pulse');
                hint.classList.add('opacity-0');

                // Unlock Content after delay
                setTimeout(() => {
                    content.classList.remove('opacity-0', 'scale-90');
                    content.classList.add('opacity-100', 'scale-100');
                }, 700);
            } else {
                // Restart Spin
                isSpinning = true;
                content.classList.remove('opacity-100', 'scale-100');
                content.classList.add('opacity-0', 'scale-90');

                setTimeout(() => {
                    spinner.classList.add('animate-spin-slow');
                    spinner.classList.remove('rotate-0', 'shadow-[0_0_30px_#ffe600]');
                    icon.classList.add('animate-pulse');
                    blur.classList.add('bg-transparent');
                    blur.classList.remove('bg-[#ffe600]/20');
                    hint.classList.add('opacity-100', 'animate-pulse');
                    hint.classList.remove('opacity-0');
                }, 300);
            }
        }

        // 3. NAVIGATION SCROLL
        function scrollToSection(id) {
            const element = document.getElementById(id);
            if (element) element.scrollIntoView({ behavior: 'smooth' });
        }

        // 4. FUTURE RANGE LOGIC
        function updateFuture(val) {
            const container = document.getElementById('futureContent');
            let html = '';

            if (val < 40) {
                html = `
                    <div class="animate-fade-in-up">
                       <div class="text-2xl font-serif text-[#ffe600] mb-2">The Studio Lead</div>
                       <p class="text-sm text-[#ccc]">
                           "I stay. I become a Supervisor in a big studio. I live in the suburbs, maybe buy a small apartment. The pressure is high, but the projects are legendary."
                       </p>
                       <div class="mt-4 flex justify-center gap-4 text-[#555] text-xs font-mono">
                           <span class="flex items-center gap-1"><i data-lucide="map-pin" width="12"></i> Paris 11e</span>
                           <span class="flex items-center gap-1"><i data-lucide="monitor" width="12"></i> Senior VFX Artist</span>
                       </div>
                    </div>`;
            } else if (val > 60) {
                html = `
                    <div class="animate-fade-in-up">
                       <div class="text-2xl font-serif text-[#ffe600] mb-2">The Remote Freelancer</div>
                       <p class="text-sm text-[#ccc]">
                           "I leave. With enough experience, I can work remotely from a medium-sized city like Angers or Tours. I regain my time and space."
                       </p>
                       <div class="mt-4 flex justify-center gap-4 text-[#555] text-xs font-mono">
                           <span class="flex items-center gap-1"><i data-lucide="map-pin" width="12"></i> Tours</span>
                           <span class="flex items-center gap-1"><i data-lucide="monitor" width="12"></i> Freelance Lead</span>
                       </div>
                    </div>`;
            } else {
                html = `
                    <div class="opacity-50 grayscale">
                       <div class="text-2xl font-serif text-white mb-2">The Hesitation</div>
                       <p class="text-sm text-[#666]">
                           "It's hard to project. For now, the city eats me, but it feeds me."
                       </p>
                    </div>`;
            }
            container.innerHTML = html;
            lucide.createIcons(); // Re-init icons for injected HTML
        }

        // 5. VIDEO LOGIC
        function playVideo() {
            const video = document.getElementById('interview-video');
            const overlay = document.getElementById('video-overlay');
            
            video.play();
            video.classList.remove('grayscale', 'opacity-40', 'group-hover:opacity-60');
            video.classList.add('filter-none');
            overlay.classList.add('hidden');
        }

    </script>
</body>
</html>
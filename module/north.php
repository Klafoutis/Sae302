<?php
// --- SERVER SIDE DATA (PHP) ---

// Scale weights configuration with REAL SOURCES (Translated)
$weights = [
    [
        'id' => 'salary', 
        'label' => 'XXXL Salary', 
        'type' => 'material', 
        'weight' => 50, 
        'icon' => 'banknote',
        'stat' => "Only 22% of French people rank salary as their main source of motivation.",
        'source' => "Randstad Barometer 2023"
    ],
    [
        'id' => 'status', 
        'label' => 'Social Status', 
        'type' => 'material', 
        'weight' => 40, 
        'icon' => 'crown',
        'stat' => "44% of employees feel their work lacks meaning (Brown-out).",
        'source' => "Audencia / BVA Study"
    ],
    [
        'id' => 'prestige', 
        'label' => 'Prestige', 
        'type' => 'material', 
        'weight' => 30, 
        'icon' => 'award',
        'stat' => "External social recognition is a key factor in burnout.",
        'source' => "Public Health France"
    ],
    [
        'id' => 'freedom', 
        'label' => 'Freedom', 
        'type' => 'imaterial', 
        'weight' => 25, 
        'icon' => 'wind',
        'stat' => "Autonomy is cited as the #1 factor for quality of life at work.",
        'source' => "ANACT (National Agency)"
    ],
    [
        'id' => 'meaning', 
        'label' => 'Meaning', 
        'type' => 'imaterial', 
        'weight' => 35, 
        'icon' => 'heart',
        'stat' => "For 92% of the workforce, meaning at work is deemed 'important' or 'priority'.",
        'source' => "Deloitte / Viadeo Survey"
    ],
    [
        'id' => 'time', 
        'label' => 'Free Time', 
        'type' => 'imaterial', 
        'weight' => 30, 
        'icon' => 'clock',
        'stat' => "Work-life balance has become the #1 criterion for candidates in 2024.",
        'source' => "APEC Study"
    ],
];

// Real Estate Data (INSEE / MeilleursAgents approx)
$stats = [
    'paris' => ['price' => 10000, 'label' => 'Paris (Inner City)'],
    'angers' => ['price' => 3200, 'label' => 'Angers (Mid-size City)']
];
?>

<!DOCTYPE html>
<html lang="en" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>North — Marc</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300;400;500;700&family=Playfair+Display:ital,wght@0,400;0,700;1,400&family=Space+Mono&display=swap" rel="stylesheet">
    
    <!-- Tailwind & Lucide Icons -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://unpkg.com/lucide@latest"></script>

    <style>
        :root {
            --bg-deep: #0a0a0a;
            --text-main: #e5e5e5;
            --accent-cyan: #00ced1; /* Dark Turquoise */
            --accent-dim: rgba(0, 206, 209, 0.1);
            --danger: #ff4d4d;
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
            font-family: 'Space Mono', monospace;
        }

        /* --- AMBIANCE VFX --- */
        
        .cyan-glow {
            box-shadow: 0 0 20px rgba(0, 206, 209, 0.4);
        }
        
        .text-glow {
            text-shadow: 0 0 10px rgba(0, 206, 209, 0.6);
        }

        .border-glow {
            border-color: var(--accent-cyan);
            box-shadow: 0 0 10px rgba(0, 206, 209, 0.2);
        }

        /* Split Screen Animation */
        .split-panel {
            transition: width 0.8s cubic-bezier(0.22, 1, 0.36, 1);
        }

        /* Scale/Balance Animations */
        @keyframes sway {
            0% { transform: rotate(0deg); }
            25% { transform: rotate(2deg); }
            75% { transform: rotate(-2deg); }
            100% { transform: rotate(0deg); }
        }
        
        .balance-arm {
            transform-origin: center center;
            transition: transform 1s cubic-bezier(0.4, 0, 0.2, 1);
        }

        /* Fog/Mist Effect */
        @keyframes mist {
            0% { background-position: 0% 0%; }
            100% { background-position: 200% 0%; }
        }
        .mist-bg {
            background: url('https://www.transparenttextures.com/patterns/foggy-birds.png');
            opacity: 0.1;
            animation: mist 60s linear infinite;
        }

        /* Draggable Items & Tooltips */
        .draggable-item {
            cursor: grab;
            transition: transform 0.2s, box-shadow 0.2s;
            position: relative; /* Essential for absolute tooltip positioning */
        }
        
        .draggable-item:hover {
            z-index: 50; /* Bring to top on hover */
        }

        .draggable-item:active {
            cursor: grabbing;
            transform: scale(1.05);
            z-index: 60; /* Max z-index when dragging */
        }

        /* TOOLTIP STYLE - "Above others" (Visual) */
        .stat-popover {
            position: absolute;
            bottom: 125%; /* Just above the element */
            left: 50%;
            transform: translateX(-50%) translateY(10px);
            width: 220px;
            background: rgba(15, 15, 15, 0.95);
            border: 1px solid var(--accent-cyan);
            padding: 12px;
            border-radius: 6px;
            pointer-events: none; /* Allows click through */
            opacity: 0;
            transition: all 0.2s cubic-bezier(0.175, 0.885, 0.32, 1.275);
            box-shadow: 0 10px 30px rgba(0,0,0,0.9), 0 0 15px rgba(0, 206, 209, 0.2);
            visibility: hidden;
            text-align: left;
            z-index: 100;
        }

        /* Triangle arrow */
        .stat-popover::after {
            content: '';
            position: absolute;
            top: 100%;
            left: 50%;
            margin-left: -6px;
            border-width: 6px;
            border-style: solid;
            border-color: var(--accent-cyan) transparent transparent transparent;
        }

        /* Show tooltip on hover or focus */
        .draggable-item:hover .stat-popover,
        .draggable-item:active .stat-popover {
            opacity: 1;
            visibility: visible;
            transform: translateX(-50%) translateY(0);
        }

        /* Variant for material type (Red) */
        .draggable-item[data-type="material"] .stat-popover {
            border-color: var(--danger);
            box-shadow: 0 10px 30px rgba(0,0,0,0.9), 0 0 15px rgba(255, 77, 77, 0.2);
        }
        .draggable-item[data-type="material"] .stat-popover::after {
            border-color: var(--danger) transparent transparent transparent;
        }

        /* Highlight Animation for List */
        @keyframes highlight-fade {
            0% { background-color: rgba(0, 206, 209, 0.3); transform: translateX(5px); }
            100% { background-color: transparent; transform: translateX(0); }
        }
        .new-list-item {
            animation: highlight-fade 1.5s ease-out;
        }

        /* Custom Scrollbar */
        ::-webkit-scrollbar {
            width: 8px;
        }
        ::-webkit-scrollbar-track {
            background: #000;
        }
        ::-webkit-scrollbar-thumb {
            background: #333;
            border-radius: 4px;
        }
        ::-webkit-scrollbar-thumb:hover {
            background: var(--accent-cyan);
        }

        .clip-notch {
            clip-path: polygon(0 0, 100% 0, 100% calc(100% - 15px), calc(100% - 15px) 100%, 0 100%);
        }
    </style>
</head>
<body class="selection:bg-[#00ced1] selection:text-black">

    <!-- NAVIGATION (Fixed) -->
    <nav class="fixed top-0 left-0 w-full z-50 flex justify-between items-center px-6 py-6 pointer-events-none">
        <a href="../" class="pointer-events-auto flex items-center gap-3 px-5 py-3 bg-[#0a0a0a]/80 backdrop-blur-xl border border-white/10 rounded-full text-[#f0f0f0] hover:text-[#00ced1] hover:border-[#00ced1]/50 transition-all duration-300 group shadow-lg hover:shadow-[0_0_15px_rgba(0,206,209,0.3)]">
            <div class="p-1 rounded-full bg-white/5 group-hover:bg-[#00ced1]/20 transition-colors">
                <i data-lucide="compass" width="16" class="group-hover:-rotate-45 transition-transform duration-700"></i>
            </div>
            <span class="font-medium text-xs tracking-[0.2em] uppercase hidden md:block opacity-90 group-hover:opacity-100">Compass</span>
        </a>
        
        <a href="../final.php" class="pointer-events-auto flex items-center gap-3 px-5 py-3 bg-[#0a0a0a]/60 backdrop-blur-xl border border-white/10 rounded-full text-[#f0f0f0] hover:text-[#00ced1] hover:border-[#00ced1]/50 transition-all duration-300 group shadow-lg hover:shadow-[0_0_15px_rgba(0,206,209,0.2)]">
            <span class="font-medium text-xs tracking-[0.2em] uppercase hidden md:block opacity-90 group-hover:opacity-100">Final Page</span>
            <div class="p-1 rounded-full bg-white/5 group-hover:bg-[#00ced1]/10 transition-colors group-hover:translate-x-1 transition-transform duration-500">
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
                <source src="https://mmi24f12.mmi-troyes.fr/webdocumentaire/marc.mp4" type="video/mp4" />
                Your browser does not support the video tag.
            </video>
        </div>
        <div class="absolute inset-0 bg-gradient-to-b from-black/60 via-transparent to-black z-10"></div>
        <div class="absolute inset-0 bg-[linear-gradient(rgba(18,16,16,0)_50%,rgba(0,0,0,0.25)_50%),linear-gradient(90deg,rgba(255,0,0,0.06),rgba(0,255,0,0.02),rgba(0,0,255,0.06))] z-20 bg-[length:100%_2px,3px_100%] pointer-events-none"></div>


        <div class="absolute inset-0 z-30 flex flex-col justify-center items-center px-6">
            <div class="max-w-5xl w-full relative text-center">
                <h1 class="text-xs md:text-sm font-mono tracking-[0.5em] uppercase text-[#00ced1] mb-6 inline-block glitch-hover">
                    NORTH — Marc
                </h1>
                <h2 class="text-5xl md:text-8xl font-serif italic text-white drop-shadow-[0_0_15px_rgba(255,255,255,0.3)] leading-none mb-8">
                    MEANING BEFORE<br/>
                    <span class="text-transparent bg-clip-text text-white">SALARY </span>
                </h2>
                
                <div class="flex flex-col items-center gap-6 mt-12">
                   
                   <button onclick="scrollToSection('testimony')" class="px-6 py-3 font-mono font-bold tracking-widest uppercase text-xs transition-all duration-300 flex items-center justify-center gap-2 relative overflow-hidden group clip-path-polygon bg-[#00ced1] text-black hover:bg-white hover:shadow-[0_0_20px_#00ced1]">
                     <span class="relative z-10 flex items-center gap-2">Begin with the testimony<i data-lucide="arrow-right" width="14"></i></span>
                     <div class="absolute inset-0 bg-white opacity-0 group-hover:opacity-20 transition-opacity duration-100"></div>
                   </button>
                </div>
            </div>
        </div>

        <div class="absolute bottom-10 left-1/2 -translate-x-1/2 flex flex-col items-center gap-2 z-30 opacity-50">
           <div class="w-[1px] h-12 bg-gradient-to-b from-[#00ced1] to-transparent"></div>
           <span class="font-mono text-[10px] text-[#00ced1]">SCROLL</span>
        </div>
    </div>
    <section class="relative h-[400px] w-full overflow-hidden flex" id="hero-split">
        
        <!-- LEFT: The Corporate Grey (Metro/Work) -->
        <div class="split-panel w-1/2 h-full relative group bg-[#1a1a1a] border-r border-[#333] hover:w-[60%] hover:z-10 transition-all duration-700 ease-in-out">
            <div class="absolute inset-0 bg-cover bg-center grayscale opacity-40 mix-blend-multiply"></div>
            <div class="absolute inset-0 bg-gradient-to-b from-black/80 via-transparent to-black/90"></div>
            
            <div class="absolute inset-0 flex flex-col justify-center items-center p-8 text-center z-20 opacity-80 group-hover:opacity-100 transition-opacity">
                <div class="mb-6 p-4 bg-white/5 backdrop-blur-sm border-l-2 border-gray-500 max-w-xs transform -rotate-1 shadow-2xl">
                    <div class="flex items-center gap-2 mb-2 text-xs text-gray-400 font-mono">
                        <i data-lucide="mail" width="12"></i> OUTLOOK • 08:02 AM
                    </div>
                    <p class="text-sm text-gray-300 italic">"Executive meeting moved up. Urgent. Please validate the report before 9 AM."</p>
                </div>
                <h2 class="text-4xl md:text-6xl font-serif text-[#666] tracking-tighter mb-2">LA DÉFENSE</h2>
                <p class="font-mono text-xs uppercase tracking-widest text-[#444]">High Salary • Low Meaning</p>
            </div>
        </div>

        <!-- RIGHT: The Craft Color (Brewery/Meaning) -->
        <div class="split-panel w-1/2 h-full relative group bg-[#050505] hover:w-[60%] hover:z-10 transition-all duration-700 ease-in-out">
            <!-- Warm/Cyan Overlay -->
            <div class="absolute inset-0 bg-cover bg-center opacity-60 mix-blend-overlay"></div>
            <div class="absolute inset-0 bg-gradient-to-t from-[#00ced1]/20 via-transparent to-black/80"></div>

            <div class="absolute inset-0 flex flex-col justify-center items-center p-8 text-center z-20">
                <div class="mb-6 p-4 bg-black/40 backdrop-blur-md border border-[#00ced1]/30 max-w-xs transform rotate-1 shadow-[0_0_30px_rgba(0,206,209,0.1)]">
                    <div class="flex items-center gap-2 mb-2 text-xs text-[#00ced1] font-mono">
                        <i data-lucide="thumbs-up" width="12"></i> DIRECT • 06:30 PM
                    </div>
                    <p class="text-sm text-[#e0e0e0] italic">"This IPA is incredible. Did you brew it yourself?"</p>
                </div>
                <h2 class="text-4xl md:text-6xl font-serif text-white tracking-tighter mb-2 text-glow">THE WORKSHOP</h2>
                <p class="font-mono text-xs uppercase tracking-widest text-[#00ced1]">Salary Divided • Meaning Found</p>
            </div>
        </div>
    </section>
    <!-- 3. TESTIMONY SEQUENCE: "THE LIBERATION" -->
    <section id="testimony" class="w-full py-24 px-4 md:px-8 border-t border-[#222] relative z-20">
        <div class="max-w-5xl mx-auto flex flex-col md:flex-row gap-12 items-center">
            
            <div class="w-full md:w-1/2">
                <div class="relative group cursor-pointer clip-notch">
                    <div class="absolute inset-0 bg-[#00ced1] opacity-0 group-hover:opacity-10 transition-opacity duration-500"></div>
                    <video 
                        id="testimony-video"
                        class="w-full aspect-video object-cover grayscale opacity-60 group-hover:opacity-100 group-hover:grayscale-0 transition-all duration-700"
                        poster="https://images.unsplash.com/photo-1555652296-65126f5d8869?q=80&w=2070&auto=format&fit=crop"
                        onclick="this.play(); this.classList.remove('grayscale', 'opacity-60');"
                    >
                        <source src="https://mmi24f12.mmi-troyes.fr/webdocumentaire/interview/marc.mp4" type="video/mp4">
                    </video>
                    <div class="absolute inset-0 flex items-center justify-center pointer-events-none group-hover:opacity-0 transition-opacity">
                        <div class="w-16 h-16 rounded-full border border-[#00ced1] flex items-center justify-center">
                            <i data-lucide="play" class="text-[#00ced1] ml-1"></i>
                        </div>
                    </div>
                </div>
            </div>

            <div class="w-full md:w-1/2 space-y-8">
                <div>
                    <h3 class="text-3xl font-serif text-white mb-2">The Liberation</h3>
                    <p class="font-mono text-xs text-[#00ced1] uppercase tracking-widest">Audio Testimony</p>
                </div>

                <div class="space-y-6">
                    <blockquote class="border-l-2 border-[#333] pl-6 text-[#ccc] italic text-lg leading-relaxed">
                        "My colleagues called it social regression. Moving from a senior executive to a craftsman? To them, it was suicide. I call it liberation."
                    </blockquote>
                    <blockquote class="border-l-2 border-[#00ced1] pl-6 text-white font-serif text-xl leading-relaxed">
                        "I had to amputate part of my ego to rediscover my roots. Today, I am physically tired, but my mind is silent."
                    </blockquote>
                </div>
            </div>

        </div>
    </section>

    <!-- 2. INTERACTIVE DEVICE: "THE SCALE OF SUCCESS" -->
    <section class="w-full py-24 px-4 md:px-8 bg-[#0a0a0a] relative overflow-hidden">
        <div class="absolute inset-0 mist-bg pointer-events-none"></div>
        
        <div class="max-w-6xl mx-auto relative z-10">
            <div class="text-center mb-16">
                <h3 class="text-4xl md:text-5xl font-serif text-white mb-4">The Scale of Success</h3>
                <p class="text-[#888] font-light max-w-2xl mx-auto text-sm">
                    Marc had to make a choice. What about you? Drag the items onto the trays to redefine success.<br>
                    <span class="text-[#00ced1] text-xs font-mono mt-2 block">Hover over an item to see its real impact.</span>
                </p>
            </div>

            <div class="grid lg:grid-cols-3 gap-12 items-stretch">
                
                <!-- Items Pool (Left) -->
                <div class="bg-[#111] p-6 rounded-sm border border-[#222] flex flex-col min-h-[425px]">
                    <h4 class="font-mono text-xs text-[#555] uppercase tracking-widest mb-6 border-b border-[#333] pb-2">Available Resources</h4>
                    <div 
                        class="grid grid-cols-2 grid-rows-3 gap-4 min-h-[100px]" 
                        id="items-pool"
                        ondrop="drop(event, 'pool')" 
                        ondragover="allowDrop(event)"
                    >
                        <?php foreach($weights as $item): ?>
                            <div 
                                id="<?= $item['id'] ?>" 
                                class="draggable-item bg-[#1a1a1a] border border-[#333] p-4 flex flex-col items-center justify-center gap-2 hover:border-[#00ced1] group rounded transition-all hover:bg-[#1f1f1f]"
                                draggable="true"
                                data-id="<?= $item['id'] ?>"
                                data-weight="<?= $item['weight'] ?>"
                                data-type="<?= $item['type'] ?>"
                                data-stat="<?= htmlspecialchars($item['stat']) ?>"
                                data-source="<?= htmlspecialchars($item['source']) ?>"
                            >
                                <i data-lucide="<?= $item['icon'] ?>" width="20" class="text-[#666] group-hover:text-[#00ced1] transition-colors"></i>
                                <span class="text-xs font-mono text-[#ccc] text-center"><?= $item['label'] ?></span>
                                <span class="absolute top-1 right-2 text-[8px] text-[#444]"><?= $item['weight'] ?>kg</span>

                                <!-- THE POPUP TOOLTIP -->
                                <div class="stat-popover">
                                    <p class="text-[11px] text-white font-semibold leading-relaxed mb-2">
                                        <?= htmlspecialchars($item['stat']) ?>
                                    </p>
                                    <div class="flex items-center gap-1 border-t border-white/10 pt-1">
                                        <i data-lucide="info" width="10" class="<?= $item['type'] === 'material' ? 'text-red-400' : 'text-[#00ced1]' ?>"></i>
                                        <span class="text-[9px] text-[#888] uppercase tracking-wide">Source: <?= htmlspecialchars($item['source']) ?></span>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                    <p class="text-[10px] text-[#444] mt-4 text-center italic mt-auto pt-4">Drop here to remove from scale</p>
                </div>

                <!-- The Scale (Center) -->
                <div class="relative h-[400px] flex items-end justify-center">
                    <!-- Base -->
                    <div class="absolute bottom-0 w-4 h-40 bg-[#333] rounded-t-lg"></div>
                    <div class="absolute bottom-0 w-32 h-4 bg-[#222] rounded-full"></div>
                    
                    <!-- Arm -->
                    <div id="balance-arm" style="top:15rem;" class="balance-arm absolute w-[90%] h-2 bg-[#444] rounded flex justify-between items-center transition-transform duration-700 origin-center z-10">
                        <!-- Left Pan (Material) -->
                        <div class="relative -left-4 top-10">
                            <div class="w-1 h-24 bg-[#555] mx-auto opacity-50"></div>
                            <div 
                                id="pan-left" 
                                class="w-32 h-4 bg-[#00ced1]/10 border-b-2 border-[#00ced1] rounded-b-full flex flex-col-reverse items-center justify-start p-2 transition-colors duration-300 min-h-[50px]"
                                ondrop="drop(event, 'left')" 
                                ondragover="allowDrop(event)"
                            >
                                <!-- Dropped items go here -->
                            </div>
                            <div class="text-center mt-2 font-mono text-[10px] text-[#555] uppercase">Material</div>
                        </div>

                        <!-- Pivot -->
                        <div class="w-6 h-6 bg-[#00ced1] rounded-full shadow-[0_0_15px_#00ced1] z-10 absolute left-1/2 -translate-x-1/2 -top-2"></div>

                        <!-- Right Pan (Immaterial) -->
                        <div class="relative -right-4 top-10">
                            <div class="w-1 h-24 bg-[#555] mx-auto opacity-50"></div>
                            <div 
                                id="pan-right" 
                                class="w-32 h-4 bg-white/5 border-b-2 border-white/20 rounded-b-full flex flex-col-reverse items-center justify-start p-2 transition-colors duration-300 min-h-[50px]"
                                ondrop="drop(event, 'right')" 
                                ondragover="allowDrop(event)"
                            >
                                <!-- Dropped items go here -->
                            </div>
                            <div class="text-center mt-2 font-mono text-[10px] text-[#555] uppercase">Meaning / Life</div>
                        </div>
                    </div>

                    <!-- Feedback Text -->
                    <div id="scale-feedback" class="absolute top-0 text-center w-full opacity-0 transition-opacity duration-500 pointer-events-none">
                        <span class="text-2xl font-serif text-[#00ced1]">Balance Found</span>
                    </div>
                </div>

                <!-- Status Panel (Right) -->
                <div class="bg-[#111] p-6 rounded-sm border border-[#222] h-full flex flex-col">
                    <div>
                        <h4 class="font-mono text-xs text-[#555] uppercase tracking-widest mb-6 border-b border-[#333] pb-2">Marc's State</h4>
                        <div class="space-y-4">
                            <div>
                                <div class="flex justify-between text-xs text-[#888] mb-1">Stress / Load</div>
                                <div class="w-full h-1 bg-[#222]">
                                    <div id="bar-stress" class="h-full bg-red-500 w-[0%] transition-all duration-500"></div>
                                </div>
                            </div>
                            <div>
                                <div class="flex justify-between text-xs text-[#888] mb-1">Fulfillment</div>
                                <div class="w-full h-1 bg-[#222]">
                                    <div id="bar-fulfillment" class="h-full bg-[#00ced1] w-[0%] transition-all duration-500"></div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- New Data Container -->
                    <div class="mt-8 mb-4 flex-1">
                        <h5 class="font-mono text-[10px] text-[#555] uppercase mb-3 flex items-center gap-2">
                             <i data-lucide="database" width="10"></i> Data Impact
                        </h5>
                        <ul id="active-sources-list" class="space-y-3 max-h-[100px] overflow-y-auto pr-2 custom-scrollbar">
                            <li class="text-[10px] text-[#444] italic border-l border-[#333] pl-2">
                                Drag an item onto the scale to see the statistical reality.
                            </li>
                        </ul>
                    </div>
                    
                    <div id="marc-reaction" class="mt-auto p-4 bg-black border border-[#333] text-sm text-[#888] italic font-serif text-center transition-all duration-500">
                        "Waiting for your choices..."
                    </div>
                </div>

            </div>
        </div>
    </section>

    

    <!-- 4. DATA POP-UP: "THE METROPOLITAN REFLUX" -->
    <section class="w-full py-24 bg-[#050505] relative overflow-hidden">
        <!-- Abstract Map Background -->
        <div class="absolute inset-0 opacity-10 pointer-events-none">
            <svg width="100%" height="100%">
                <pattern id="grid" width="40" height="40" patternUnits="userSpaceOnUse">
                    <path d="M 40 0 L 0 0 0 40" fill="none" stroke="#333" stroke-width="1"/>
                </pattern>
                <rect width="100%" height="100%" fill="url(#grid)" />
            </svg>
        </div>

        <div class="max-w-4xl mx-auto px-6 relative z-10 text-center">
            <div class="inline-block px-4 py-1 border border-[#333] bg-[#111] rounded-full mb-8">
                <span class="text-[#00ced1] text-xs font-mono uppercase tracking-widest flex items-center gap-2">
                    <i data-lucide="trending-up" width="14"></i> INSEE Data 2024
                </span>
            </div>

            <h3 class="text-3xl md:text-5xl font-serif text-white mb-12">The Calculation of Freedom</h3>

            <div class="grid md:grid-cols-2 gap-8 items-center">
                <!-- Paris Box -->
                <div class="bg-[#111] border border-[#222] p-8 relative group">
                    <div class="text-gray-500 font-mono text-xs uppercase mb-2">Paris (Inner City)</div>
                    <div class="text-4xl font-serif text-white mb-2"><?= number_format($stats['paris']['price'], 0, ',', ' ') ?> €<span class="text-sm text-gray-500">/m²</span></div>
                    <div class="h-1 w-full bg-[#222] mt-4 overflow-hidden">
                        <div class="h-full bg-gray-600 w-full"></div>
                    </div>
                    <p class="text-xs text-gray-500 mt-4 text-left">Impossible to invest. Salary goes into rent.</p>
                </div>

                <!-- Angers Box (Highlighted) -->
                <div class="bg-[#111] border border-[#00ced1] p-8 relative transform md:scale-110 shadow-[0_0_30px_rgba(0,206,209,0.1)]">
                    <div class="absolute -top-3 left-1/2 -translate-x-1/2 bg-[#00ced1] text-black text-[10px] font-bold px-2 py-1 uppercase tracking-widest">
                        Opportunity
                    </div>
                    <div class="text-[#00ced1] font-mono text-xs uppercase mb-2">Angers (Mid-size City)</div>
                    <div class="text-4xl font-serif text-white mb-2"><?= number_format($stats['angers']['price'], 0, ',', ' ') ?> €<span class="text-sm text-gray-500">/m²</span></div>
                    <div class="h-1 w-full bg-[#222] mt-4 overflow-hidden">
                        <div class="h-full bg-[#00ced1] w-[32%]"></div>
                    </div>
                    <p class="text-xs text-gray-400 mt-4 text-left">
                        <span class="text-white font-bold">3x cheaper.</span><br>
                        The savings fund the brewery project.
                    </p>
                </div>
            </div>

            <p class="mt-12 text-[#666] text-sm max-w-lg mx-auto italic">
                "Since 2020, mid-sized cities have been gaining inhabitants. These are mainly Parisian executives in search of meaning."
            </p>
        </div>
    </section>

    <!-- 5. CONCLUSION: "THE OPEN HORIZON" -->
    <section class="w-full h-screen relative flex items-center justify-center overflow-hidden">
        <!-- Background Image -->
        <div class="absolute inset-0">
            <img src="https://images.unsplash.com/photo-1514362545857-3bc16c4c7d1b?q=80&w=2070&auto=format&fit=crop" class="w-full h-full object-cover opacity-30 grayscale hover:grayscale-0 transition-all duration-[2s] ease-in-out" alt="Brewery Evening">
            <div class="absolute inset-0 bg-gradient-to-t from-[#0a0a0a] via-[#0a0a0a]/80 to-transparent"></div>
        </div>

        <div class="relative z-20 text-center max-w-3xl px-6">
            <i data-lucide="sunset" class="text-[#00ced1] mx-auto mb-6 opacity-80" width="48" height="48"></i>
            <h2 class="text-5xl md:text-7xl font-serif text-white mb-6">The Horizon is Open</h2>
            <p class="text-lg text-[#ccc] font-light mb-12">
                Marc closes his brewery. It's 7 PM. He is tired, but he is no longer saturated.<br>
                He lost purchasing power, but gained "being" power.
            </p>

            <div class="flex flex-col md:flex-row justify-center gap-6 mt-12">
                <a href="../" class="group px-8 py-4 border border-[#333] hover:border-[#00ced1] bg-black/80 backdrop-blur-md transition-all duration-300">
                    <span class="font-mono text-xs text-[#888] group-hover:text-[#00ced1] uppercase tracking-widest flex items-center gap-2">
                        <i data-lucide="users" width="14"></i> Browse another profile
                    </span>
                </a>
                
                <a href="../final.php" class="group px-8 py-4 bg-[#00ced1] text-black border border-[#00ced1] hover:bg-transparent hover:text-[#00ced1] transition-all duration-300">
                    <span class="font-mono text-xs font-bold uppercase tracking-widest flex items-center gap-2">
                        End navigation <i data-lucide="arrow-right" width="14"></i>
                    </span>
                </a>
            </div>
        </div>
    </section>

    <footer class="bg-[#020202] text-[#333] py-12 text-center text-xs border-t border-[#111] relative z-10 font-mono">
        <p class="tracking-widest uppercase mb-4 opacity-50">© 2026 Horizons - North Module</p>
        <div class="flex justify-center gap-6 items-center">
            <p>Produced by Peuvot Klara, Ledroit Léo, Mauclair Ethan</p>
            <span class="w-1 h-1 bg-[#00ced1] rounded-full"></span>
            <a href="../credits.php" class="text-[#666] hover:text-[#00ced1] flex items-center gap-2 transition-colors">
                <i data-lucide="file-text" width="12"></i>
                CREDITS
            </a>
        </div>
    </footer>

    <!-- SCRIPTS JS -->
    <script>
        // Init Icons
        lucide.createIcons();

        // --- DRAG & DROP LOGIC (Scale) ---
        // Variables stateless : we calculate on the fly
        
        function allowDrop(ev) {
            ev.preventDefault();
        }

        function drag(ev) {
            ev.dataTransfer.setData("text", ev.target.id);
            // No need to store weights in transfer, we read from DOM
        }
        // 3. NAVIGATION SCROLL
        function scrollToSection(id) {
            const element = document.getElementById(id);
            if (element) element.scrollIntoView({ behavior: 'smooth' });
        }

        // Add event listeners to draggable items
        document.querySelectorAll('.draggable-item').forEach(item => {
            item.addEventListener('dragstart', drag);
        });

        function drop(ev, dropTarget) {
            ev.preventDefault();
            var data = ev.dataTransfer.getData("text");
            var element = document.getElementById(data);
            
            // Mark time of drop to sort list later
            element.dataset.timestamp = Date.now();

            // Append the element to the drop target (Pan Left, Pan Right, or Pool)
            ev.currentTarget.appendChild(element);
            
            // Recalculate everything based on new positions
            updateBalance();
        }

        function updateBalance() {
            const arm = document.getElementById('balance-arm');
            const stressBar = document.getElementById('bar-stress');
            const fullBar = document.getElementById('bar-fulfillment');
            const reaction = document.getElementById('marc-reaction');
            const feedback = document.getElementById('scale-feedback');
            const panLeft = document.getElementById('pan-left');
            const panRight = document.getElementById('pan-right');
            const sourcesList = document.getElementById('active-sources-list');

            // 1. Calculate Weights dynamically from DOM
            let leftWeight = 0;
            let rightWeight = 0;
            let activeItems = [];

            // Sum children of left pan
            Array.from(panLeft.children).forEach(child => {
                if(child.dataset.weight) {
                    leftWeight += parseInt(child.dataset.weight);
                    activeItems.push(child);
                }
            });

            // Sum children of right pan
            Array.from(panRight.children).forEach(child => {
                if(child.dataset.weight) {
                    rightWeight += parseInt(child.dataset.weight);
                    activeItems.push(child);
                }
            });
            
            // SORT active items by TIMESTAMP descending (Newest first)
            activeItems.sort((a, b) => {
                return (b.dataset.timestamp || 0) - (a.dataset.timestamp || 0);
            });

            // 2. Rotation de la balance
            let angle = 0;
            const diff = leftWeight - rightWeight;
            angle = Math.max(-20, Math.min(20, diff * -0.2)); 
            
            arm.style.transform = `rotate(${angle}deg)`;

            // 3. Barres de statut
            let stressLvl = Math.min(100, (leftWeight / 100) * 100);
            stressBar.style.width = stressLvl + '%';

            let fullLvl = Math.min(100, (rightWeight / 100) * 100);
            fullBar.style.width = fullLvl + '%';

            // 4. Update Sources List
            sourcesList.innerHTML = "";
            if(activeItems.length === 0) {
                 sourcesList.innerHTML = '<li class="text-[10px] text-[#444] italic border-l border-[#333] pl-2">Drag an item onto the scale to see the statistical reality.</li>';
            } else {
                activeItems.forEach(item => {
                    const stat = item.dataset.stat;
                    const source = item.dataset.source;
                    const color = item.dataset.type === 'material' ? 'text-red-400' : 'text-[#00ced1]';
                    const li = document.createElement('li');
                    
                    // Add Highlight class to the very first item (newest)
                    const isNewest = (item === activeItems[0]);
                    const animClass = isNewest ? 'new-list-item' : '';
                    
                    li.className = `text-[10px] leading-relaxed border-l-2 pl-2 mb-2 ${animClass}`;
                    li.style.borderColor = item.dataset.type === 'material' ? '#ff4d4d' : '#00ced1';
                    li.innerHTML = `
                        <span class="text-[#ccc]">${stat}</span>
                        <br><span class="text-[9px] ${color} uppercase tracking-wider opacity-80">Source: ${source}</span>
                    `;
                    sourcesList.appendChild(li);
                });
            }

            // 5. Game Logic
            feedback.style.opacity = "0"; // Reset opacity

            if (leftWeight > 80 && rightWeight < 30) {
                // Burnout condition
                reaction.innerHTML = "<span class='text-red-500 font-bold'>WARNING!</span> Marc is saturated. Too much pressure, not enough meaning.";
                reaction.style.borderColor = "#ff4d4d";
                panLeft.style.borderColor = "#ff4d4d";
                panLeft.style.backgroundColor = "rgba(255, 77, 77, 0.1)";
            } else if (rightWeight > 50 && Math.abs(leftWeight - rightWeight) < 40) {
                // Win condition
                reaction.innerHTML = "<span class='text-[#00ced1] font-bold'>BALANCE FOUND!</span> Less money, but a life reclaimed.";
                reaction.style.borderColor = "#00ced1";
                feedback.style.opacity = "1";
                panLeft.style.borderColor = "#00ced1";
                panLeft.style.backgroundColor = "rgba(0, 206, 209, 0.1)";
            } else {
                reaction.innerHTML = "Marc is still looking for his way...";
                reaction.style.borderColor = "#333";
                panLeft.style.borderColor = "#00ced1"; // Reset color
                panLeft.style.backgroundColor = "rgba(0, 206, 209, 0.1)";
            }
        }

        // --- Split Screen Hover Effect on Mobile ---
        document.querySelectorAll('.split-panel').forEach(panel => {
            panel.addEventListener('click', () => {
                document.querySelectorAll('.split-panel').forEach(p => p.style.width = '50%');
                panel.style.width = '80%';
            });
        });

    </script>
</body>
</html>
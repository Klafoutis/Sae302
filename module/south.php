<?php
// --- DONNÉES (Transférées de React vers PHP) ---

$slides = [
    [
        'id' => 1,
        'url' => "https://www.mondedesgrandesecoles.fr/wp-content/uploads/l-ellipse-symbole-de-lutt-credit-conseil-departemental-de-laube-650x438.jpg",
        'alt' => "UTT Building",
        'caption' => "The UTT Campus - Symbol of Troyes"
    ],
    [
        'id' => 2,
        'url' => "https://www.utt.fr/medias/photo/grace-chiang-5-_1547821106909-jpg?ID_FICHE=4112",
        'alt' => "UTT Students",
        'caption' => "An ecosystem of future engineers"
    ],
    [
        'id' => 3,
        'url' => "https://www.immojeune.com/uploads/article/mainImage/colocation-ou-studio-image.jpg",
        'alt' => "Cozy shared flat",
        'caption' => "The shared flat, heart of social life"
    ]
];

$timelineEvents = [
    [
        'time' => "07:30", 
        'title' => "Departure", 
        'icon' => "map-pin", 
        'desc' => "Smooth car ride. No traffic jams, just the open road.", 
        'cost' => "30 € gas/month",
        'quote' => "INJEP: Cars account for 48% of distance traveled by 19-25 year olds due to lack of alternatives outside metropolises."
    ],
    [
        'time' => "12:00", 
        'title' => "Student Life", 
        'icon' => "user", 
        'desc' => "Immersion at UTT. Group projects and lunch at the dining hall.", 
        'cost' => "",
        'quote' => "Parcoursup: Only 22% of graduates change districts for studies. Mobility is 2x higher for executives' children."
    ],
    [
        'time' => "19:00", 
        'title' => "Crunch Time", 
        'icon' => "clock", 
        'desc' => "The microwave pace. Intense personal work until late evening.", 
        'cost' => "",
        'quote' => "Housing satisfaction (76.6% in shared flats) is statistically linked to higher exam success rates compared to precarious housing."
    ],
    [
        'time' => "21:00", 
        'title' => "The Cocoon", 
        'icon' => "heart", 
        'desc' => "Warm moments. Watching a movie with housemates to unwind.", 
        'cost' => "",
        'quote' => "OVE: 30.3% of students have forgone medical care due to financial reasons or lack of time."
    ],
];

$expensesData = [
    ['id' => 'rent', 'category' => "Rent (Shared Flat)", 'amount' => 420],
    ['id' => 'food', 'category' => "Food & Leisure", 'amount' => 300],
    ['id' => 'transport', 'category' => "Transport", 'amount' => 30]
];

// Insights data for JS
$insightsJson = json_encode([
    'rent' => "According to the Ministry of Higher Education, housing represents nearly half of a student's budget in France.",
    'food' => "According to national surveys, 30% of students forego leisure activities for financial reasons.",
    'transport' => "IGAS report: In rural areas, 1 in 2 young people have refused a job or training due to lack of transport."
]);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>South — Chloe</title>
    
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300;400;500;600&family=Playfair+Display:ital,wght@0,400;0,700;1,400&display=swap" rel="stylesheet">
    
    <script src="https://cdn.tailwindcss.com"></script>
    
    <script src="https://unpkg.com/lucide@latest"></script>
    
    <style>
        :root {
            --bg-deep: #0a0a0a;
            --text-main: #f0f0f0;
            --text-muted: #a0a0a0;
            --accent-earth: #cd853f;
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

        .cinematic-glow {
            box-shadow: 0 0 20px rgba(205, 133, 63, 0.15);
        }
        
        /* Styles appliqués via JS pour l'état actif du budget */
        .expense-btn[data-active="true"] {
            box-shadow: 0 0 15px rgba(205, 133, 63, 0.4);
            border-color: var(--accent-earth) !important;
            background-color: rgba(205, 133, 63, 0.05);
            color: #f0f0f0;
        }

        .glass-panel {
            background: rgba(255, 255, 255, 0.03);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.08);
        }

        /* Animations */
        @keyframes fadeInUp {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }
        
        @keyframes fadeIn {
            from { opacity: 0; }
            to { opacity: 1; }
        }

        @keyframes floatParticle {
            0% { transform: translateY(0) translateX(0); opacity: 0; }
            20% { opacity: 0.8; }
            80% { opacity: 0.6; }
            100% { transform: translateY(-100px) translateX(20px); opacity: 0; }
        }

        .animate-fade-in-up {
            animation: fadeInUp 1s ease-out forwards;
        }
        
        .animate-fade-in {
            animation: fadeIn 1s ease-out forwards;
        }
        
        .delay-700 {
            animation-delay: 700ms;
        }

        /* Slider Transitions */
        .slide-bg {
            transition: all 2000ms ease-in-out;
        }
    </style>
</head>
<body class="selection:bg-[#cd853f] selection:text-black">

    <div id="particles-container" class="fixed inset-0 pointer-events-none z-[1] overflow-hidden">
        </div>

    <nav class="fixed top-0 left-0 w-full z-50 flex justify-between items-center px-6 py-6 pointer-events-none">
        <a href="../" class="pointer-events-auto flex items-center gap-3 px-5 py-3 bg-[#0a0a0a]/60 backdrop-blur-xl border border-white/10 rounded-full text-[#f0f0f0] hover:text-[#cd853f] hover:border-[#cd853f]/50 transition-all duration-300 group shadow-lg hover:shadow-[0_0_15px_rgba(205,133,63,0.2)]">
            <div class="p-1 rounded-full bg-white/5 group-hover:bg-[#cd853f]/10 transition-colors">
                <i data-lucide="compass" width="16" class="group-hover:-rotate-45 transition-transform duration-700"></i>
            </div>
            <span class="font-medium text-xs tracking-[0.2em] uppercase hidden md:block opacity-90 group-hover:opacity-100">Compass</span>
        </a>
        
        <a href="../final.php" class="pointer-events-auto flex items-center gap-3 px-5 py-3 bg-[#0a0a0a]/60 backdrop-blur-xl border border-white/10 rounded-full text-[#f0f0f0] hover:text-[#cd853f] hover:border-[#cd853f]/50 transition-all duration-300 group shadow-lg hover:shadow-[0_0_15px_rgba(205,133,63,0.2)]">
            <span class="font-medium text-xs tracking-[0.2em] uppercase hidden md:block opacity-90 group-hover:opacity-100">Final Page</span>
            <div class="p-1 rounded-full bg-white/5 group-hover:bg-[#cd853f]/10 transition-colors group-hover:translate-x-1 transition-transform duration-500">
                <i data-lucide="arrow-right" width="16"></i>
            </div>
        </a>
    </nav>

    <div class="relative h-screen w-full overflow-hidden z-10 bg-[#0a0a0a]">
        <div id="slides-container">
            <?php foreach($slides as $index => $slide): ?>
                <div class="slide-bg absolute inset-0 <?php echo $index === 0 ? 'opacity-100 scale-105' : 'opacity-0 scale-100'; ?>" data-index="<?php echo $index; ?>">
                    <div class="absolute inset-0 bg-gradient-to-b from-[#0a0a0a]/30 via-transparent to-[#0a0a0a] z-10"></div>
                    <div class="absolute inset-0 bg-black/40 z-10 mix-blend-multiply"></div>
                    <img 
                        src="<?php echo $slide['url']; ?>" 
                        alt="<?php echo $slide['alt']; ?>" 
                        class="w-full h-full object-cover filter contrast-[1.1] desaturate-[0.2]"
                    />
                </div>
            <?php endforeach; ?>
        </div>

        <div class="absolute inset-0 z-20 flex flex-col justify-center items-center px-6 md:px-20 lg:px-32">
            <div class="max-w-4xl space-y-8 animate-fade-in-up -mt-24 md:-mt-32 drop-shadow-[0_2px_4px_rgba(0,0,0,0.8)] w-full"><br><br>
                <h1 class="text-xs md:text-sm font-medium tracking-[0.5em] uppercase text-[#cd853f] mb-4 text-center">
                    South — Chloe
                </h1>
                <h2 class="text-6xl md:text-8xl font-serif italic text-[#f0f0f0] drop-shadow-2xl leading-none tracking-tight text-center">
                    Life in the<br />Open Air
                </h2>
                <div class="w-24 h-[1px] bg-[#cd853f] mx-auto my-8 opacity-70"></div>
                <p class="text-lg md:text-xl font-light text-[#a0a0a0] tracking-wide max-w-2xl mx-auto text-center">
                    Troyes: 60,000 inhabitants.<br/>
                    <span class="text-[#f0f0f0]">For Chloe, this is where it all happens.</span>
                </p>
                
                <div class="flex flex-col items-center gap-6 mt-12">
                   
                   <button onclick="scrollToSection('testimony')" class="px-6 py-3 font-mono font-bold tracking-widest uppercase text-xs transition-all duration-300 flex items-center justify-center gap-2 relative overflow-hidden group clip-path-polygon bg-[#cd853f] text-black hover:bg-white hover:shadow-[0_0_20px_#cd853f]">
                     <span class="relative z-10 flex items-center gap-2">Begin with the testimony<i data-lucide="arrow-right" width="14"></i></span>
                     <div class="absolute inset-0 bg-white opacity-0 group-hover:opacity-20 transition-opacity duration-100"></div>
                   </button>
                </div>
            </div>
        </div>
        <div class="absolute bottom-10 left-1/2 -translate-x-1/2 flex flex-col items-center gap-2 z-30 opacity-50">
           <div class="w-[1px] h-12 bg-gradient-to-b from-[#cd853f] to-transparent"></div>
           <span class="font-mono text-[10px] text-[#cd853f]">SCROLL</span>
        </div>

        <div class="absolute bottom-5 left-0 right-0 z-30 flex justify-center gap-4" id="slide-indicators">
            <?php foreach($slides as $index => $slide): ?>
                <button 
                    onclick="setSlide(<?php echo $index; ?>)"
                    class="h-[5px] rounded-full transition-all duration-700 slide-indicator <?php echo $index === 0 ? 'w-16 bg-[#cd853f]' : 'w-4 bg-white/20 hover:bg-white/40'; ?>"
                ></button>
            <?php endforeach; ?>
        </div>
    </div>

    <section id="testimony" class="w-full py-20 md:py-32 px-4 md:px-8 relative overflow-hidden z-10 bg-black/20 border-t border-white/5">
        <div class="max-w-6xl mx-auto">
            <div class="flex flex-col md:flex-row items-end justify-between mb-12 border-b border-white/10 pb-6">
                <div>
                    <h3 class="text-3xl font-serif text-[#f0f0f0] mb-2">The Testimony</h3>
                    <p class="text-[#666] text-xs uppercase tracking-[0.2em]">Witness account</p>
                </div>
                <div class="hidden md:flex items-center gap-2 text-[#cd853f] text-xs uppercase tracking-widest animate-pulse">
                    <div class="w-2 h-2 bg-[#cd853f] rounded-full"></div>
                    Recording
                </div>
            </div>
            
            <div class="relative w-full aspect-video bg-[#050505] rounded-sm overflow-hidden shadow-[0_0_50px_rgba(0,0,0,0.8)] group cursor-pointer border border-white/5 hover:border-[#cd853f]/30 transition-colors duration-500">
                <video 
                    id="interview-video"
                    class="w-full h-full object-cover transition-all duration-1000 grayscale opacity-40 group-hover:opacity-60"
                    controls
                >
                    <source src="https://mmi24f12.mmi-troyes.fr/webdocumentaire/interview/chloe.mp4" type="video/mp4" />
                    Your browser does not support the video tag.
                </video>
                
                <div 
                    id="video-overlay"
                    class="absolute inset-0 flex items-center justify-center z-10" 
                    onclick="playVideo()"
                >
                    <div class="w-24 h-24 rounded-full border border-[#cd853f] flex items-center justify-center pl-1 backdrop-blur-sm group-hover:bg-[#cd853f] transition-all duration-500 group-hover:scale-110">
                        <i data-lucide="play" width="32" class="text-[#cd853f] group-hover:text-black transition-colors"></i>
                    </div>
                    
                    <div class="absolute bottom-16 left-8 pointer-events-none">
                        <p class="font-serif text-2xl text-[#f0f0f0] mb-1">Chloe: "I've found my place"</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section id="budget-section" class="w-full py-20 md:py-32 px-4 md:px-8 relative overflow-hidden z-10 bg-transparent">
        <div class="max-w-5xl mx-auto">
            <div class="text-center mb-16 space-y-4">
                <h3 class="text-4xl md:text-5xl font-serif text-[#f0f0f0]">Financial Balance</h3>
                <p class="text-[#a0a0a0] font-light tracking-wide">Click on the expenses to see the reality of Chloe's budget.</p>
            </div>

            <div class="grid md:grid-cols-2 gap-12 items-stretch">
                <div class="space-y-8">
                    <div class="glass-panel p-6 rounded-sm flex items-center justify-between group">
                        <div class="flex items-center gap-4">
                            <div class="p-3 bg-[#cd853f]/10 rounded-full text-[#cd853f]">
                                <i data-lucide="euro" width="20"></i>
                            </div>
                            <div>
                                <h4 class="font-medium text-[#f0f0f0] tracking-wide">Monthly Income</h4>
                                <p class="text-xs text-[#a0a0a0] uppercase tracking-wider mt-1">Parents + Housing Aid</p>
                            </div>
                        </div>
                        <div class="font-serif text-2xl text-[#cd853f]">850 €</div>
                    </div>
                    
                    <div class="w-full h-[1px] bg-gradient-to-r from-transparent via-[#ffffff]/10 to-transparent"></div>
                    
                    <div class="space-y-4">
                        <p class="text-xs font-medium text-[#cd853f] uppercase tracking-[0.2em] mb-6 pl-1">Monthly Expenses</p>
                        
                        <?php foreach($expensesData as $expense): ?>
                            <button 
                                onclick="toggleExpense('<?php echo $expense['id']; ?>', <?php echo $expense['amount']; ?>, this)"
                                class="w-full text-left p-6 rounded-sm border transition-all duration-500 group relative overflow-hidden expense-btn bg-white/[0.02] border-white/5 hover:bg-white/[0.04] text-[#a0a0a0]"
                                data-active="false"
                            >
                                <div class="flex justify-between items-center relative z-10">
                                    <span class="font-light tracking-wide group-hover:text-[#f0f0f0] transition-colors">
                                        <?php echo $expense['category']; ?>
                                    </span>
                                    <span class="expense-price font-medium font-serif text-lg text-[#555]">
                                        —
                                    </span>
                                </div>
                            </button>
                        <?php endforeach; ?>
                    </div>
                </div>

                <div class="glass-panel p-8 rounded-sm relative flex flex-col justify-center min-h-[400px]">
                    <div id="paris-alert" class="absolute top-0 left-0 w-full transition-all duration-700 transform -translate-y-4 opacity-0 pointer-events-none">
                        <div class="bg-red-900/20 border-b border-red-500/30 p-3 text-center">
                            <span class="text-red-400 text-xs font-bold tracking-[0.2em] uppercase" style="text-shadow: 0 0 10px rgba(248, 113, 113, 0.5);">
                                Paris Comparison: -300 € Deficit
                            </span>
                        </div>
                    </div>

                    <div class="text-center mb-12 relative z-10">
                        <span class="text-7xl font-serif text-[#f0f0f0] tracking-tighter block mb-2">
                            <span id="remaining-display">850</span> <span class="text-3xl text-[#cd853f] stroke-1">€</span>
                        </span>
                        <p id="budget-label" class="text-[#a0a0a0] text-xs uppercase tracking-[0.2em]">
                            Starting Budget
                        </p>
                    </div>

                    <div class="relative h-1 bg-[#222] w-full mb-8">
                        <div 
                            id="progress-bar"
                            class="absolute top-0 left-0 h-full bg-[#cd853f] transition-all duration-1000 ease-out shadow-[0_0_10px_#cd853f]"
                            style="width: 100%"
                        ></div>
                    </div>
                    
                    <div class="flex justify-between text-xs text-[#555] font-mono mb-8">
                        <span id="total-spent-display">SPENT: 0 €</span>
                        <span>SAVINGS</span>
                    </div>

                    <div class="min-h-[80px] flex items-center justify-center border-t border-white/5 pt-6">
                        <p id="insight-display" class="text-[#333] text-xs italic">Select an expense category...</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="w-full py-20 md:py-32 px-4 md:px-8 relative overflow-hidden z-10 bg-black/40 border-t border-white/5">
        <div class="max-w-5xl mx-auto">
            <div class="text-center mb-24">
                <h3 class="text-4xl md:text-5xl font-serif text-[#f0f0f0]">The Microwave Pace</h3>
                <p class="text-[#a0a0a0] font-light mt-4 tracking-wide text-sm">A chosen intensity, from dawn till night.</p>
            </div>

            <div class="relative">
                <div class="absolute left-[20px] top-0 bottom-0 w-[1px] bg-white/10 md:left-1/2 md:-ml-[0.5px]"></div>
                
                <div 
                    id="timeline-thread"
                    class="absolute left-[20px] top-0 w-[1px] bg-[#cd853f] md:left-1/2 md:-ml-[0.5px] transition-all duration-1000 ease-in-out shadow-[0_0_8px_#cd853f]"
                    style="height: 0%"
                ></div>

                <div class="space-y-20">
                    <?php foreach($timelineEvents as $index => $event): ?>
                        <div 
                            onclick="setTimeline(<?php echo $index; ?>)"
                            class="relative pl-12 md:pl-0 md:flex md:items-center cursor-pointer group timeline-item"
                            data-index="<?php echo $index; ?>"
                        >
                            <div class="timeline-node absolute left-[13px] top-1 md:left-1/2 md:-translate-x-1/2 w-4 h-4 rounded-full border border-[#0a0a0a] z-20 transition-all duration-500 bg-[#333]"></div>
                            
                            <div class="timeline-time-container md:w-1/2 md:pr-16 md:text-right mb-2 md:mb-0 transition-all duration-500 opacity-40 blur-[1px]">
                                <span class="timeline-time text-3xl font-serif block text-[#555]">
                                    <?php echo $event['time']; ?>
                                </span>
                                <span class="text-xs font-bold text-[#a0a0a0] tracking-[0.2em] uppercase mt-1 block">
                                    <?php echo $event['title']; ?>
                                </span>
                            </div>

                            <div class="md:w-1/2 md:pl-16">
                                <div class="timeline-card p-8 border-l-2 transition-all duration-700 ease-out relative border-[#333] bg-transparent translate-x-4 opacity-40">
                                    <div class="flex items-center gap-3 mb-4">
                                        <div class="timeline-icon text-[#555]">
                                            <i data-lucide="<?php echo $event['icon']; ?>" width="18"></i>
                                        </div>
                                    </div>
                                    
                                    <p class="text-[#d0d0d0] font-light leading-relaxed">
                                        <?php echo $event['desc']; ?>
                                    </p>
                                    
                                    <?php if($event['cost']): ?>
                                        <div class="mt-4 inline-block">
                                            <span class="text-xs font-mono text-[#cd853f] border border-[#cd853f]/30 px-3 py-1 rounded-sm">
                                                <?php echo $event['cost']; ?>
                                            </span>
                                        </div>
                                    <?php endif; ?>

                                    <div class="timeline-quote grid transition-all duration-700 ease-in-out grid-rows-[0fr] opacity-0">
                                        <div class="overflow-hidden">
                                            <div class="mt-6 pt-6 border-t border-white/5">
                                                <p class="text-sm font-serif italic text-[#a0a0a0] leading-loose">
                                                            <?php echo $event['quote']; ?>
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
    </section>

    

    <section class="w-full py-20 md:py-32 px-4 md:px-8 relative overflow-hidden z-10 bg-transparent border-t border-white/5">
        <div class="max-w-6xl mx-auto flex flex-col md:flex-row items-center gap-24">
            
            <div class="md:w-1/2 space-y-8">
                <h3 class="text-5xl md:text-6xl font-serif text-[#f0f0f0] leading-none">
                    The Price of<br/><span class="text-[#cd853f] italic">Grounding</span>
                </h3>
                <div class="w-16 h-[1px] bg-[#cd853f]"></div>
                <p class="text-xl text-[#d0d0d0] font-light leading-relaxed">
                    "Successfully grounding oneself also means accepting latency with those left behind."
                </p>
                <div class="glass-panel p-6 border-l-2 border-[#cd853f]">
                    <p class="text-[#a0a0a0] leading-relaxed text-sm">
                        <span class="font-bold text-[#f0f0f0] block mb-2 uppercase tracking-wide text-xs">Social Rupture</span> 
                        Social and geographic mobility often create a disconnection from original peer groups. Adopting new codes to integrate into engineering school creates a "gap" with those who stayed behind.
                    </p>
                </div>
            </div>

            <div class="md:w-1/2 flex justify-center">
                <div class="w-[320px] h-[640px] bg-[#1a1a1a] rounded-[3rem] p-4 shadow-[0_0_40px_rgba(0,0,0,0.8)] border border-[#333] relative">
                    <div class="w-full h-full bg-[#0a0a0a] rounded-[2.2rem] overflow-hidden flex flex-col relative border border-white/5">
                        
                        <div class="bg-[#111] p-6 pt-12 border-b border-white/5 flex justify-between items-center">
                            <span class="font-bold text-lg text-[#f0f0f0]">Chats</span>
                            <div class="p-2 bg-[#cd853f]/10 rounded-full">
                                <i data-lucide="message-circle" width="18" class="text-[#cd853f]"></i>
                            </div>
                        </div>

                        <div class="flex-1 overflow-y-auto">
                            <div class="p-5 border-b border-white/5 flex gap-4">
                                <div class="w-12 h-12 bg-[#222] rounded-full flex items-center justify-center text-[#555] shrink-0">
                                    <i data-lucide="phone" width="20"></i>
                                </div>
                                <div class="flex-1 min-w-0">
                                    <div class="flex justify-between mb-1">
                                        <span class="font-medium text-[#e0e0e0]">Mom & Dad</span>
                                        <span class="text-[10px] text-[#555] font-bold uppercase">Yesterday</span>
                                    </div>
                                    <p class="text-sm text-[#777] truncate">We got the photos, kisses!</p>
                                </div>
                            </div>

                            <div class="p-5 border-b border-white/5 flex gap-4">
                                <div class="w-12 h-12 bg-[#cd853f]/20 rounded-full flex items-center justify-center text-[#cd853f] font-bold shrink-0 border border-[#cd853f]/30">
                                    U
                                </div>
                                <div class="flex-1 min-w-0">
                                    <div class="flex justify-between mb-1">
                                        <span class="font-medium text-[#e0e0e0]">UTT Class of '26</span>
                                        <span class="text-[10px] text-[#cd853f] font-bold uppercase">14:02</span>
                                    </div>
                                    <p class="text-sm text-[#f0f0f0] font-medium truncate">Lunch at the cafeteria?</p>
                                </div>
                            </div>

                            <div class="p-5 border-b border-white/5 flex gap-4 opacity-50 group">
                                <div class="w-12 h-12 bg-[#151515] rounded-full flex items-center justify-center text-[#333] shrink-0 border border-white/5">
                                    <i data-lucide="user" width="20"></i>
                                </div>
                                <div class="flex-1 min-w-0 relative">
                                    <div class="flex justify-between mb-1">
                                        <span class="font-medium text-[#777] ">Toulouse Friends</span>
                                        <span class="text-[10px] text-red-900 font-bold border border-red-900/50 px-1 rounded text-red-500">4m</span>
                                    </div>
                                    <p class="text-sm text-[#444] truncate">The party was so good...</p>
                                </div>
                            </div>
                        </div>

                        <div class="p-4 bg-[#111] border-t border-white/5 flex justify-around text-[#333]">
                            <i data-lucide="message-circle" width="24" class="text-[#cd853f] drop-shadow-[0_0_5px_rgba(205,133,63,0.5)]"></i>
                            <i data-lucide="phone" width="24"></i>
                            <i data-lucide="user" width="24"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="w-full py-24 px-6 relative z-20 bg-transparent text-center">

    <div class="flex flex-col md:flex-row justify-center gap-6">
                <a href="../" class="group px-8 py-4 border border-[#333] hover:border-[#cd853f] bg-black/80 backdrop-blur-md transition-all duration-300">
                    <span class="font-mono text-xs text-[#888] group-hover:text-[#cd853f] uppercase tracking-widest flex items-center gap-2">
                        <i data-lucide="users" width="14"></i> Browse another profile
                    </span>
                </a>
                
                <a href="../final.php" class="group px-8 py-4 bg-[#cd853f] text-black border border-[#cd853f] hover:bg-transparent hover:text-[#cd853f] transition-all duration-300">
                    <span class="font-mono text-xs font-bold uppercase tracking-widest flex items-center gap-2">
                        End navigation <i data-lucide="arrow-right" width="14"></i>
                    </span>
                </a>
            </div>
    </section>

    <footer class="bg-[#050505] text-[#444] py-12 text-center text-xs border-t border-white/5 relative z-10">
        <p class="tracking-widest uppercase mb-4 opacity-50">© 2026 Horizons - South Module</p>
        <div class="flex justify-center gap-6 items-center">
            <p>Produced by Peuvot Klara, Ledroit Léo, Mauclair Ethan</p>
            <span class="w-1 h-1 bg-[#333] rounded-full"></span>
            <a href="../credits.php" class="text-[#666] hover:text-[#cd853f] flex items-center gap-2 transition-colors group">
                <i data-lucide="file-text" width="12" class="group-hover:scale-110 transition-transform"></i>
                CREDITS
            </a>
        </div>
    </footer>

    <script>
        // Initialize Icons
        lucide.createIcons();

        // --- 1. PARTICLE BACKGROUND ---
        document.addEventListener('DOMContentLoaded', () => {
            const container = document.getElementById('particles-container');
            for(let i = 0; i < 50; i++) {
                const p = document.createElement('div');
                const size = Math.random() * 2 + 0.5;
                const duration = Math.random() * 15 + 15;
                
                p.className = 'absolute rounded-full bg-[#cd853f] blur-[0.5px]';
                p.style.left = Math.random() * 100 + '%';
                p.style.top = Math.random() * 100 + '%';
                p.style.width = size + 'px';
                p.style.height = size + 'px';
                p.style.opacity = '0';
                p.style.animation = `floatParticle ${duration}s linear infinite`;
                p.style.animationDelay = Math.random() * 5 + 's';
                p.style.boxShadow = `0 0 ${size * 1.5}px #cd853f`;
                
                container.appendChild(p);
            }
        });
        // 3. NAVIGATION SCROLL
        function scrollToSection(id) {
            const element = document.getElementById(id);
            if (element) element.scrollIntoView({ behavior: 'smooth' });
        }

        // --- 2. HERO SLIDER ---
        let currentSlide = 0;
        const slides = document.querySelectorAll('.slide-bg');
        const indicators = document.querySelectorAll('.slide-indicator');
        const totalSlides = slides.length;

        function updateSlides() {
            slides.forEach((slide, index) => {
                if(index === currentSlide) {
                    slide.classList.remove('opacity-0', 'scale-100');
                    slide.classList.add('opacity-100', 'scale-105');
                } else {
                    slide.classList.remove('opacity-100', 'scale-105');
                    slide.classList.add('opacity-0', 'scale-100');
                }
            });

            indicators.forEach((ind, index) => {
                if(index === currentSlide) {
                    ind.classList.remove('w-4', 'bg-white/20');
                    ind.classList.add('w-16', 'bg-[#cd853f]');
                } else {
                    ind.classList.remove('w-16', 'bg-[#cd853f]');
                    ind.classList.add('w-4', 'bg-white/20');
                }
            });
        }

        function setSlide(index) {
            currentSlide = index;
            updateSlides();
        }

        setInterval(() => {
            currentSlide = (currentSlide + 1) % totalSlides;
            updateSlides();
        }, 6000);

        function scrollToContent() {
            document.getElementById('budget-section').scrollIntoView({ behavior: 'smooth' });
        }

        // --- 3. BUDGET LOGIC ---
        const initialBudget = 850;
        let activeExpenses = []; 
        const totalExpenseCount = <?php echo count($expensesData); ?>;
        const insights = <?php echo $insightsJson; ?>;

        function toggleExpense(id, amount, btnElement) {
            const isActive = btnElement.getAttribute('data-active') === 'true';
            const priceSpan = btnElement.querySelector('.expense-price');

            if (isActive) {
                // Deactivate
                btnElement.setAttribute('data-active', 'false');
                activeExpenses = activeExpenses.filter(e => e.id !== id);
                
                // Styles Reset
                btnElement.classList.remove('active-glow', 'bg-[#cd853f]/5', 'text-[#f0f0f0]');
                btnElement.classList.add('bg-white/[0.02]', 'border-white/5', 'text-[#a0a0a0]');
                priceSpan.textContent = '—';
                priceSpan.classList.remove('text-[#cd853f]');
                priceSpan.classList.add('text-[#555]');
            } else {
                // Activate
                btnElement.setAttribute('data-active', 'true');
                activeExpenses.push({ id: id, amount: amount });
                
                // Styles Active
                btnElement.classList.add('active-glow', 'bg-[#cd853f]/5', 'text-[#f0f0f0]');
                btnElement.classList.remove('bg-white/[0.02]', 'border-white/5', 'text-[#a0a0a0]');
                priceSpan.textContent = amount + ' €';
                priceSpan.classList.add('text-[#cd853f]');
                priceSpan.classList.remove('text-[#555]');

                // Insight Update
                const insightDisplay = document.getElementById('insight-display');
                insightDisplay.innerHTML = `<span class="text-[#cd853f] mr-2">/</span>${insights[id]}`;
                insightDisplay.className = "text-sm text-[#d0d0d0] font-light leading-relaxed text-center animate-fade-in";
            }

            updateBudgetUI();
        }

        function updateBudgetUI() {
            const totalSpent = activeExpenses.reduce((sum, item) => sum + item.amount, 0);
            const remaining = initialBudget - totalSpent;

            document.getElementById('remaining-display').textContent = remaining;
            document.getElementById('total-spent-display').textContent = `SPENT: ${totalSpent} €`;
            
            const label = document.getElementById('budget-label');
            label.textContent = activeExpenses.length > 0 ? "Remaining Balance" : "Starting Budget";

            const percent = Math.max(0, (remaining / initialBudget) * 100);
            document.getElementById('progress-bar').style.width = percent + "%";

            // Paris Alert
            const alert = document.getElementById('paris-alert');
            if (activeExpenses.length === totalExpenseCount) {
                alert.classList.remove('-translate-y-4', 'opacity-0', 'pointer-events-none');
                alert.classList.add('translate-y-0', 'opacity-100');
            } else {
                alert.classList.add('-translate-y-4', 'opacity-0', 'pointer-events-none');
                alert.classList.remove('translate-y-0', 'opacity-100');
            }
        }

        // --- 4. TIMELINE LOGIC ---
        let activeTimeIndex = 0;
        const timelineItems = document.querySelectorAll('.timeline-item');
        const timelineThread = document.getElementById('timeline-thread');
        const timelineCount = timelineItems.length;

        function setTimeline(index) {
            activeTimeIndex = index;
            updateTimelineUI();
        }

        function updateTimelineUI() {
            // Update line height
            const percent = (activeTimeIndex / (timelineCount - 1)) * 100;
            timelineThread.style.height = percent + "%";

            timelineItems.forEach((item, index) => {
                const isActive = index === activeTimeIndex;
                
                // Elements
                const node = item.querySelector('.timeline-node');
                const timeContainer = item.querySelector('.timeline-time-container');
                const timeText = item.querySelector('.timeline-time');
                const card = item.querySelector('.timeline-card');
                const icon = item.querySelector('.timeline-icon');
                const quote = item.querySelector('.timeline-quote');

                if (isActive) {
                    // Node
                    node.classList.remove('bg-[#333]');
                    node.classList.add('bg-[#cd853f]', 'scale-150', 'shadow-[0_0_15px_#cd853f]');
                    
                    // Time
                    timeContainer.classList.remove('opacity-40', 'blur-[1px]');
                    timeContainer.classList.add('opacity-100');
                    timeText.classList.remove('text-[#555]');
                    timeText.classList.add('text-[#cd853f]');

                    // Card
                    card.classList.remove('border-[#333]', 'bg-transparent', 'translate-x-4', 'opacity-40');
                    card.classList.add('border-[#cd853f]', 'bg-gradient-to-r', 'from-[#cd853f]/5', 'to-transparent', 'translate-x-0', 'opacity-100');
                    
                    // Icon
                    icon.classList.remove('text-[#555]');
                    icon.classList.add('text-[#cd853f]');

                    // Quote
                    quote.classList.remove('grid-rows-[0fr]', 'opacity-0');
                    quote.classList.add('grid-rows-[1fr]', 'opacity-100', 'mt-6', 'pt-6');

                } else {
                    // Reset to default
                    node.classList.add('bg-[#333]');
                    node.classList.remove('bg-[#cd853f]', 'scale-150', 'shadow-[0_0_15px_#cd853f]');

                    timeContainer.classList.add('opacity-40', 'blur-[1px]');
                    timeContainer.classList.remove('opacity-100');
                    timeText.classList.add('text-[#555]');
                    timeText.classList.remove('text-[#cd853f]');

                    card.classList.add('border-[#333]', 'bg-transparent', 'translate-x-4', 'opacity-40');
                    card.classList.remove('border-[#cd853f]', 'bg-gradient-to-r', 'from-[#cd853f]/5', 'to-transparent', 'translate-x-0', 'opacity-100');

                    icon.classList.add('text-[#555]');
                    icon.classList.remove('text-[#cd853f]');

                    quote.classList.add('grid-rows-[0fr]', 'opacity-0');
                    quote.classList.remove('grid-rows-[1fr]', 'opacity-100', 'mt-6', 'pt-6');
                }
            });
        }
        
        // Init Timeline state
        updateTimelineUI();

        // --- 5. VIDEO LOGIC ---
        function playVideo() {
            const video = document.getElementById('interview-video');
            const overlay = document.getElementById('video-overlay');
            
            video.play();
            video.classList.remove('grayscale', 'opacity-40', 'group-hover:opacity-60');
            video.classList.add('filter-none');
            overlay.classList.add('hidden');
        }

        const observerOptions = {
            root: null, // viewport par défaut
            rootMargin: '-50% 0px -50% 0px', // Active l'élément quand il est EXACTEMENT au centre
            threshold: 0
        };

        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    const index = parseInt(entry.target.getAttribute('data-index'));
                    
                    // On vérifie si l'index est valide avant de mettre à jour
                    if (!isNaN(index)) {
                        setTimeline(index);
                    }
                }
            });
        }, observerOptions);

        // On lance l'observation sur chaque item de la timeline
        timelineItems.forEach(item => {
            observer.observe(item);
        });

    </script>
</body>
</html>
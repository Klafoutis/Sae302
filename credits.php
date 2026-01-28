<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Credits & Resources — Horizons</title>

    <!-- Fonts used across all modules -->
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

        /* Section dividers */
        .divider {
            height: 1px;
            background: linear-gradient(90deg, transparent, #333, transparent);
            margin: 2rem 0;
        }

        /* Hover effects for links */
        .credit-link {
            transition: all 0.3s ease;
            border-bottom: 1px solid transparent;
        }
        .credit-link:hover {
            color: white;
            border-bottom: 1px solid #fff;
        }
    </style>
</head>
<body class="selection:bg-white selection:text-black">

    <!-- Navigation (Back to Home) -->
    <nav class="fixed top-0 left-0 w-full z-50 flex justify-between items-center px-6 py-6 pointer-events-none">
        <a href="index.php" class="pointer-events-auto flex items-center gap-3 px-5 py-3 bg-[#0a0a0a]/80 backdrop-blur-xl border border-white/10 rounded-full text-[#f0f0f0] hover:bg-white hover:text-black transition-all duration-300 group shadow-lg">
            <div class="p-1 rounded-full bg-white/5 group-hover:bg-black/10 transition-colors">
                <i data-lucide="arrow-left" width="16"></i>
            </div>
            <span class="font-medium text-xs tracking-[0.2em] uppercase hidden md:block opacity-90">Back to Map</span>
        </a>
    </nav>

    <div class="max-w-4xl mx-auto px-6 py-24 md:py-32 relative z-10">
        
        <!-- Header -->
        <div class="text-center mb-16">
            <h1 class="text-4xl md:text-6xl font-serif italic mb-4">Credits & Documentation</h1>
            <p class="text-[#888] font-mono text-xs uppercase tracking-widest">Sources, Assets & Acknowledgments</p>
            <div class="w-16 h-[1px] bg-white/20 mx-auto mt-8"></div>
        </div>

        <!-- 1. DATA SOURCES & REPORTS -->
        <section class="mb-16">
            <div class="flex items-center gap-3 mb-8">
                <i data-lucide="book-open" class="text-white"></i>
                <h2 class="text-2xl font-serif">Data & Sociology Reports</h2>
            </div>
            
            <div class="grid md:grid-cols-2 gap-6">
                <!-- Data from East (Clément) -->
                <div class="bg-[#111] p-6 border border-[#222] rounded-sm">
                    <h3 class="text-[#ffe600] font-mono text-xs uppercase mb-4 tracking-widest">East Module Data</h3>
                    <ul class="space-y-4 text-sm text-[#ccc]">
                        <a href="https://www.insee.fr/fr/statistiques/8324188" class="flex flex-col hover:underline">
                            <span class="font-bold text-white">Parcoursup / INSEE</span>
                            <span class="text-[#666] text-xs">Data on student channeling towards metropolises.</span>
                        </a>
                        <a href="https://www.insee.fr/fr/statistiques/7649921" class="flex flex-col hover:underline">
                            <span class="font-bold text-white">INSEE (State of Higher Education)</span>
                            <span class="text-[#666] text-xs">Statistics on student housing budgets in Paris vs Province.</span>
                        </a>
                        <a href="https://www.insee.fr/fr/statistiques/8256596" class="flex flex-col hover:underline">
                            <span class="font-bold text-white">INSEE</span>
                            <span class="text-[#666] text-xs">Post-2020 Demographic Analyses regarding medium-sized cities.</span>
                        </a>
                        <a href="https://www.ove-national.education.fr/" class="flex flex-col hover:underline">
                            <span class="font-bold text-white">OVE (Observatoire de la Vie Étudiante)</span>
                            <span class="text-[#666] text-xs">Working students (including those on work-study programmes) are twice as likely to report difficulties balancing their personal lives and studies.</span>
                        </a>
                    </ul>
                </div>

                <!-- Data from West (Sarah) -->
                <div class="bg-[#111] p-6 border border-[#222] rounded-sm">
                    <h3 class="text-[#ff4d4d] font-mono text-xs uppercase mb-4 tracking-widest">West Module Data</h3>
                    <ul class="space-y-4 text-sm text-[#ccc]">
                        <a href="https://www.permisecole.com/actualites/prix-permis-de-conduire-2025" class="flex flex-col hover:underline">
                            <span class="font-bold text-white">Permis de conduire 2025</span>
                            <span class="text-[#666] text-xs">The price of a driver's license in 2025</span>
                        </a>
                        <a href="https://injep.fr/publication/les-difficultes-de-transport-un-frein-a-lemploi-pour-un-quart-des-jeunes/" class="flex flex-col hover:underline">
                            <span class="font-bold text-white">INJEP</span>
                            <span class="text-[#666] text-xs">The transport difficulties of young people looking for employment</span><span class="text-[#666] text-xs"></span>
                        </a>
                        <a href="https://www.statistiques.developpement-durable.gouv.fr/exploitation-de-donnees-relatives-lenquete-mobilite-des-personnes-emp-2026" class="flex flex-col hover:underline">
                            <span class="font-bold text-white">DEVELOPPEMENT DURABLE</span>
                            <span class="text-[#666] text-xs">The survey on public transport usage in rural zones (3%)</span>
                        </a>
                        <a href="https://www.igas.gouv.fr/sites/igas/files/2025-01/Rapport%20Igas%20-%20Pauvreté%20et%20conditions%20de%20vie%20des%20jeunes%20dans%20le%20monde%20rural%20%28rapport%29.pdf" class="flex flex-col hover:underline">
                            <span class="font-bold text-white">IGAS</span>
                            <span class="text-[#666] text-xs">The survey on poverty and living conditions of young people in rural zones</span>
                        </a>
                        <a href="https://injep.fr/publication/vivre-chez-ses-parents-en-partir-y-revenir/" class="flex flex-col hover:underline">
                            <span class="font-bold text-white">INJEP</span>
                            <span class="text-[#666] text-xs">Living with parents, in departing and returning to them</span>
                        </a>
                    </ul>
                </div>

                <!-- Data from South (Chloe) -->
                <div class="bg-[#111] p-6 border border-[#222] rounded-sm">
                    <h3 class="text-[#cd853f] font-mono text-xs uppercase mb-4 tracking-widest">South Module Data</h3>
                    <ul class="space-y-4 text-sm text-[#ccc]">
                    <a href="https://www.enseignementsup-recherche.gouv.fr/" class="flex flex-col hover:underline">
                            <span class="font-bold text-white">Ministry of Higher Education</span>
                            <span class="text-[#666] text-xs">student accommodation conditions</span>
                        </a>    
                    <a href="https://www.ove-national.education.fr/publications/" class="flex flex-col hover:underline">
                            <span class="font-bold text-white">OVE (Observatoire de la Vie Étudiante)</span>
                            <span class="text-[#666] text-xs">The precise figures on giving up leisure activities are detailed in the sections on "Leisure activities" and "Financial difficulties".</span>
                        </a>
                        <a href="https://www.igas.gouv.fr/sites/igas/files/2025-01/Rapport%20Igas%20-%20Pauvreté%20et%20conditions%20de%20vie%20des%20jeunes%20dans%20le%20monde%20rural%20%28rapport%29.pdf" class="flex flex-col hover:underline">
                            <span class="font-bold text-white">IGAS (Inspection Générale des Affaires Sociales)</span>
                            <span class="text-[#666] text-xs">Poverty and living conditions of young people in rural areas</span>
                        </a>
                        <a href="https://www.ccomptes.fr/sites/default/files/2025-03/20250319-RPA2025-volume1-mobilite-des-jeunes-en%20transports-collectifs.pdf" class="flex flex-col hover:underline">
                            <span class="font-bold text-white">CCOMPTES</span>
                            <span class="text-[#666] text-xs">The CCOMPTES survey on public transport usage in rural zones</span>
                        </a>
                        <a href="https://www.insee.fr/fr/statistiques/8305552" class="flex flex-col hover:underline">
                            <span class="font-bold text-white">INSEE</span>
                            <span class="text-[#666] text-xs">22% academic mobility is a constant observed in Parcoursup reports.</span>
                        </a>
                        <a href="https://www.ove-national.education.fr/publications/" class="flex flex-col hover:underline">
                            <span class="font-bold text-white">OVE (Observatoire de la Vie Étudiante)</span>
                            <span class="text-[#666] text-xs">Living conditions and success: the influence of housing</span>
                        </a>
                        <a href="https://www.ove-national.education.fr/wp-content/uploads/2024/05/OVE-Reperes-Bien-etre-Sante-2024.pdf" class="flex flex-col hover:underline">
                            <span class="font-bold text-white">OVE (Observatoire de la Vie Étudiante)</span>
                            <span class="text-[#666] text-xs">Student Well-being and Health Survey</span>
                        </a>
                        <a href="https://www.ove-national.education.fr/wp-content/uploads/2024/05/OVE-Reperes-Bien-etre-Sante-2024.pdf" class="flex flex-col hover:underline">
                            <span class="font-bold text-white">OVE (Observatoire de la Vie Étudiante)</span>
                            <span class="text-[#666] text-xs">Student Well-being and Health Survey</span>
                        </a>
                    </ul>
                </div>

                

                <!-- Data from North (Placeholder) -->
                <div class="bg-[#111] p-6 border border-[#222] rounded-sm">
                    <h3 class="text-[#60a5fa] font-mono text-xs uppercase mb-4 tracking-widest">North Module Data</h3>
                    <ul class="space-y-4 text-sm text-[#ccc]">
                        <a href="https://www.audencia.com/actualites/enquete-sur-la-quete-de-sens-au-travail" class="flex flex-col hover:underline">
                            <span class="font-bold text-white">Audencia</span>
                            <span class="text-[#666] text-xs">French employees and the search for meaning at work</span>
                        </a>
                        <a href="https://www.grouperandstad.fr/wp-content/uploads/2023/01/randstad-workmonitor2023.pdf" class="flex flex-col hover:underline">
                            <span class="font-bold text-white">Randstad</span>
                            <span class="text-[#666] text-xs">Randstad Workmonitor 2023</span>
                        </a>
                        <a href="https://corporate.apec.fr/toutes-nos-etudes?selectFilter=6648f7d8-b80c-47c5-b794-0fbcda20702c&sortname=date&sortaction=descending" class="flex flex-col hover:underline">
                            <span class="font-bold text-white">APEC</span>
                            <span class="text-[#666] text-xs">Recruitment intentions and expectations of executives</span>
                        </a>
                        <a href="https://www.anact.fr/qualite-de-vie-et-des-conditions-de-travail" class="flex flex-col hover:underline">
                            <span class="font-bold text-white">ANACT</span>
                            <span class="text-[#666] text-xs">Quality of life and working conditions</span>
                        </a>
                        <a href="https://www.deloitte.com/fr/fr/about/press-room/generation-z-et-les-milleniaux.html" class="flex flex-col hover:underline">
                            <span class="font-bold text-white">Deloitte</span>
                            <span class="text-[#666] text-xs">A triptych of money, meaning and wellbeing in pursuit of development</span>
                        </a>
                        <a href="https://www.santepubliquefrance.fr/maladies-et-traumatismes/maladies-liees-au-travail" class="flex flex-col hover:underline">
                            <span class="font-bold text-white">Sante Publique France</span>
                            <span class="text-[#666] text-xs">Occupational diseases</span>
                        </a>
                        <a href="https://www.insee.fr/fr/statistiques/8256596" class="flex flex-col hover:underline">
                            <span class="font-bold text-white">INSEE</span>
                            <span class="text-[#666] text-xs">Post-2020 Demographic Analyses regarding medium-sized cities</span>
                        </a>
                    </ul>
                </div>
            </div>
        </section>

        <div class="divider"></div>

        <!-- 2. EXTERNAL MEDIA ASSETS -->
        <section class="mb-16">
            <div class="flex items-center gap-3 mb-8">
                <i data-lucide="image" class="text-white"></i>
                <h2 class="text-2xl font-serif">External Media Assets</h2>
            </div>

            <div class="bg-[#111] border border-[#222] rounded-sm overflow-hidden">
                <table class="w-full text-left text-sm text-[#ccc]">
                    <thead class="bg-[#000] text-[#666] font-mono text-xs uppercase">
                        <tr>
                            <th class="p-4 font-normal">Asset Description</th>
                            <th class="p-4 font-normal">Source / Origin</th>
                            <th class="p-4 font-normal">Usage</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-[#222]">
                        <!-- HOME PAGE -->
                        <tr class="hover:bg-[#1a1a1a]">
                            <td class="p-4">Atmospheric Earth Background</td>
                            <td class="p-4"><a href="https://unsplash.com/photos/earth-from-space-43490279c0fa" target="_blank" class="credit-link">Unsplash (NASA / Library)</a></td>
                            <td class="p-4 text-white font-bold">Homepage</td>
                        </tr>

                        <!-- MODULES -->
                        <tr class="hover:bg-[#1a1a1a]">
                            <td class="p-4">UTT Campus Aerial View</td>
                            <td class="p-4"><a href="https://www.mondedesgrandesecoles.fr" target="_blank" class="credit-link">Monde des Grandes Ecoles</a></td>
                            <td class="p-4 text-[#cd853f]">South Module</td>
                        </tr>
                        <tr class="hover:bg-[#1a1a1a]">
                            <td class="p-4">Student Life / Campus</td>
                            <td class="p-4"><a href="https://www.utt.fr" target="_blank" class="credit-link">Université de Technologie de Troyes</a></td>
                            <td class="p-4 text-[#cd853f]">South Module</td>
                        </tr>
                        <tr class="hover:bg-[#1a1a1a]">
                            <td class="p-4">Shared Apartment Interior</td>
                            <td class="p-4"><a href="https://www.immojeune.com" target="_blank" class="credit-link">ImmoJeune</a></td>
                            <td class="p-4 text-[#cd853f]">South Module</td>
                        </tr>
                        <tr class="hover:bg-[#1a1a1a]">
                            <td class="p-4">Beer Background</td>
                            <td class="p-4"><a href="https://www.pexels.com/fr-fr/video/barre-boire-jaune-verre-5538284/" target="_blank" class="credit-link">Pexels</a></td>
                            <td class="p-4 text-[#60a5fa]">North Module</td>
                        </tr>
                        <tr class="hover:bg-[#1a1a1a]">
                            <td class="p-4">Cocktail Background</td>
                            <td class="p-4"><a href="https://images.unsplash.com/photo-1514362545857-3bc16c4c7d1b?q=80&w=2070&auto=format&fit=crop" target="_blank" class="credit-link">Pexels</a></td>
                            <td class="p-4 text-[#60a5fa]">North Module</td>
                        </tr>
                        <tr class="hover:bg-[#1a1a1a]">
                            <td class="p-4">East Background</td>
                            <td class="p-4"><a href="https://clement-regazzoni.fr/portfolio/" target="_blank" class="credit-link">Clément Regazzoni</a></td>
                            <td class="p-4 text-[#ffe600]">East Module</td>
                        </tr>
                        
                        
                        <!-- Textures -->
                        <tr class="hover:bg-[#1a1a1a]">
                            <td class="p-4">Carbon Fibre Pattern</td>
                            <td class="p-4"><a href="https://www.transparenttextures.com" target="_blank" class="credit-link">Transparent Textures</a></td>
                            <td class="p-4 text-[#ffe600]">East Module</td>
                        </tr>
                        <tr class="hover:bg-[#1a1a1a]">
                            <td class="p-4">Foggy Birds Pattern</td>
                            <td class="p-4"><a href="https://www.transparenttextures.com" target="_blank" class="credit-link">Transparent Textures</a></td>
                            <td class="p-4 text-[#60a5fa]">North Module</td>
                        </tr>
                        <tr class="hover:bg-[#1a1a1a]">
                            <td class="p-4">Diagmonds Light Pattern</td>
                            <td class="p-4"><a href="https://www.transparenttextures.com" target="_blank" class="credit-link">Transparent Textures</a></td>
                            <td class="p-4 text-[#ff4d4d]">West Module</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </section>

        <div class="divider"></div>

        <!-- 3. TECH STACK & INTERFACE -->
        <section class="mb-16">
            <div class="flex items-center gap-3 mb-8">
                <i data-lucide="code" class="text-white"></i>
                <h2 class="text-2xl font-serif">Tech Stack & Interface</h2>
            </div>
            
            <div class="grid grid-cols-2 md:grid-cols-3 gap-4 text-center">
                <div class="p-4 border border-[#222] bg-[#0a0a0a] rounded hover:border-white/20 transition-colors">
                    <span class="block font-bold text-white mb-1">Tailwind CSS</span>
                    <span class="text-xs text-[#666]">Styling Framework</span>
                </div>
                <div class="p-4 border border-[#222] bg-[#0a0a0a] rounded hover:border-white/20 transition-colors">
                    <span class="block font-bold text-white mb-1">Lucide</span>
                    <span class="text-xs text-[#666]">Icon Library</span>
                </div>
                <div class="p-4 border border-[#222] bg-[#0a0a0a] rounded hover:border-white/20 transition-colors">
                    <span class="block font-bold text-white mb-1">Google Fonts</span>
                    <span class="text-xs text-[#666]">Montserrat / Playfair / Share Tech</span>
                </div>
                <div class="p-4 border border-[#222] bg-[#0a0a0a] rounded hover:border-white/20 transition-colors">
                    <span class="block font-bold text-white mb-1">Interactive Compass</span>
                    <span class="text-xs text-[#666]">Custom JS (Homepage)</span>
                </div>
                <div class="p-4 border border-[#222] bg-[#0a0a0a] rounded hover:border-white/20 transition-colors">
                    <span class="block font-bold text-white mb-1">Background Generator</span>
                    <span class="text-xs text-[#666]">Custom CSS Filters</span>
                </div>
                <div class="p-4 border border-[#222] bg-[#0a0a0a] rounded hover:border-white/20 transition-colors">
                    <span class="block font-bold text-white mb-1">PHP</span>
                    <span class="text-xs text-[#666]">Data Injection</span>
                </div>
            </div>
        </section>

        <!-- 4. ACKNOWLEDGMENTS -->
        <section class="text-center bg-[#111] p-12 border border-[#222] rounded-lg">
            <i data-lucide="heart" class="mx-auto text-[#ff4d4d] mb-4" width="32"></i>
            <h2 class="text-2xl font-serif text-white mb-4">Acknowledgments</h2>
            <p class="text-[#888] mb-6 max-w-lg mx-auto leading-relaxed">
                Special thanks to <strong class="text-white">Clément</strong>, <strong class="text-white">Chloe</strong>, <strong class="text-white">Sarah</strong>, and <strong class="text-white">Marc</strong> for sharing their stories, their data, and their honesty about their student life path.
            </p>
            <p class="text-xs font-mono text-[#555]">
                Produced by Peuvot Klara, Ledroit Léo, Mauclair Ethan — 2026
            </p>
        </section>

    </div>

    <script>
        lucide.createIcons();
    </script>
</body>
</html>
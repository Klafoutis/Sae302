<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Horizons — Le Verdict</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300;400;500;600;700&family=Share+Tech+Mono&family=Playfair+Display:ital,wght@0,400;1,400&display=swap" rel="stylesheet">
    
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://unpkg.com/lucide@latest"></script>

    <style>
        :root {
            --bg: #050505;
            --text: #e5e5e5;
            
            /* Couleurs Personnages */
            --c-sarah: #ff4d4d;   /* West */
            --c-clement: #ffe600; /* East */
            --c-marc: #00ced1;    /* North */
            --c-chloe: #cd853f;   /* South */
        }

        body {
            background-color: var(--bg);
            color: var(--text);
            font-family: 'Montserrat', sans-serif;
            overflow: hidden;
            height: 100vh;
            display: flex;
            flex-direction: column;
        }

        .font-mono { font-family: 'Share Tech Mono', monospace; }
        .font-serif { font-family: 'Playfair Display', serif; }

        /* --- FADERS --- */
        .fader-track {
            position: relative;
            width: 2px;
            height: 420px;
            background: rgba(255,255,255,0.1);
            margin: 0 auto;
            transition: all 0.3s;
        }
        .fader-group:hover .fader-track { width: 4px; background: rgba(255,255,255,0.2); }

        .fader-fill {
            position: absolute;
            bottom: 0; left: 0; width: 100%;
            background: var(--color);
            box-shadow: 0 0 20px var(--color);
            transition: height 0.05s linear;
        }

        input[type=range][orient=vertical] {
            writing-mode: bt-lr;
            -webkit-appearance: slider-vertical;
            width: 80px;
            height: 100%;
            opacity: 0;
            position: absolute; top: 0; left: 50%; transform: translateX(-50%);
            z-index: 20;
            cursor: ns-resize;
        }

        .fader-handle {
            position: absolute;
            left: -6px; right: -6px; height: 10px;
            background: white;
            box-shadow: 0 0 10px white;
            pointer-events: none;
            z-index: 10;
            transition: bottom 0.05s linear;
        }

        /* --- HUD PERSONNAGE (Bulle Info) --- */
        .fader-hud {
            position: absolute;
            left: 40px; top: auto; width: 320px;
            background: rgba(10,10,10,0.95);
            border-left: 4px solid var(--color);
            padding: 16px;
            pointer-events: none;
            z-index: 50;
            opacity: 0;
            transform: translateY(50%);
            transition: opacity 0.2s, bottom 0.05s linear;
            box-shadow: 20px 20px 60px rgba(0,0,0,0.9);
            display: flex;
            flex-direction: column;
            gap: 10px;
        }
        .fader-group:hover .fader-hud { opacity: 1; }

        .hud-char { font-family: 'Share Tech Mono', monospace; color: var(--color); font-size: 12px; letter-spacing: 2px; text-transform: uppercase; display: flex; justify-content: space-between; border-bottom: 1px solid rgba(255,255,255,0.1); padding-bottom: 4px; }
        
        .hud-story { 
            font-family: 'Playfair Display', serif; 
            font-style: italic; 
            color: #fff; 
            font-size: 15px; 
            line-height: 1.5; 
        }
        
        .hud-official { 
            font-family: 'Montserrat', sans-serif; 
            font-size: 9px; 
            color: #888; 
            background: rgba(255,255,255,0.05); 
            padding: 8px; 
            border-radius: 4px; 
            display: flex; 
            gap: 8px; 
            align-items: center; 
        }

        /* --- MATCH SCORE --- */
        .char-match-bar {
            height: 4px;
            background: #222;
            width: 100%;
            margin-top: 4px;
            position: relative;
        }
        .char-match-fill {
            height: 100%;
            background: var(--c);
            width: 0%;
            transition: width 0.5s ease;
        }

        /* Scanlines */
        .scanlines {
            background: repeating-linear-gradient(to bottom, transparent 0px, transparent 2px, rgba(0,0,0,0.4) 3px);
            position: fixed; inset: 0; pointer-events: none; z-index: 0;
        }
    </style>
</head>
<body class="selection:bg-white selection:text-black">

    <div class="scanlines"></div>

    <nav class="relative z-50 w-full px-8 py-5 flex justify-between items-center border-b border-white/5 bg-[#050505]">
        <div class="flex items-center gap-4">
            <div class="w-2 h-2 bg-white rounded-full shadow-[0_0_10px_white]"></div>
            <div>
                <h1 class="font-mono text-xs uppercase tracking-widest text-white">Horizons <span class="text-[#666]">// Character Sync</span></h1>
            </div>
        </div>
        <div>
        <a href="credits.php" class="text-[10px] font-mono text-[#666] hover:text-white uppercase tracking-widest border border-[#333] px-4 py-2 mx-2 hover:bg-[#222] transition-all rounded">
            Crédits
        </a>
        <a href="index.php" class="text-[10px] font-mono text-[#666] hover:text-white uppercase tracking-widest border border-[#333] px-4 py-2 mx-2 hover:bg-[#222] transition-all rounded">
            Quitter
        </a>
        </div>
    </nav>

    <div class="relative z-10 flex-1 grid grid-cols-1 lg:grid-cols-12 h-full">

        <div class="lg:col-span-5 bg-[#080808] border-r border-white/5 p-8 flex flex-col justify-center relative z-20">
            
            <div class="mb-8 pl-4 border-l-2 border-white/20">
                <h2 class="text-2xl font-serif text-white mb-1">Paramètres de Vie</h2>
                <p class="text-xs text-[#666] font-mono">Alignez vos choix sur ceux des personnages.</p>
            </div>

            <div class="flex justify-between px-2 w-full max-w-xl mx-auto h-[500px]">
                
                <div class="fader-group relative flex flex-col items-center h-full group" style="--color: var(--c-sarah)">
                    <div class="fader-track">
                        <div class="fader-fill" id="fill-west" style="height: 20%"></div>
                        <div class="fader-handle" id="handle-west" style="bottom: 20%"></div>
                        <input type="range" orient="vertical" id="vol-west" min="0" max="100" value="20" oninput="updateMatrix()">
                        
                        <div class="fader-hud" id="hud-west" style="bottom: 20%">
                            <div class="hud-char"><span>SARAH (Ouest)</span> <span id="pct-west">20%</span></div>
                            <div class="hud-story" id="story-west">...</div>
                            <div class="hud-official">
                                <i data-lucide="file-text" width="12" class="text-[#ff4d4d]"></i> 
                                <span id="data-west">...</span>
                            </div>
                        </div>
                    </div>
                    <span class="mt-4 font-mono text-[9px] text-[#555] group-hover:text-[#ff4d4d] transition-colors">CONTRAINTE</span>
                </div>

                <div class="fader-group relative flex flex-col items-center h-full group" style="--color: var(--c-clement)">
                    <div class="fader-track">
                        <div class="fader-fill" id="fill-east" style="height: 50%"></div>
                        <div class="fader-handle" id="handle-east" style="bottom: 50%"></div>
                        <input type="range" orient="vertical" id="vol-east" min="0" max="100" value="50" oninput="updateMatrix()">
                        
                        <div class="fader-hud" id="hud-east" style="bottom: 50%">
                            <div class="hud-char"><span>CLÉMENT (Est)</span> <span id="pct-east">50%</span></div>
                            <div class="hud-story" id="story-east">...</div>
                            <div class="hud-official">
                                <i data-lucide="file-text" width="12" class="text-[#ffe600]"></i> 
                                <span id="data-east">...</span>
                            </div>
                        </div>
                    </div>
                    <span class="mt-4 font-mono text-[9px] text-[#555] group-hover:text-[#ffe600] transition-colors">AMBITION</span>
                </div>

                <div class="fader-group relative flex flex-col items-center h-full group" style="--color: var(--c-marc)">
                    <div class="fader-track">
                        <div class="fader-fill" id="fill-north" style="height: 50%"></div>
                        <div class="fader-handle" id="handle-north" style="bottom: 50%"></div>
                        <input type="range" orient="vertical" id="vol-north" min="0" max="100" value="50" oninput="updateMatrix()">
                        
                        <div class="fader-hud" id="hud-north" style="bottom: 50%">
                            <div class="hud-char"><span>MARC (Nord)</span> <span id="pct-north">50%</span></div>
                            <div class="hud-story" id="story-north">...</div>
                            <div class="hud-official">
                                <i data-lucide="file-text" width="12" class="text-[#00ced1]"></i> 
                                <span id="data-north">...</span>
                            </div>
                        </div>
                    </div>
                    <span class="mt-4 font-mono text-[9px] text-[#555] group-hover:text-[#00ced1] transition-colors">SENS</span>
                </div>

                <div class="fader-group relative flex flex-col items-center h-full group" style="--color: var(--c-chloe)">
                    <div class="fader-track">
                        <div class="fader-fill" id="fill-south" style="height: 50%"></div>
                        <div class="fader-handle" id="handle-south" style="bottom: 50%"></div>
                        <input type="range" orient="vertical" id="vol-south" min="0" max="100" value="50" oninput="updateMatrix()">
                        
                        <div class="fader-hud" id="hud-south" style="bottom: 50%">
                            <div class="hud-char"><span>CHLOÉ (Sud)</span> <span id="pct-south">50%</span></div>
                            <div class="hud-story" id="story-south">...</div>
                            <div class="hud-official">
                                <i data-lucide="file-text" width="12" class="text-[#cd853f]"></i> 
                                <span id="data-south">...</span>
                            </div>
                        </div>
                    </div>
                    <span class="mt-4 font-mono text-[9px] text-[#555] group-hover:text-[#cd853f] transition-colors">AFFECT</span>
                </div>

            </div>
        </div>

        <div class="lg:col-span-7 bg-[#050505] flex flex-col p-12 relative overflow-y-auto">
            
            <div id="ambient-glow" class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-[60%] h-[60%] bg-white rounded-full blur-[200px] opacity-5 pointer-events-none transition-colors duration-1000"></div>

            <div class="relative z-10 flex-1 flex flex-col justify-center max-w-4xl mx-auto">
                
                <div class="grid grid-cols-4 gap-4 mb-12 opacity-80">
                    <div>
                        <div class="flex justify-between text-[9px] text-[#888] uppercase mb-1"><span>Sarah</span><span id="score-sarah">0%</span></div>
                        <div class="char-match-bar"><div id="bar-sarah" class="char-match-fill" style="--c: var(--c-sarah)"></div></div>
                    </div>
                    <div>
                        <div class="flex justify-between text-[9px] text-[#888] uppercase mb-1"><span>Clément</span><span id="score-clement">0%</span></div>
                        <div class="char-match-bar"><div id="bar-clement" class="char-match-fill" style="--c: var(--c-clement)"></div></div>
                    </div>
                    <div>
                        <div class="flex justify-between text-[9px] text-[#888] uppercase mb-1"><span>Marc</span><span id="score-marc">0%</span></div>
                        <div class="char-match-bar"><div id="bar-marc" class="char-match-fill" style="--c: var(--c-marc)"></div></div>
                    </div>
                    <div>
                        <div class="flex justify-between text-[9px] text-[#888] uppercase mb-1"><span>Chloé</span><span id="score-chloe">0%</span></div>
                        <div class="char-match-bar"><div id="bar-chloe" class="char-match-fill" style="--c: var(--c-chloe)"></div></div>
                    </div>
                </div>

                <i data-lucide="quote" class="text-[#222] mb-6 transform scale-x-[-1]" width="48"></i>
                
                <div id="manifesto" class="font-serif text-xl md:text-2xl text-[#ccc] leading-relaxed transition-all duration-200 min-h-[150px]">
                    </div>

                <div id="scenario-box" class="mt-8 p-6 border border-white/10 bg-[#0a0a0a] relative overflow-hidden">
                    <div class="absolute top-0 left-0 w-1 h-full bg-white transition-colors duration-500" id="scenario-border"></div>
                    <span class="text-[9px] text-[#666] font-mono uppercase block mb-3">SCÉNARIO PROJETÉ</span>
                    <p class="text-white text-sm leading-relaxed" id="scenario-text">...</p>
                    <div class="mt-4 pt-4 border-t border-[#222] text-[10px] text-[#555] font-mono italic" id="scenario-source">
                        Donnée de référence : ...
                    </div>
                </div>

                <div class="mt-12 flex justify-between items-end opacity-0 transition-opacity" id="signature-block">
                    <div>
                        <span class="text-[9px] text-[#666] font-mono uppercase block mb-1">PROFIL DOMINANT</span>
                        <span id="archetype-name" class="text-white font-mono text-sm tracking-widest uppercase border border-white/20 px-3 py-1 bg-white/5">...</span>
                    </div>
                    <button onclick="window.print()" class="text-white hover:text-[#cd853f] transition-colors flex gap-2 text-xs font-mono uppercase items-center">
                        <i data-lucide="save" width="14"></i> Enregistrer
                    </button>
                </div>
            </div>
        </div>

    </div>

    <script>
        lucide.createIcons();

        // --- 1. HISTOIRES ET DONNÉES ---
        // CORRECTION MAJEURE ICI : Les données suivent la logique 0->100
        // Sarah (West) : 0 = Libre, 100 = Bloqué
        const DB = {
            west: [
                { s: "\"Je suis partie. Je ne regarde plus le rétroviseur.\"", d: "SDES: Hyper-mobilité active pour 15% des ruraux." }, // 0-25% (Pas Sarah)
                { s: "\"J'ai enfin ma voiture. C'est un gouffre financier, mais je respire.\"", d: "INJEP: La voiture = 20% du budget jeune actif." },
                { s: "\"Le bus passe deux fois par jour. Si je le rate, ma journée est finie.\"", d: "Sénat: 40% des jeunes ruraux sans autonomie." },
                { s: "\"J'ai dû refuser ce stage car je n'ai personne pour m'y emmener.\"", d: "IGAS: 46% renoncent à l'emploi faute de permis." } // 75-100% (Full Sarah)
            ],
            east: [
                { s: "\"Je préfère mon temps libre à un gros salaire. Je ne ferai pas comme mon père.\"", d: "DARES: Le temps libre est devenu le critère #1." },
                { s: "\"Un salaire honnête pour une vie honnête.\"", d: "INSEE: Salaire médian France ~1850€." },
                { s: "\"Je dors 4h par nuit. La concurrence est rude, mais je grimpe.\"", d: "APEC: +75% des postes cadres sont en métropole." },
                { s: "\"Je suis au sommet. Je ne vois plus ma famille, mais j'ai réussi.\"", d: "Stratégie: Concentration des richesses (Top 1%)." }
            ],
            north: [
                { s: "\"Je suis vide à l'intérieur. Metro, boulot, dodo.\"", d: "Santé Pub: +30% de risque burnout en open space." },
                { s: "\"Est-ce que mon travail sert à quelque chose ? Je doute.\"", d: "YouGov: 44% de perte de sens (Brown-out)." },
                { s: "\"Je cherche un job qui ne détruit pas la planète.\"", d: "Shift Project: La quête écologique monte chez les cadres." },
                { s: "\"J'élève des chèvres en Lozère. Je suis pauvre, mais vivant.\"", d: "Impact: 85% des néo-ruraux ne regrettent pas." }
            ],
            south: [
                { s: "\"Je ne connais même pas le nom de mes voisins de palier.\"", d: "CREDOC: 24% d'isolement relationnel en ville." },
                { s: "\"Je rentre voir ma mère tous les week-ends, j'ai besoin de ça.\"", d: "SNCF: Flux pendulaires hebdo en hausse." },
                { s: "\"Je vis dans la maison où je suis née. C'est ma force.\"", d: "Baromètre: 60% vivent à <50km des parents." },
                { s: "\"Ma tribu est ici. Pourquoi aller chercher le bonheur ailleurs ?\"", d: "Socio: Le capital social local protège des crises." }
            ]
        };

        // --- 2. LOGIQUE DU BACKEND ---
        function updateMatrix() {
            const vW = parseInt(document.getElementById('vol-west').value);
            const vE = parseInt(document.getElementById('vol-east').value);
            const vN = parseInt(document.getElementById('vol-north').value);
            const vS = parseInt(document.getElementById('vol-south').value);

            updateFaderUI('west', vW);
            updateFaderUI('east', vE);
            updateFaderUI('north', vN);
            updateFaderUI('south', vS);

            // CORRECTION SCORE : Le score est maintenant directement la valeur du slider
            document.getElementById('bar-sarah').style.width = vW + '%';
            document.getElementById('score-sarah').innerText = vW + '%';
            
            document.getElementById('bar-clement').style.width = vE + '%';
            document.getElementById('score-clement').innerText = vE + '%';
            
            document.getElementById('bar-marc').style.width = vN + '%';
            document.getElementById('score-marc').innerText = vN + '%';
            
            document.getElementById('bar-chloe').style.width = vS + '%';
            document.getElementById('score-chloe').innerText = vS + '%';

            // Narration
            const max = Math.max(vW, vE, vN, vS);
            let archetype = "EXPLORATEUR";
            let narrative = "Ajustez les paramètres pour définir votre profil...";

            // On vérifie si un profil se détache (>60%)
            if (max > 10) { 
                if(max === vE && vE > 60) {
                    narrative = "Vous résonnez avec <span class='text-[#ffe600] font-bold'>Clément</span>. L'ambition est votre moteur, la ville votre terrain de chasse. Vous acceptez le sacrifice pour la réussite.";
                    archetype = "L'AMBITIEUX";
                } else if(max === vN && vN > 60) {
                    narrative = "Vous vibrez comme <span class='text-[#00ced1] font-bold'>Marc</span>. Vous cherchez à fuir l'absurdité du système. Le sens prime sur le confort matériel.";
                    archetype = "LE SAGE";
                } else if(max === vS && vS > 60) {
                    narrative = "Vous êtes proche de <span class='text-[#cd853f] font-bold'>Chloé</span>. La famille et les racines passent avant tout le reste. Votre force vient de votre stabilité.";
                    archetype = "LE GARDIEN";
                } else if(max === vW && vW > 60) {
                    narrative = "Vous partagez la peine de <span class='text-[#ff4d4d] font-bold'>Sarah</span>. Le territoire vous retient. Vous sentez que votre potentiel est bridé par votre géographie.";
                    archetype = "LE CAPTIF";
                } else {
                    narrative = "Vous êtes une synthèse unique. Vous empruntez un peu à chacun, cherchant votre propre équilibre.";
                    archetype = "L'ÉQUILIBRISTE";
                }
            }

            document.getElementById('manifesto').innerHTML = narrative;
            document.getElementById('archetype-name').innerText = archetype;
            document.getElementById('archetype-name').style.color = getDominantColor(vW, vE, vN, vS);

            // Scénario & Apparitions
            const scen = getScenario(vW, vE, vN, vS);
            document.getElementById('scenario-text').innerText = scen.text;
            document.getElementById('scenario-source').innerText = scen.src;
            document.getElementById('scenario-border').style.backgroundColor = scen.color;

            document.getElementById('scenario-box').style.opacity = '1';
            document.getElementById('scenario-box').style.transform = 'translateY(0)';
            document.getElementById('signature-block').style.opacity = '1';
            document.getElementById('ambient-glow').style.backgroundColor = getDominantColor(vW, vE, vN, vS);
        }

        // --- 3. SCÉNARIOS CROISÉS CORRIGÉS ---
        function getScenario(w, e, n, s) {
            // CORRECTION LOGIQUE : w élevé = Sarah (Bloqué)
            
            // Clément (Ambition) + Sarah (Bloqué) -> Frustration
            if(e > 70 && w > 70) {
                return {
                    text: "Comme Clément, vous visez haut, mais comme Sarah, vous êtes bloqué. Vous décrochez un entretien prestigieux, mais faute de voiture fiable, vous arrivez en retard et ratez l'opportunité.",
                    src: "Source: Fracture territoriale (CGET) - Le talent vs la mobilité",
                    color: "#ff4d4d"
                };
            }
            // Marc (Sens) + Chloé (Racines) -> Le Refuge
            if(n > 70 && s > 70) {
                return {
                    text: "Vous suivez la voie de la sagesse. Après un début de carrière stressant, vous démissionnez pour reprendre un commerce dans votre ville natale. Vos revenus baissent, mais votre anxiété disparaît.",
                    src: "Source: Phénomène de l'Exode Urbain (POPSU)",
                    color: "#00ced1"
                };
            }
            // Clément (Ambition) + Marc (Sens) -> La Crise
            if(e > 80 && n > 80) {
                return {
                    text: "Le conflit interne est violent. Vous montez très vite dans votre entreprise (Clément), avant de réaliser que vous détestez ce que vous êtes devenu (Marc). À 35 ans, c'est la rupture.",
                    src: "Source: Crise de la quarantaine précoce (APEC)",
                    color: "#ffe600"
                };
            }
            // Sarah (Bloqué) + Chloé (Racines) -> La Cage Dorée
            if(w > 70 && s > 80) {
                return {
                    text: "Le confort du nid familial (Chloé) et le manque de transport (Sarah) créent une inertie puissante. Vous ne partez jamais. Vous êtes en sécurité, mais vous vous demanderez toujours 'Et si ?'.",
                    src: "Source: Sédentarité subie vs choisie (INJEP)",
                    color: "#cd853f"
                };
            }
            return {
                text: "Déplacez les curseurs vers les extrêmes pour voir comment les destins se croisent.",
                src: "En attente de données...",
                color: "#444"
            };
        }

        function updateFaderUI(id, val) {
            document.getElementById(`fill-${id}`).style.height = val + '%';
            document.getElementById(`handle-${id}`).style.bottom = val + '%';
            document.getElementById(`hud-${id}`).style.bottom = val + '%';
            document.getElementById(`pct-${id}`).innerText = val + '%';

            // Index mapping sécurisé (0 à 3)
            let index = 0;
            if(val >= 25) index = 1;
            if(val >= 50) index = 2;
            if(val >= 75) index = 3;

            const d = DB[id][index];
            document.getElementById(`story-${id}`).innerText = d.s;
            document.getElementById(`data-${id}`).innerText = d.d;
        }

        function getDominantColor(w, e, n, s) {
            const max = Math.max(w, e, n, s);
            if(max === w) return 'var(--c-sarah)';
            if(max === e) return 'var(--c-clement)';
            if(max === n) return 'var(--c-marc)';
            return 'var(--c-chloe)';
        }

        // Init au chargement (valeurs à 0)
        window.addEventListener('load', () => updateMatrix());

    </script>
</body>
</html>
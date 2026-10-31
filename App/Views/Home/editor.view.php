<aside class="chapters panel" id="outline" aria-labelledby="chapters-title">
    <div class="panel-heading">
        <h2 id="chapters-title">Kapitoly</h2>
        <button class="icon-button" type="button" aria-label="Pridať kapitolu">+</button>
    </div>
    <ol class="chapter-list">
        <li><a href="#editor"><span>1.</span> Začiatok cesty</a></li>
        <li><a href="#editor"><span>2.</span> Starý les</a></li>
        <li class="selected">
            <a href="#editor" aria-current="location"><span>3.</span> Stretnutie</a>
            <ul>
                <li><a href="#editor">Scéna 1 <span class="status done">hotová</span></a></li>
                <li><a href="#editor">Scéna 2 <span class="status draft">koncept</span></a></li>
            </ul>
        </li>
    </ol>
    <button class="add-chapter" type="button">+ Pridať kapitolu</button>
</aside>

<main class="editor panel" id="editor">
    <div class="chapter-toolbar">
        <div>
            <span class="eyebrow">Kapitola 3</span>
            <h1>Stretnutie</h1>
        </div>
        <button class="close-button" type="button" aria-label="Zavrieť kapitolu">×</button>
    </div>

    <div class="format-toolbar" aria-label="Formátovanie textu">
        <button type="button" aria-label="Tučné písmo"><strong>B</strong></button>
        <button type="button" aria-label="Kurzíva"><em>I</em></button>
        <button type="button" aria-label="Zoznam">• Zoznam</button>
        <span class="save-state">Uložené</span>
    </div>

    <label class="visually-hidden" for="chapter-text">Text kapitoly</label>
    <textarea id="chapter-text" spellcheck="false">Cesta sa pred Elenou strácala medzi vysokými stromami. Zastavila sa a započúvala do ticha lesa.

Zrazu začula za sebou prasknutie vetvičky.

„Kto je tam?“ spýtala sa a obrátila sa k tmavému chodníku.</textarea>
    <p class="editor-hint">Pokračujte v písaní svojej kapitoly…</p>
</main>

<aside class="inspector panel" id="research" aria-labelledby="inspector-title">
    <h2 id="inspector-title">Rýchly náhľad</h2>
    <p class="inspector-caption">Podklady k projektu</p>
    <a class="inspector-link active" href="#characters">Postavy <span>3</span></a>
    <a class="inspector-link" href="#objects">Predmety <span>2</span></a>
    <a class="inspector-link" href="#notes">Poznámky <span>4</span></a>
    <div class="inspector-note" id="characters">
        <span class="note-label">Postava v kapitole</span>
        <strong>Elena</strong>
        <p>Mladá cestovateľka, ktorá hľadá cestu domov.</p>
    </div>
</aside>

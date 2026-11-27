class WorldEntityBrowser {
    constructor(root) {
        this.root = root;
        this.list = document.querySelector('[data-world-list]');
        this.search = root.querySelector('[data-world-search]');
        this.typeFilter = root.querySelector('[data-world-type]');
        this.sortSelect = root.querySelector('[data-world-sort]');
        this.countOutput = root.querySelector('[data-world-count]');
        this.emptyMessage = document.querySelector('[data-world-empty]');
        this.cards = this.list ? Array.from(this.list.querySelectorAll('[data-world-card]')) : [];
        this.originalOrder = new Map(this.cards.map((card, index) => [card, index]));

        if (!this.list || !this.search || !this.typeFilter || !this.sortSelect || !this.countOutput || !this.emptyMessage) {
            return;
        }

        this.search.addEventListener('input', () => this.update());
        this.typeFilter.addEventListener('change', () => this.update());
        this.sortSelect.addEventListener('change', () => this.update());
        this.update();
    }

    normalize(value) {
        return value
            .toLocaleLowerCase('sk')
            .normalize('NFD')
            .replace(/[\u0300-\u036f]/g, '');
    }

    sortedCards() {
        const cards = [...this.cards];
        const sortMode = this.sortSelect.value;

        if (sortMode === 'name-asc' || sortMode === 'name-desc') {
            const direction = sortMode === 'name-asc' ? 1 : -1;
            cards.sort((first, second) =>
                direction * first.dataset.name.localeCompare(second.dataset.name, 'sk')
            );
        } else if (sortMode === 'type') {
            cards.sort((first, second) =>
                first.dataset.type.localeCompare(second.dataset.type, 'sk')
                || first.dataset.name.localeCompare(second.dataset.name, 'sk')
            );
        } else {
            cards.sort((first, second) => this.originalOrder.get(first) - this.originalOrder.get(second));
        }

        return cards;
    }

    matchesSearch(card, terms) {
        const searchableText = this.normalize([
            card.dataset.name,
            card.dataset.type,
            card.dataset.description
        ].join(' '));
        return terms.every(term => searchableText.includes(term));
    }

    update() {
        const terms = this.normalize(this.search.value).split(/\s+/).filter(Boolean);
        const selectedType = this.typeFilter.value;
        const orderedCards = this.sortedCards();
        let visibleCount = 0;

        orderedCards.forEach(card => {
            const matchesType = !selectedType || card.dataset.type === selectedType;
            const isVisible = matchesType && this.matchesSearch(card, terms);
            card.hidden = !isVisible;
            visibleCount += Number(isVisible);
            this.list.append(card);
        });

        this.emptyMessage.hidden = visibleCount > 0;
        const noun = visibleCount === 1 ? 'záznam' : (visibleCount > 1 && visibleCount < 5 ? 'záznamy' : 'záznamov');
        this.countOutput.textContent = `Zobrazených ${visibleCount} ${noun} z ${this.cards.length}.`;
    }
}

document.addEventListener('DOMContentLoaded', () => {
    const browser = document.querySelector('[data-world-browser]');
    if (browser) {
        new WorldEntityBrowser(browser);
    }
});
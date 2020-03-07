class RotateText {
    constructor(element, delay = 1200, transition = 500, transition_class = null) {
        if (!element ||
            !element.dataset.text) return;

        if (!transition_class) RotateText.insert_css()

        this.element = element
        this.text = this.element.dataset.text.split('|').map(t => t.trim())
        this.delay = delay
        this.transition = transition
        this.transition_class = transition_class || 'rotate_fade'
    }

    static insert_css() {
        const head = document.querySelector('head')
        let css = document.createElement('style')
        css.type = 'text/css'
        css.innerHTML = `.rotate_fade{transition: opacity ${this.transition};opacity: 0;}`
        head.appendChild(css)
    }

    static delay(ms) {
        return new Promise(resolve => setTimeout(resolve, ms))
    }

    async update_element(index) {
        await RotateText.delay(this.delay)
        this.element.classList.add(this.transition_class)

        await RotateText.delay(this.transition)
        this.element.classList.remove(this.transition_class)
        this.element.innerText = this.text[index]
    }

    async rotate() {
        this.element.style.transition = `opacity ${this.transition}ms ease-in-out`

        let index = 0
        while (true) {
            await this.update_element(index)
            index = index + 1 < this.text.length ? index + 1 : 0
        }
    }
}

const title = document.querySelector('.text-rotater')
new RotateText(title).rotate()
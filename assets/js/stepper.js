class Stepper {
    #stepperEl;
    #stepEls;
    #activateStep = 0;
    #btnNext;
    #btnPrevious;
    #submitBtn;

    constructor(stepperEl) {
        this.#stepperEl = stepperEl;
        this.#stepEls = stepperEl.querySelectorAll('.step');

        // hide all steps except the first one
        for (let i = 1; i < this.#stepEls.length; i++) {
            this.#stepEls[i].classList.add('d-none');
        }

        // buttons
        this.#btnNext = stepperEl.querySelector('.next-btn');
        this.#btnPrevious = stepperEl.querySelector('.previous-btn');
        this.#submitBtn = stepperEl.querySelector('button[type="submit"]');

        // event listeners on buttons
        this.#btnNext.addEventListener('click', () => this.next());
        this.#btnPrevious.addEventListener('click', () => this.previous());

        // event listeners on inputs
        this.#stepperEl.querySelectorAll('input, textarea').forEach(inputEl => {
            inputEl.addEventListener('change', () => {
                inputEl.classList.remove('error');
            });
        });

        this.handleButtonVisibility();
    }

    next() {
        if (this.isStepValid(this.#activateStep)) {
            this.#activateStep++;
            this.setActivateStep(this.#activateStep);
            this.handleButtonVisibility();
        }
    }

    previous() {
        this.#activateStep--;
        this.setActivateStep(this.#activateStep);
        this.handleButtonVisibility();
    }

    setActivateStep(step) {
        this.#activateStep = step;
        this.#stepEls.forEach((stepEl, i) => {
            if (i === step) {
                stepEl.classList.remove('d-none');
            } else {
                stepEl.classList.add('d-none');
            }
        });
    }

    isStepValid(step) {
        const inputEls = this.#stepEls[step].querySelectorAll('input, textarea');
        let isValid = true;
        inputEls.forEach(inputEl => {
            if (inputEl.checkValidity() === false) {
                inputEl.reportValidity()
                isValid = false;
            }
        });
        return isValid;
    }

    handleButtonVisibility() {
        if (this.#activateStep === 0) {
            this.#btnPrevious.classList.add('d-none');
        } else {
            this.#btnPrevious.classList.remove('d-none');
        }

        if (this.#activateStep === this.#stepEls.length - 1) {
            this.#btnNext.classList.add('d-none');
            this.#submitBtn.classList.remove('d-none');
        } else {
            this.#btnNext.classList.remove('d-none');
            this.#submitBtn.classList.add('d-none');
        }
    }
}

export default Stepper;
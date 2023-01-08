import {Controller} from '@hotwired/stimulus';

export default class extends Controller {
    connect() {
        const linkEls = document.querySelectorAll('.copy-link');

        linkEls.forEach((linkEl) => {
            linkEl.addEventListener('click', (e) => {
                e.preventDefault();

                const link = linkEl.getAttribute('href');

                navigator.clipboard.writeText(link).then(() => {
                    const icon = linkEl.querySelector('.copy-icon');
                    const iconChecked = linkEl.querySelector('.copy-icon--checked');
                    icon.classList.add('d-none');
                    iconChecked.classList.remove('d-none');

                    setTimeout(() => {
                        icon.classList.remove('d-none');
                        iconChecked.classList.add('d-none');
                    }, 5000);
                });
            });
        });
    }
}

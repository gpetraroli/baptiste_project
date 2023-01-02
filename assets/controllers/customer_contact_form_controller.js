import {Controller} from '@hotwired/stimulus';

export default class extends Controller {
    connect() {
        const btnAddContact = document.querySelector('#btn_add_other_contact');
        const contactContainer = document.querySelector('.customer-other-contacts');
        const contactPrototype = contactContainer.dataset.prototype;

        let contactIndex = 0;

        btnAddContact.addEventListener('click', () => {
            let markup = contactPrototype.replaceAll('__name__', contactIndex);
            contactContainer.insertAdjacentHTML('beforeend', markup);

            const lastContact = contactContainer.querySelector(`#other-contact-${contactIndex}`);
            const btnRemove = document.createElement('button');
            btnRemove.type = 'button';
            btnRemove.innerText = 'remove';
            btnRemove.classList.add('btn', 'btn-danger');
            btnRemove.addEventListener('click', () => {
                lastContact.remove();
            });
            lastContact.appendChild(btnRemove);

            contactIndex++;
        });

    }
}

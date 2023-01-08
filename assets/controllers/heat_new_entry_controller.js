import {Controller} from '@hotwired/stimulus';

export default class extends Controller {
    connect() {
        const activityTypeInput = document.querySelector('#heat_activity_entry_type');
        const nameOAInputContainer = document.querySelector('#heat_activity_entry_nameOA').closest('div');
        nameOAInputContainer.classList.add('d-none');

        activityTypeInput.addEventListener('click', (event) => {
            const selectedInput = activityTypeInput.querySelector('input:checked');
            if (selectedInput.value === '1') {
                nameOAInputContainer.classList.remove('d-none');
                nameOAInputContainer.required = true;
            } else {
                nameOAInputContainer.classList.add('d-none');
                nameOAInputContainer.required = false;
            }
        })


    }
}

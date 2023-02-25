import {Controller} from '@hotwired/stimulus';

import Stepper from "../js/stepper";

/**
 * Initialize all steppers.
 */
export default class extends Controller {
    connect() {
        const steppers = document.querySelectorAll('.stepper');
        steppers.forEach(stepper => new Stepper(stepper));
    }
}

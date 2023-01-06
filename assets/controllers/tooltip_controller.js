import {Controller} from '@hotwired/stimulus';

/**
 * This controller activates tooltips behavior throughout the hole application.
 * It creates a span element containing the text pass through data attribute in the element identified by the class '.tooltip-toggle'.
 * In the selected element it expects the following data attributes:
 * data-tooltip-content: mandatory, contains the message to be shown.
 * data-tooltip-direction: [top|bottom|right|left] direction of the tooltip, default: top.
 * data-tooltip-size: tooltip's size, default: 300px.
 */
export default class extends Controller {
    connect() {
        const tooltips = document.querySelectorAll('.tooltip-toggle');

        tooltips.forEach(tooltip => {
            // if no data-tooltip-content provided throw an exception
            if (!tooltip.dataset.tooltipContent) {
                throw `No data-tooltip-content provided for element: ${tooltip}`;
            }

            tooltip.addEventListener('mouseenter', () => {
                const tooltipContentEl = document.createElement('span');
                tooltipContentEl.classList.add('tooltip-content', `tooltip-content--${tooltip.dataset.tooltipDirection ? tooltip.dataset.tooltipDirection : 'top'}`);
                tooltipContentEl.style.width = tooltip.dataset.tooltipWidth ? tooltip.dataset.tooltipWidth : '300px';
                tooltipContentEl.innerHTML = `<span>${tooltip.dataset.tooltipContent}</span>`;
                tooltip.appendChild(tooltipContentEl);
            });

            tooltip.addEventListener('mouseleave', () => {
                const tooltipContentEl = tooltip.querySelector('.tooltip-content');
                tooltipContentEl.remove();
            });
        });
    }
}

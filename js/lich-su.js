let index = 0;
window.onload (
    document.querySelectorAll('.event-item').forEach(event => {
        if (index === 0) {
            event.classList.add("event-item-mid");
            event.setAttribute("data-aos", "fade-up");
        }
        else if (index === document.querySelectorAll('.event-item').length - 1) {
            event.classList.add("event-item-mid");
            event.setAttribute("data-aos", "zoom-in");
        }
        else if (index % 2) {
            event.classList.add("event-item-left");
            event.setAttribute("data-aos", "fade-right");
        }
        else {
            event.classList.add("event-item-right");
            event.setAttribute("data-aos", "fade-left");
        }
        index++;
        }
    )
)
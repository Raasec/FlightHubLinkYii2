document.addEventListener('DOMContentLoaded', () => {
    const container = document.querySelector('.profile-image-selector');
    if (!container) return;

    const radios = container.querySelectorAll('input[type="radio"]');
    let current = [...radios].findIndex(r => r.checked);
    if (current < 0) current = 0;

    function select(index) {
        radios[index].checked = true;
        radios[index].dispatchEvent(new Event('change'));
    }

    container.addEventListener('keydown', e => {
        if (e.key === 'ArrowRight') {
            current = (current + 1) % radios.length;
            select(current);
        }

        if (e.key === 'ArrowLeft') {
            current = (current - 1 + radios.length) % radios.length;
            select(current);
        }
    });
});

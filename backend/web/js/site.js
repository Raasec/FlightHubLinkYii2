$(function () {
    // Inicializar o calendário inline do AdminLTE
    $('#calendar').datetimepicker({
        inline: true,
        sideBySide: false,
        format: 'L',
        icons: {
            time: 'far fa-clock',
            date: 'far fa-calendar',
            up: 'fas fa-chevron-up',
            down: 'fas fa-chevron-down',
            previous: 'fas fa-chevron-left',
            next: 'fas fa-chevron-right'
        }
    });
});

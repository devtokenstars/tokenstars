//Render counter:
function counter(selector, date) {
    var block = {
        days: $(selector + 'days'),
        hours: $(selector +'hours'),
        minutes: $(selector + 'minutes'),
        seconds: $(selector + 'seconds')
    };

    ts = new Date(date).getTime();
    var render = function() {
        var now = new Date().getTime();
        var distance = ts - now;
        var days = Math.floor(distance / (1000 * 60 * 60 * 24));
        var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
        var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
        var seconds = Math.floor((distance % (1000 * 60)) / 1000);

        block.days.html(days);
        block.hours.html(hours);
        block.minutes.html(minutes);
        block.seconds.html(seconds);
    };

    render();
    return setInterval(render, 1000);
}
module.exports = counter;

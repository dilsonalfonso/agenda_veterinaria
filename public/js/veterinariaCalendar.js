document.addEventListener('DOMContentLoaded', function() {
var calendarEl = document.getElementById('veterinariaCalendario');
var calendar = new FullCalendar.Calendar(calendarEl, {
    initialView: 'dayGridMonth',
    locale:"es",
    headerToolbar:{
        left:'prev,next today',
        center: 'title',
        right: 'dayGridMonth,listWeek'
    },
    eventTimeFormat: {
        hour: '2-digit',
        minute: '2-digit',
        hour12: true
    },
    contentHeight:"auto",
    events: "./CitasR",
    dateClick:function(info){
        window.location.href='./CitasC/'+info.dateStr;
    },
    eventClick:function(info){
        var evento=info.event;
        window.location.href='./CitasU/'+info.event.id;
        
    }
});
calendar.render();
    
});
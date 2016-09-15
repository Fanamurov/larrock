$(function(){

    //Äàòà ñ êîòîðîé íà÷èíàåì îòñ÷¸ò âðåìåíè
    var	ts = (new Date(2013, 9, 24)).getTime();//(ãîä, ìåñÿö, äåíü)
    //Âðåìÿ íà êîòîðîå çàâîäèòñÿ òàéìåð ÷àñàõ
    var timenew=10;


    //////////////////////////////////////////////////
    var note = $('#note');
    var addtime=0;
    while((new Date()).getTime()>(ts+timenew*addtime*60*60*1000)){
        addtime++;
    }
    ts=ts+timenew*addtime*60*60*1000;
    var newYear = true;

    if((new Date()) > ts){
        // The new year is here! Count towards something else.
        // Notice the *1000 at the end - time must be in milliseconds
        ts = (new Date()).getTime() + 10*24*60*60*1000;
        newYear = false;
    }

    $('#countdown').countdown({
        timestamp	: ts,
        callback	: function(days, hours, minutes, seconds){

            var message = "";

            message += days + " day" + ( days==1 ? '':'s' ) + ", ";
            message += hours + " hour" + ( hours==1 ? '':'s' ) + ", ";
            message += minutes + " minute" + ( minutes==1 ? '':'s' ) + " and ";
            message += seconds + " second" + ( seconds==1 ? '':'s' ) + " <br />";


            message += "Îñòàëîñü âðåíåíè äî ñîáûòèÿ!";

            note.html(message);
        }
    });

});
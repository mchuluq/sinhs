/**
 * User: mochammad c. chuluq
 * Date: 14/05/13
 * Time: 19:12
 * chraven systems dev. lab.
 */
(function($) {
    $.cloudfires ={
        delay: 5000,
        autoHide:false,
        title:'notification',
        type:'default',
        img:undefined,
        showTime:false,
        okButton: '&nbsp;OK&nbsp;',
        cancelButton: '&nbsp;Cancel&nbsp;',

        //notification
        notification:function(message,options){
            var settings = $.extend({
                    title: $.cloudfires.title,
                    type:$.cloudfires.type,
                    img:$.cloudfires.img,
                    showTime:$.cloudfires.showTime,
                    autoHide:$.cloudfires.autoHide,
                    delay:$.cloudfires.delay
                },options),
                timeStamp = Number(new Date()),
                notif_id= '#'+timeStamp,
                timer = (settings.showTime) ? 'showTime' : 'noTime',
                img = (settings.img) ? '<img src="'+settings.img+'"/>' : '';
            $("#cf-notifications").append('<div class="cf-notification '+settings.type+' animated fadeInDown '+timer+'" id="'+timeStamp+'"><div class="left">'+img+'</div><div class="right"><h3>'+settings.title+'</h3><span class="cf-notification-x"></span>'+message+'<br/><span class="timeStamp"></span></div></div>');
            if(settings.showTime){
                setInterval(function(){
                    $('.cf-notification.showTime .timeStamp').each(function(){
                        var timing = $(this).parent().parent().attr("id");
                        $(this).html("<strong>"+$.cloudfires._timeSince(timing) + "</strong> ago");
                    })
                },4000);
            }
            if(settings.autoHide != false){
                setTimeout(function(){
                    $.cloudfires._close_notification(notif_id);
                },settings.delay)
            }
            $(notif_id).find('.cf-notification-x').click(function(){
                $.cloudfires._close_notification(notif_id);
            });
        },
        _close_notification:function(notifid){
            $(notifid).remove();
        },
        success: function(message,title){
            this.notification(message,{title:title,type:'success'});
        },
        info: function(message,title){
            this.notification(message,{title:title,type:'info'});
        },
        warning: function(message,title){
            this.notification(message,{title:title,type:'warning'});
        },
        error: function(message,title){
            this.notification(message,{title:title,type:'error'});
        },
        _timeSince:function(time){
            var time_formats = [
                [2, "One second", "1 second from now"], // 60*2
                [60, "seconds", 1], // 60
                [120, "One minute", "1 minute from now"], // 60*2
                [3600, "minutes", 60], // 60*60, 60
                [7200, "One hour", "1 hour from now"], // 60*60*2
                [86400, "hours", 3600], // 60*60*24, 60*60
                [172800, "One day", "tomorrow"], // 60*60*24*2
                [604800, "days", 86400], // 60*60*24*7, 60*60*24
                [1209600, "One week", "next week"], // 60*60*24*7*4*2
                [2419200, "weeks", 604800], // 60*60*24*7*4, 60*60*24*7
                [4838400, "One month", "next month"], // 60*60*24*7*4*2
                [29030400, "months", 2419200], // 60*60*24*7*4*12, 60*60*24*7*4
                [58060800, "One year", "next year"], // 60*60*24*7*4*12*2
                [2903040000, "years", 29030400], // 60*60*24*7*4*12*100, 60*60*24*7*4*12
                [5806080000, "One century", "next century"], // 60*60*24*7*4*12*100*2
                [58060800000, "centuries", 2903040000] // 60*60*24*7*4*12*100*20, 60*60*24*7*4*12*100
            ];
            var seconds = (new Date - time) / 1000;
            var token = "ago", list_choice = 1;
            if (seconds < 0) {
                seconds = Math.abs(seconds);
                token = "from now";
                list_choice = 1;
            }
            var i = 0, format;
            while (format = time_formats[i++]) if (seconds < format[0]) {
                if (typeof format[2] == "string")
                    return format[list_choice];
                else
                    return Math.floor(seconds / format[2]) + " " + format[1];
            }
            return time;
        },

        //beeper
        beep:function(text,options){
            var defaults = {
                    delay: $.cloudfires.delay,
                    autoHide: $.cloudfires.autoHide
                },
                settings = $.extend({},defaults,options), number_id = Number(new Date());
            $("#cf-beepers").prepend('<div id="'+number_id+'" class="cf-beeper animated fadeInDown">'+text+'</div>');
            var id = '#'+number_id;
            if(settings.autoHide){
                setTimeout(function(){
                    $.cloudfires._close_beep(id);
                },settings.delay)
            }
            $(id).click(function(){
                $.cloudfires._close_beep(id);
            })
        },
        _close_beep:function(id){
            $(id).remove();
        },

        //alert, confirm, prompt
        _show_alert: function(message,type){
            switch(type){
                case 'alert':
                    var content =   message+
                        '<br/><button id="button-ok">'+$.cloudfires.okButton+'</button>';
                    break;
                case 'confirm':
                    var content =   message+
                        '<br/><button id="button-ok">'+$.cloudfires.okButton+'</button>'+
                        '<button id="button-cancel">'+$.cloudfires.cancelButton+'</button>';
                    break;
                case 'prompt':
                    var content =   message+
                        '<br/><input type="text" id="cf-prompt-text" />'+
                        '<br/><button id="button-ok">'+$.cloudfires.okButton+'</button>'+
                        '<button id="button-cancel">'+$.cloudfires.cancelButton+'</button>';
                    break;
            }
            $("#cloudfire").append('<div id="cf-overlays"><div id="cf-alert" class="animated fadeInDown">'+content+'</div></div>');
        },
        _close_alert:function(){
            $("#cf-overlays").remove();
        },
        alert: function(message){
            if($('#cf-alert').length){
                return false;
            }
            $.cloudfires._show_alert(message,'alert');
            $("#button-ok").click( function() {
                $.cloudfires._close_alert();
            });
        },
        confirm: function(message,callback){
            if($('#cf-alert').length){
                return false;
            }
            $.cloudfires._show_alert(message,'confirm');
            $("#button-ok").click( function() {
                $.cloudfires._close_alert();
                if( callback ) callback(true);
            });
            $("#button-cancel").click( function() {
                $.cloudfires._close_alert();
                if( callback ) callback(false);
            });
        },
        prompt: function(message,callback){
            if($('#cf-alert').length){
                return false;
            }
            $.cloudfires._show_alert(message,'prompt');
            $("#button-ok").click( function() {
                var val = $("#cf-prompt-text").val();
                $.cloudfires._close_alert();
                if( callback ) callback(val);
            });
            $("#button-cancel").click( function() {
                $.cloudfires._close_alert();
                if( callback ) callback(null);
            });
        },

        //css3 loading
        loading: function(type){
            if($('#cf-loader').length){
                return false;
            };
            switch(type){
                case 'circle':
                    var loader = '<div class="circle-loader"></div><div class="circle-loader1"></div>';
                    break;
                default :
                case 'ball':
                    var loader = '<div class="ball-loader"></div><div class="ball-loader1"></div>';
                    break;
            };
            $("#cloudfire").append('<div id="cf-loader">'+loader+'<span>please wait...</span></div>');
            //$("#cloudfire").append('<div id="cf-loader"><div class="loading-gif"></div><span>please wait...</span></div>')
            $("#cf-loader").css({zIndex:99999});
        },
        close_loading: function(){
            $("#cf-loader").remove();
        }

    };
})(jQuery);
$(document).ready(function(){
    $("BODY").append('<div id=\"cloudfire\"><div id=\"cf-notifications\"></div><div id=\"cf-beepers\"></div></div>');
    $('#cf-notifications,#cf-beepers').bind('contextmenu', function(e) {
        return false;
    });
});
var cloudfire =$.cloudfires;
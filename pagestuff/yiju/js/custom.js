function subscribe(itemid, status){
        // alert(window.location.href);
        $.get('http://' + window.location.host + '/yiban/Yiju/update_subscribe?itemid=' + itemid + '&status=' + status, function(data) {
            /*optional stuff to do after success */
            data = $.parseJSON(data);
            // alert(data.msg);
            if(data.status == 0){
                $('#subscribeButton') . attr({
                    'class': 'btn btn-common-success uppercase',
                    // 'text': data . msg,
                    'onclick': 'subscribe(' + itemid + ',' + data . status + ')'
                });
                $('#subscribeButton') . text(data . msg);
            }
            else if(data.status == 1){
                $('#subscribeButton') . attr({
                    'class': 'btn btn-common uppercase',
                    // 'text': data . msg,
                    'onclick': 'subscribe(' + itemid + ',' + data . status + ')'
                });
                $('#subscribeButton') . text(data . msg);
            }
        });
}

function getFriends(){
    $.get('http://' + window.location.host + '/yiban/Yiju/get_friends', function(data) {
            /*optional stuff to do after success */
            data = $.parseJSON(data);
            // alert(data.msg);
            if(data.status == 'success'){
                $('#subscribeButton') . attr({
                    'class': 'btn btn-common-success uppercase',
                    // 'text': data . msg,
                    'onclick': 'subscribe(' + itemid + ',' + data . status + ')'
                });
                $('#subscribeButton') . text(data . msg);
            }
            else if(data.status == 1){
                $('#subscribeButton') . attr({
                    'class': 'btn btn-common uppercase',
                    // 'text': data . msg,
                    'onclick': 'subscribe(' + itemid + ',' + data . status + ')'
                });
                $('#subscribeButton') . text(data . msg);
            }
        });
}

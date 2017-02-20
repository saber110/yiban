<script type="text/javascript" src="<?php echo base_url();?>js/framework7/framework7.min.js"></script>
<script src='http://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>
<script>
  var myApp = new Framework7();

  var $$ = Dom7;

  // Conversation flag
  var conversationStarted = false;

  // Init Messages
  var myMessages = myApp.messages('.messages', {
    autoLayout:true
  });

  // Init Messagebar
  var myMessagebar = myApp.messagebar('.messagebar');

  // Handle message
  $$('.messagebar .link').on('click', function () {
    // Message text
    var messageText = myMessagebar.value().trim();
    console.log(messageText);
    // Exit if empy message
    if (messageText.length === 0) return;

    // Empty messagebar
    myMessagebar.clear()

    // Random message type
    // var messageType = (['sent', 'received'])[Math.round(Math.random())];
    var messageType = 'sent';

    // Avatar and name for received message
    var avatar, name;
    if(messageType === 'received') {
      avatar = 'favicon.ico';
      name = '易小熊';
    }
    // Add message
    myMessages.addMessage({
      // Message text
      text: messageText,
      // Random message type
      type: messageType,
      // Avatar and name:
      avatar: avatar,
      name: name,
      // Day
      day: !conversationStarted ? 'Today' : false,
      time: !conversationStarted ? (new Date()).getHours() + ':' + (new Date()).getMinutes() : false
    })
    // tulingjiqiren
    $.get("./chat/reply?message="+messageText,function(data)
    {
      myMessages.addMessage({
        // Message text
        text: data,
        // Random message type
        type: 'received',
        // Avatar and name:
        avatar: avatar,
        name: name,
        // Day
        day: !conversationStarted ? 'Today' : false,
        time: !conversationStarted ? (new Date()).getHours() + ':' + (new Date()).getMinutes() : false
      })
    })
    // Update conversation flag
    conversationStarted = true;
  });
</script>
<script type="text/javascript">
function speak() {
  var content = document.getElementById('current').value;
  $.get("./chat/reply?message="+content,function(data)
  {
    $('b').append('<li><img src="http://s8.postimg.org/76bg2es2t/index.png"><div class="message current">'+content+'</div></li>');
    $('b').append('<li><img src="http://lorempixel.com/100/100/people/1/"><div class="message">'+data+'</div></li>');
  })
}
</script>
</body>
</html>

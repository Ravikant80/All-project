<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Real-time notifications in Laravel using Pusher</title>
 
  </head>
  <body>
    <h1>Real-time notifications in Laravel using Pusher</h1>
 
    <!-- Incldue Pusher Js Client via CDN -->
    <script src="https://js.pusher.com/4.2/pusher.min.js"></script>
    <!-- Alert whenever a new notification is pusher to our Pusher Channel -->
 
    <script>
    //Remember to replace key and cluster with your credentials.
    var pusher = new Pusher('key', {
      cluster: 'ap2',
      encrypted: true
    });
 
    //Also remember to change channel and event name if your's are different.
    var channel = pusher.subscribe('notify');
    channel.bind('notify-event', function(message) {
        alert(message);
    });
 
    </script>
  </body>
</html>
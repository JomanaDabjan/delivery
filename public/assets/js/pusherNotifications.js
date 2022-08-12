var notificationsWrapper = $('.dropdown-notifications');
var notificationsToggle = notificationsWrapper.find('a[data-toggle]');
var notificationsCountElem = notificationsToggle.find('span[data-count]');
var notificationsCount = parseInt(notificationsCountElem.data('count'));
var notifications = notificationsWrapper.find('div.scrollable-container');


// Subscribe to the channel we specified in our Laravel Event

// Bind a function to a Event (the full Laravel class)
channel.bind('my-event', function (data) {

  // console.log(data.user_id);
  var existingNotifications = notifications.html();
  //console.log(existingNotifications);
  //  var newNotificationHtml = 

  if (data.trip_status == 'waiting') {
    if (data.trip_type == 'passenger') {
      var newNotificationHtml = ` <a class="dropdown-item dropped_a" href="Trips/track_trip/` + data.trip_id + `">

    <p class="paragraph" > `+ data.message + ` ` + data.trip_end + `</p>
    <p class="paragraph date">`+ data.date + `/` + data.clock + `</p>
  </a>
  <hr style="margin: unset;">`;
    }
    if (data.trip_type == 'package') {
      var newNotificationHtml = ` <a class="dropdown-item dropped_a" href="Trips/track_trip_package/` + data.trip_id + `">

    <p class="paragraph" > `+ data.message + ` ` + data.trip_end + `</p>
    <p class="paragraph date">`+ data.date + `/` + data.clock + `</p>
  </a>
  <hr style="margin: unset;">`;
    }
    if (data.trip_type == 'driver') {
      var newNotificationHtml = ` <a class="dropdown-item dropped_a" href="Trips_driver/track_trip/` + data.trip_id + `">

    <p class="paragraph" > `+ data.message + ` ` + data.trip_end + `</p>
    <p class="paragraph date">`+ data.date + `/` + data.clock + `</p>
  </a>
  <hr style="margin: unset;">`;
    }
  }

  if (data.trip_status == 'cancelled') {
    if (data.user_role == 'USER') {
      var newNotificationHtml = ` <a class="dropdown-item dropped_a" href="Trips">
   
      <p class="paragraph" > `+ data.message + ` ` + data.trip_end + `</p> 
      <p class="paragraph" >You may search for a new one, Sorry for your inconveince</p>
      <p class="paragraph date">`+ data.date + `/` + data.clock + `</p>
    
  </a>
  <hr style="margin: unset;">`;
    }
    if (data.user_role == 'DRIVER') {
      var newNotificationHtml = ` <a class="dropdown-item dropped_a" href="Trips_driver">

 <p class="paragraph" > `+ data.message + ` ` + data.trip_end + `</p> 
 <p class="paragraph" >You may search for a new one, Sorry for your inconveince</p>
 <p class="paragraph date">`+ data.date + `/` + data.clock + `</p>
  </a>
  <hr style="margin: unset;">`;
    }
  }
  //  console.log(newNotificationHtml);
  notifications.html(newNotificationHtml + existingNotifications);
  notificationsCount += 1;
  notificationsCountElem.attr('data-count', notificationsCount);
  notificationsWrapper.find('.notif-count').text(notificationsCount);
  notificationsWrapper.show();
});

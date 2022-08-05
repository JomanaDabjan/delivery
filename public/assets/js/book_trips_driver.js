
// load data first time 
$.ajax({
    url: "gettrips_driver",
    type: 'GET',
    dataType: 'json',
    success: function (response) {
        var data = response;
        var st = "";
        var maps = [];
        var locations = [];
        var m_id = [];
        $.each(data, function (index) {

            locations.push([data[index].start_point_latitude, data[index].start_point_longitude, data[index].end_point_latitude, data[index].end_point_longitude]);
            m_id.push(data[index].trip_id);
            st += " <div id='trip_info'  type='button' href='#tripModal'  onclick='openmodal(this," + data[index].trip_id + ")' class='trip_card col-md-6 col-xl-3 col-lg-4 ' data-toggle='modal'>";
            st += "   <div class='card p-2' style='width: 18rem;  margin: auto;'>";
            st += "   <div   id='map" + data[index].trip_id + "' class='card-img-top  rounded-top' style=' width:16rem; height:16rem;align-self: center;'></div>";

            st += "   <div class='card-body'>";
            st += "    <p class='card-text card-icon'>";

            st += "   <i class='material-icons card-icon'>location_on</i> <span></span> Destination:" + data[index].end_address + "</span><br>";
            st += "   <i class='material-icons card-icon'>access_time</i> <span>Start Time:" + data[index].start_time + "</span><br>";
            st += "    <i class='material-icons card-icon'>directions_car</i> <span>Vehicle type:" + data[index].vehicle_type + "</span><br>";
            st += "    </p>    </div>  </div> </div>";

        });


        $("#amr").html(st);

        var maps = [];
        for (var i = 0; i < m_id.length; i++) {



            var start = {
                lat: locations[i][0],
                lng: locations[i][1]
            };

            var end = {
                lat: locations[i][2],
                lng: locations[i][3]
            };

            var mapOptions = {
                center: start,
                scrollwheel: false,
                zoom: 15,
                mapTypeId: google.maps.MapTypeId.ROADMAP,
                disableDefaultUI: true,
                gestureHandling: "none",
                fullscreenControl: true,

            };

            var map = new google.maps.Map(document.getElementById('map' + m_id[i]), mapOptions);
            maps.push(map);


            var marker1 = new google.maps.Marker({
                map: map,
                position: start,
            });

            var marker2 = new google.maps.Marker({
                map: map,
                position: end,
            });
        };

        window.initMap = initMap;





    },
    error: function () {
        alert('no response');
    }


});


//fun for displaying prod details
function openmodal(f, id) {


    $.ajax({
        url: "gettripsid",
        type: 'GET',
        dataType: 'json',
        data: {
            id: id
        },
        success: function (response) {

            var data = response;
            var st = "";
            var s_lat;
            var s_lng;
            var e_lat;
            var e_lng;
            $.each(data, function (index) {
                s_lat = data[index].start_point_latitude;
                s_lng = data[index].start_point_longitude;
                e_lat = data[index].end_point_latitude;
                e_lng = data[index].end_point_longitude;
                st += "<div class='modal-header'>";
                st += "    <button type='button' class='close' data-dismiss='modal' aria-label='Close'>";
                st += "<span aria-hidden='true'>&times;</span>";
                st += "</button>    </div>";
                st += "<div  class='modal-body'>";
                st += "<div id='map' class='rounded' style='width:100%; height:13rem;' ></div>";
                st += "  <div class='row mt-4'>";
                st += "<div class='col-md-6 col-sm-12'>";
                st += "<p>Driver's name:" + data[index].user_name + "</p>";
                st += "<p>Vehicle Type:" + data[index].vehicle_type + "</p>";
                st += "<p>Start Point:" + data[index].start_address + "</p>";
                st += "<p>End Point:" + data[index].end_address + "</p>    </div>";

                st += "<div class=' d-none d-sm-inline-block col-md-1'>";
                st += "<div class='vr ' style='height: 100%;'></div>                </div>";

                st += "<div class='col-md-5 col-sm-12 '>";

                st += "<p>Start Time: " + data[index].start_time + "</p>";
                st += "<p>Aviliable Seats:" + data[index].available_seats + "</p>";
                st += "<p>Aviliable Load Size:" + data[index].available_size + "</p>";
                st += "<p>Aviliable Load Weight:" + data[index].available_weight + "</p>                </div>             </div>            </div>";

                st += "<div class='modal-footer'>";
                st += "<form method='POST' action='{{ route('book_seat') }}'>  <input type='hidden' name='_token' value='{{ csrf_token() }}' /> <input type=text id='id' name='id' value='" + data[index].trip_id + "' hidden='true'>"
                st += " <button type='submit' class='btn-trip-book btn '>Reserve Seat</button></form>"

                st += "<form method='POST' action='{{ route('book_package') }}'>  <input type='hidden' name='_token' value='{{ csrf_token() }}' /> <input type=text id='id' name='id' value='" + data[index].trip_id + "' hidden='true'>"
                st += " <button type='submit' class='btn-trip-book btn '>Send Packages</button></form>"

                st += "    </div>";


            });
            $("#trip").html(st);

            var start = {
                lat: s_lat,
                lng: s_lng
            };

            var end = {
                lat: e_lat,
                lng: e_lng
            };

            var mapOptions = {
                center: start,
                scrollwheel: false,
                zoom: 15,
                mapTypeId: google.maps.MapTypeId.ROADMAP,
                disableDefaultUI: true,
                zoomControl: true,
                fullscreenControl: true,

            };

            var map = new google.maps.Map(document.getElementById('map'), mapOptions);



            var marker1 = new google.maps.Marker({
                map: map,
                position: start,

            });

            var marker2 = new google.maps.Marker({
                map: map,
                position: end,
            });

        },
        error: function () {
            alert('no response modal', id);
        }

    });

}

//filter by
function filter() {

    var f = document.getElementById("filters").value;


    $.ajax({
        url: "get_trips_all_by_filter_driver",
        type: 'GET',
        dataType: 'json',
        data: {
            f: f
        },
        success: function (response) {
            var data = response;
            var st = "";
            var maps = [];
            var locations = [];
            var m_id = [];
            $.each(data, function (index) {

                locations.push([data[index].start_point_latitude, data[index].start_point_longitude, data[index].end_point_latitude, data[index].end_point_longitude]);
                m_id.push(data[index].trip_id);
                st += " <div id='trip_info'  type='button' href='#tripModal'  onclick='openmodal(this," + data[index].trip_id + ")' class='trip_card col-md-6 col-xl-3 col-lg-4 ' data-toggle='modal'>";
                st += "   <div class='card p-2' style='width: 18rem;  margin: auto;'>";
                st += "   <div   id='map" + data[index].trip_id + "' class='card-img-top  rounded-top' style=' width:16rem; height:16rem;align-self: center;'></div>";

                st += "   <div class='card-body'>";
                st += "    <p class='card-text card-icon'>";

                st += "   <i class='material-icons card-icon'>location_on</i> <span></span> Destination:" + data[index].end_address + "</span><br>";
                st += "   <i class='material-icons card-icon'>access_time</i> <span>Start Time:" + data[index].start_time + "</span><br>";
                st += "    <i class='material-icons card-icon'>directions_car</i> <span>Vehicle type:" + data[index].vehicle_type + "</span><br>";
                st += "    </p>    </div>  </div> </div>";

            });


            $("#amr").html(st);

            var maps = [];
            for (var i = 0; i < m_id.length; i++) {



                var start = {
                    lat: locations[i][0],
                    lng: locations[i][1]
                };

                var end = {
                    lat: locations[i][2],
                    lng: locations[i][3]
                };

                var mapOptions = {
                    center: start,
                    scrollwheel: false,
                    zoom: 15,
                    mapTypeId: google.maps.MapTypeId.ROADMAP,
                    disableDefaultUI: true,
                    gestureHandling: "none",
                    fullscreenControl: true,

                };

                var map = new google.maps.Map(document.getElementById('map' + m_id[i]), mapOptions);
                maps.push(map);


                var marker1 = new google.maps.Marker({
                    map: map,
                    position: start,
                });

                var marker2 = new google.maps.Marker({
                    map: map,
                    position: end,
                });
            };

            window.initMap = initMap;





        },
        error: function () {
            alert('no response');
        }


    });
}



//search product by name function
function search_fun() {


    var k = document.getElementById("search_box").value;

    $.ajax({
        url: "search_driver",
        type: 'GET',
        dataType: 'json',
        data: {
            k: k
        },
        success: function (response) {
            var data = response;
            var st = "";
            var maps = [];
            var locations = [];
            var m_id = [];
            
           
            $.each(data, function (index) {

                locations.push([data[index].start_point_latitude, data[index].start_point_longitude, data[index].end_point_latitude, data[index].end_point_longitude]);
                m_id.push(data[index].trip_id);
                st += " <div id='trip_info'  type='button' href='#tripModal'  onclick='openmodal(this," + data[index].trip_id + ")' class='trip_card col-md-6 col-xl-3 col-lg-4 ' data-toggle='modal'>";
                st += "   <div class='card p-2' style='width: 18rem;  margin: auto;'>";
                st += "   <div   id='map" + data[index].trip_id + "' class='card-img-top  rounded-top' style=' width:16rem; height:16rem;align-self: center;'></div>";

                st += "   <div class='card-body'>";
                st += "    <p class='card-text card-icon'>";

                st += "   <i class='material-icons card-icon'>location_on</i> <span></span> Destination:" + data[index].end_address + "</span><br>";
                st += "   <i class='material-icons card-icon'>access_time</i> <span>Start Time:" + data[index].start_time + "</span><br>";
                st += "    <i class='material-icons card-icon'>directions_car</i> <span>Vehicle type:" + data[index].vehicle_type + "</span><br>";
                st += "    </p>    </div>  </div> </div>";

            });

            if(!$.trim(data))            
            st+="<p style=' text-align: center;'>No results!</p>";
            
            $("#amr").html(st);

            var maps = [];
            for (var i = 0; i < m_id.length; i++) {



                var start = {
                    lat: locations[i][0],
                    lng: locations[i][1]
                };

                var end = {
                    lat: locations[i][2],
                    lng: locations[i][3]
                };

                var mapOptions = {
                    center: start,
                    scrollwheel: false,
                    zoom: 15,
                    mapTypeId: google.maps.MapTypeId.ROADMAP,
                    disableDefaultUI: true,
                    gestureHandling: "none",
                    fullscreenControl: true,

                };

                var map = new google.maps.Map(document.getElementById('map' + m_id[i]), mapOptions);
                maps.push(map);


                var marker1 = new google.maps.Marker({
                    map: map,
                    position: start,
                });

                var marker2 = new google.maps.Marker({
                    map: map,
                    position: end,
                });
            };

            window.initMap = initMap;





        },
        error: function () {
            alert('no response');
        }


    });

}

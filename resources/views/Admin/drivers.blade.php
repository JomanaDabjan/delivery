@extends('Admin')

@section('content')

<div class="m-5">
<div href="#addModal" data-toggle="modal" data-target="#addModal" class="btn  btn-admin">Add a new Driver</div>
    <table class="pro_log">
        <thead>
            <tr>
                <th>User Name</th>
                <th>Full Name</th>
                <th>Phone</th>
                <th>Email</th>
                <th>ID</th>
                <th>License</th>
                <th>Vehicle ID</th>
                <th>Operations</th>
            </tr>
        </thead>
        <tbody>
            @foreach($drivers as $driver)
            <tr>
                <td>{{$driver->user_name}}</td>
                <td>{{$driver->full_name}}</td>
                <td>{{$driver->phone}}</td>
                <td>{{$driver->email}}</td>
                <td><img src='../images/ID/1658136308_jojo.jpg' height='50' width='50'/></td>
                <td><img src='../images/License/1658136308_jojo.jpg' height='50' width='50'/></td>
                <td>{{$driver->vehicle_id}}</td>

                <td>
                <a href='#'>
            <i onclick="getDriverDetails('{{$driver->id}}')" data-target="#editModal" data-toggle="modal" class="fa fa-edit blue"></i>
          </a>
          /
          <a href='#'>
            <i onclick="deleteDriver('{{$driver->id}}')" data-toggle="modal" class="fa fa-trash danger"></i>
          </a>
                </td>

            </tr>
            @endforeach
        </tbody>
    </table>
</div>

<!--Add Modal-->

<div id="addModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog  modal-dialog-centered modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header ">

        <h2 class="modal-title" id="addModalLabel">Add New Driver</h2>
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
      </div>
      <div class="modal-body">
        <div class="form-group">
          <label for="name">{{ __('Driver Name') }}</label>
          <input id="user_name" type="text" class="form-control @error('user_name') is-invalid @enderror" name="user_name" value="{{ old('user_name') }}" required pattern="[A-z]{3,}" title="only letters are allowed" autocomplete="user_name" autofocus>

          @error('user_name')
          <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
          </span>
          @enderror


        </div>

        <div class="form-group">
          <label for="full_name">{{ __('Full Name') }}</label>
          <input id="full_name" type="text" class="form-control @error('full_name') is-invalid @enderror" name="full_name" value="{{ old('full_name') }}" required autocomplete="full_name" pattern="[A-z]{3,}" title="only letters are allowed" autofocus>

          @error('full_name')
          <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
          </span>
          @enderror

        </div>

        <div class="form-group">
          <label for="email">{{ __('Email Address') }}</label>

          <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">

          @error('email')
          <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
          </span>
          @enderror
        </div>

        <div class="form-group">
          <label for="phone">{{ __('Phone') }}</label>
          <input type="text" class="form-control" id="phone" name="phone" required pattern="[0-9]{6,}" value="{{ old('phone') }}" title="only numbers of six digits and above are allowed">


        </div>

        <div class="form-group">
            <label for="id_photo">ID Photo</label>
            <input type="file" name="id_photo" class="form-control" id="id_photo" required>


          </div>
          <div class="form-group">
            <label for="license">License</label>
            <input type="file" name="license" class="form-control" id="license" required>


          </div>

        <div class="form-group">
          <label for="password">Password</label>

          <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" title="Password should have at least 6 or more characters" required pattern=".{6,}" autocomplete="new-password">

          @error('password')
          <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
          </span>
          @enderror

        </div>

        <div class="form-group">
          <label for="password-confirm">{{ __('Confirm Password') }}</label>


          <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required pattern=".{6,}" title="Password should have at least 6 or more characters" autocomplete="new-password">

        </div>

        
        <a id="save_driver" class="btn btn-info">
          {{ __('Save') }}
        </a>

      </div>
    </div>
  </div>
</div>


<!-- edit Modal -->
<div id="editModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog  modal-dialog-centered modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header ">

        <h2 class="modal-title" id="addModalLabel">Edit Driver Information</h2>
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
      </div>
      <form method="POST" action="{{ route('driver.update') }}" enctype="multipart/form-data">
      <div class="modal-body">
        <div class="form-group">
          <label for="name">{{ __('Driver Name') }}</label>
          <input id="user_name_edit" type="text" class="form-control @error('user_name') is-invalid @enderror" name="user_name" value="{{ old('user_name') }}" required pattern="[A-z]{3,}" title="only letters are allowed" autocomplete="driver_name" autofocus>

          @error('user_name')
          <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
          </span>
          @enderror


        </div>
        <input type="text" name="u_id" id="u_id" value="{{$driver->driver_id}}" hidden>

        <div class="form-group">
          <label for="full_name">{{ __('Full Name') }}</label>
          <input id="full_name_edit" type="text" class="form-control @error('full_name') is-invalid @enderror" name="full_name" value="{{ old('full_name') }}" required autocomplete="full_name" pattern="[A-z]{3,}" title="only letters are allowed" autofocus>

          @error('full_name')
          <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
          </span>
          @enderror

        </div>

        <div class="form-group">
          <label for="email">{{ __('Email Address') }}</label>

          <input id="email_edit" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">

          @error('email')
          <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
          </span>
          @enderror
        </div>

        <div class="form-group">
          <label for="phone">{{ __('Phone') }}</label>
          <input type="text" class="form-control" id="phone_edit" name="phone" required pattern="[0-9]{6,}" value="{{ old('phone') }}" title="only numbers of six digits and above are allowed">


        </div>

        <div class="form-group">
                  <label for="u_id_photo">ID Photo</label><br>
                  <input type="file" name="u_id_photo" class="form-control" id="id_photo_edit" onChange="displayImageu_ID(this)" style="display: none;">
                  <img src="{{asset('images/ID/'.$driver->id_photo)}}" onClick="triggerClicku_ID()" id="u_id_display" height='200' width='250' style="border: 1px solid; cursor: pointer;" />

                  </div>
                <div class="form-group">
                  <label for="u_license">License</label><br>
                  <input type="file" name="u_license" class="form-control" id="license_edit" onChange="displayImageu_Li(this)" style="display: none;">
                  <img src="{{asset('images/License/'.$driver->license)}}" onClick="triggerClicku_Li()" id="u_li_display" height='200' width='250' style="border: 1px solid; cursor: pointer;" />

                </div>

        <a id="edit_driver" class="btn btn-info">
          {{ __('Edit') }}
        </a>

      </div>
      </form>
    </div>
  </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
<script src="/assets/js/main.js"></script>

<script>
  $(document).ready(function() {
    $(document).on('click', '#save_driver', function() {
    
      $.ajax({
        type: 'POST',
        url: "{{ route('driver.store') }}",
        enctype:'',
        data: {
          '_token': "{{csrf_token()}}",
          'user_name': $("input[name='user_name']").val(),
          'full_name': $("input[name='full_name']").val(),
          'phone': $("input[name='phone']").val(),
          'email': $("input[name='email']").val(),
          'id_photo': $("input[name='id_photo']").val(),
          'license': $("input[name='license']").val(),
          'vehicle_id': $("input[name='vehicle_id']").val(),
        
        },
        processData:false,
        contentType:false,
        cache:false,
        success: function(data) { //console.log(response);
          location.reload();
        },
        error: function(rejest) {}

      });
    });


  });
</script>

<script>
  function getDriverDetails($driver_id) {
    var getDriverURL = '{{ route("driver.show","driver_id") }}';
    getDriverURL = getDriverURL.replace("driver_id", $driver_id);
    console.log(getDriverURL);
    $.ajax({
      type: 'GET',
      url: getDriverURL,

      success: function(data) {
        $('#driver_name_edit').val(data.user.user_name);
        $('#full_name_edit').val(data.user.full_name);
        $('#email_edit').val(data.user.email);
        $('#phone_edit').val(data.user.phone);
        $('#license_edit').val(data.user.license);
        $('#id_photo_edit').val(data.user.id_photo);
        $('#email_edit').val(data.user.email);
        $('#id_edit').val(data.user.id);

        // $('#editModal').modal('show');

      },
      error: function(rejest) {}

    });
  }
</script>

<script>
    //for update id_photo
    function triggerClicku_ID(e) {
      document.querySelector('#u_id_photo').click();
    }

    function displayImageu_ID(e) {
      if (e.files[0]) {
        var reader = new FileReader();
        reader.onload = function(e) {
          document.querySelector('#u_id_display').setAttribute('src', e.target.result);
        }
        reader.readAsDataURL(e.files[0]);
      }
    }
    </script>

   
<script>
  
   //for update license_photo
    function triggerClicku_Li(e) {
      document.querySelector('#u_license').click();
    }

    function displayImageu_Li(e) {
      if (e.files[0]) {
        var reader = new FileReader();
        reader.onload = function(e) {
          document.querySelector('#u_li_display').setAttribute('src', e.target.result);
        }
        reader.readAsDataURL(e.files[0]);
      }
    }
  </script>


<script>
  $(document).ready(function() {
    $(document).on('click', '#edit_driver', function() {

      $.ajax({
        type: 'POST',
        url: "{{ route('driver.update') }}",
        data: {
          '_token': "{{csrf_token()}}",
          'driver_id': $("#id_edit").val(),
          'driver_name': $("#driver_name_edit").val(),
          'full_name': $("#full_name_edit").val(),
          'email': $("#email_edit").val(),
          'phone': $("#phone_edit").val(),
          'id_photo': $("#id_photo_edit").val(),
          'license': $("#license_edit").val(),
        
        },
        success: function(data) {
          location.reload();
        },
        error: function(rejest) {}

      });
    });


  });
</script>

<script>
  function deleteDriver($driver_id) {
    var getDriverURL = '{{ route("driver.delete","driver_id") }}';
    getDriverURL = getDriverURL.replace("driver_id", $driver_id);
    console.log(getDriverURL);
    $.ajax({
      type: 'GET',
      url: getDriverURL,
      success: function(data) {
        location.reload();
      },
      error: function(rejest) {}

    });
  }
</script>

@endsection
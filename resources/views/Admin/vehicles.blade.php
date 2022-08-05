@extends('Admin')

@section('content')

<div class="m-5">


<a href="#addModal" data-toggle="modal" class="btn  btn-admin ">Add New Vehicle</a>
    <table class="pro_log">
        <thead>
            <tr>
                <th>Brand</th>
                <th>Model</th>
                <th>License Number</th>
                <th>Color</th>
                <th>Insurance</th>
                <th>Passenger count</th>
                <th>Vehicle Type</th>
                <th>Max Load Size</th>
                <th>Max Load Weight</th>
                <th>Operations </th>
            </tr>
        </thead>
        <tbody>
        @foreach($vehicles as $vehicle)
            <tr>

                <td>{{$vehicle->brand}}</td>
                <td>{{$vehicle->model}}</td>
                <td>{{$vehicle->license_num}}</td>
                <td>{{$vehicle->color}}</td>
                <td>{{$vehicle->insurance_type}}</td>
                <td>{{$vehicle->passenger_count}}</td>
                <td>{{$vehicle->vehicle_type}}</td>
                <td>{{$vehicle->max_load_size}}</td>
                <td>{{$vehicle->max_load_weight}}</td>
                <td>

                   <a href='#'> 
                     <i href="#editModal" data-toggle="modal" class="fa fa-edit blue"></i>
                   </a>
                   /
                   <a href='#'> 
                     <i href="#delModal" data-toggle="modal" class="fa fa-trash danger"></i>
                   </a>                        
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <!-- add Modal -->
    <div id="addModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog  modal-dialog-centered modal-lg" role="document">
          <div class="modal-content">
            <div class="modal-header ">

          <h2 class="modal-title" id="addModalLabel">Add New Vehicle</h2>
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            </div>
            <div class="modal-body">

            <form class="form needs-validation p-1" novalidate>
          <div class="form-group">
            <label for="brand">Brand</label>
            <input type="text" name="brand" class="form-control" id="brand" placeholder="eg. KIA,BMW,Audi " pattern="[A-Za-z].{2,}" required title="only letters are allowed">
             
            <div class="invalid-feedback">
                    Please provide a valid Brand.
                  </div>
          </div>

          <div class="form-group">
            <label for="model">Model</label>
            <input type="text" name="model" class="form-control" id="model" placeholder="eg. KIA cerato " pattern="[A-Za-z0-9].{2,}" required title="only numbers and letters are allowed">

            <div class="invalid-feedback">
                    Please provide a valid Model.
                  </div>
          </div>

          <div class="form-group">
            <label for="license_num">License Number</label>
            <input type="text" name="license_num" class="form-control" id="license_num" placeholder="eg. 231456" required pattern="[0-9]{6,}" title="only numbers allowed">

            <div class="invalid-feedback">
                    Please provide a valid License Number.
                  </div>
          </div>

          <div class="form-group">
            <label for="insurance_type">Insurance type</label>
            <div class="form-check">
              <input class="form-check-input" type="radio" name="insurance_type" id="full">
              <label class="form-check-label" for="full">
                Full
              </label>
            </div>
            <div class="form-check">
              <input class="form-check-input" type="radio" name="insurance_type" id="compulsory" checked>
              <label class="form-check-label" for="compulsory">
                Compulsory
              </label>
            </div>
          </div>

          <div class="form-group">
            <label for="color">Vehicle Color</label>
            <input type="color" name="color" id="color" class="form-control" value="#aa1313" required title="Enter Vehicle Color">


          </div>

          <div class="form-group">
            <label for="passenger_count">Passenger Count</label>
            <select name="passenger_count" id="passenger_count" class="form-select" required>
              <option>1</option>
              <option>2</option>
              <option>3</option>
              <option>4</option>
              <option>5</option>
              <option>6</option>
              <option>7</option>
            </select>

          </div>

          <div class="form-group">
            <label>Vehicle Type</label>
            <select name="vehicle_type_id" id="vehicle_type_id" class="form-select" required>
              <option>1</option>
              <option>2</option>
              <option>3</option>
              <option>4</option>
            </select>


          </div>

          <div class="form-group">
            <label for="max_load_size">Max Load Size</label>
            <input type="text" class="form-control" name="max_load_size" id="max_load_size" placeholder="Liter" required pattern="[0-9]{4,}" title="only numbers are allowed">

            <div class="invalid-feedback">
                    Please provide a valid Max Load Size.
                  </div>
          </div>

          <div class="form-group">
            <label for="max_load_weight">Max Load Weight</label>
            <input type="text" name="max_load_weight" class="form-control" id="max_load_weight" placeholder=" KG" required pattern="[0-9]{4,}" title="only numbers are allowed">

            <div class="invalid-feedback">
                    Please provide a valid Max Load Weight.
                  </div>
          </div>
 

          <div class="modal-footer">
          <div class=" signup-group">
            <button type="submit" class="btn-signup btn">
              {{ __('Save') }}
            </button>
            

          <!-- del Modal -->
      <div id="delModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog  modal-dialog-centered modal-lg" role="document">
          <div class="modal-content">
            <div class="modal-header ">

              <h4>Are you sure?</h4>
              <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            </div>
            <div class="modal-body">
              <p>Do you really want to delete this vehicle? This process cannot be undone.</p>
            </div>
            <div class="modal-footer justify-content-center">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
              <button type="button" class="btn btn-danger">Delete</button>
            </div>
          </div>
        </div>
      </div>



        <!-- edit Modal -->
      <div id="editModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog  modal-dialog-centered modal-lg" role="document">
          <div class="modal-content">
            <div class="modal-header ">

              <h4>Edit Vehicle Infomation</h4>
              <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            </div>
            <div class="modal-body">

              <form class="form needs-validation p-1" novalidate>

              <div class="form-group">
            <label for="brand">Brand</label>
            <input type="text" name="brand" class="form-control" id="brand" placeholder="eg. KIA,BMW,Audi " pattern="[A-Za-z].{2,}" required title="only letters are allowed">
             
            <div class="invalid-feedback">
                    Please provide a valid Brand.
                  </div>
          </div>

          <div class="form-group">
            <label for="model">Model</label>
            <input type="text" name="model" class="form-control" id="model" placeholder="eg. KIA cerato " pattern="[A-Za-z0-9].{2,}" required title="only numbers and letters are allowed">

            <div class="invalid-feedback">
                    Please provide a valid Model.
                  </div>
          </div>

          <div class="form-group">
            <label for="license_num">License Number</label>
            <input type="text" name="license_num" class="form-control" id="license_num" placeholder="eg. 231456" required pattern="[0-9]{6,}" title="only numbers allowed">

            <div class="invalid-feedback">
                    Please provide a valid License Number.
                  </div>
          </div>

                <div class="form-group">
            <label for="insurance_type">Insurance type</label>
            <div class="form-check">
              <input class="form-check-input" type="radio" name="insurance_type" id="full">
              <label class="form-check-label" for="full">
                Full
              </label>
            </div>
            <div class="form-check">
              <input class="form-check-input" type="radio" name="insurance_type" id="compulsory" checked>
              <label class="form-check-label" for="compulsory">
                Compulsory
              </label>
            </div>
          </div>


          <div class="form-group">
            <label for="color">Vehicle Color</label>
            <input type="color" name="color" id="color" class="form-control" value="#aa1313" required title="Enter Vehicle Color">


          </div>

          <div class="form-group">
            <label for="passenger_count">Passenger Count</label>
            <select name="passenger_count" id="passenger_count" class="form-select" required>
              <option>1</option>
              <option>2</option>
              <option>3</option>
              <option>4</option>
              <option>5</option>
              <option>6</option>
              <option>7</option>
            </select>

          </div>


            </div>
            <div class="modal-footer justify-content-center">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
              <button type="submit" class="btn btn-commn">Edit</button>
              </form>
            </div>
          </div>
        </div>
      </div>

      </form>
      </div>
      </div>
      </div>
      </div>
      
      
      <script>
    // Example starter JavaScript for disabling form submissions if there are invalid fields
    (function() {
      'use strict';
      window.addEventListener('load', function() {
        // Fetch all the forms we want to apply custom Bootstrap validation styles to
        var forms = document.getElementsByClassName('needs-validation');
        // Loop over them and prevent submission
        var validation = Array.prototype.filter.call(forms, function(form) {
          form.addEventListener('submit', function(event) {
            if (form.checkValidity() === false) {
              event.preventDefault();
              event.stopPropagation();
            }
            form.classList.add('was-validated');
          }, false);
        });
      }, false);
    })();
  </script>
</div>

@endsection
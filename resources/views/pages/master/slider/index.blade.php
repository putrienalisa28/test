@section('title', 'Master Of Item')
@extends('layouts.main')

@section('content')

<div class="container-xxl flex-grow-1 container-p-y">
    <h4 class="fw-bold py-3 mb-4">
      <span class="text-muted fw-light"> Forms /</span>
      Sliders
    </h4>
    <div class="alert alert-info d-flex align-items-center" role="alert">
      <span class="alert-icon text-info me-2">
          <i class="ti ti-info-circle ti-xs"></i>
      </span>
      SETTING ACTUAL RUN HOUR
    </div>
        
          <div class="col-12">            
            <div class="card mb-4">            
             <h5 class="card-header"></h5>             
              <div class="card-body pb-5">                           
                <form id="form-data">
                  @csrf                     
                <small class="text-light fw-semibold"></small>
                <div class="noUi-danger mt-5 mb-5 actualrun" id="slider-danger"  onclick="save()" ></div>        
                <p hidden class="mb-0">aria-valuemax: <span id="aria-valuemax" name='id="aria-valuemax"'>{{$actualhour['max_actualrun_hour']}}</span></p>   
                <p hidden class="mb-0">aria-valuenow: <span id="aria-valuenow" name="aria-valuenow">{{$actualhour['min_actualrun_hour']}}</span></p>   
              </div>
            </form>
            </div>
          </div>
    
    </div>

<script>
  $(document).ready(function() {
    const sliderDanger = document.getElementById('slider-danger');
    let nilai_awal = $('#aria-valuenow').text();
    let nilai_akhir = $('#aria-valuemax').text();
    const colorOptions = {
      start: [nilai_awal, nilai_akhir],
      connect: true,
      behaviour: 'tap-drag',
      step: 250,
      tooltips: true,
      range: {
        min: 0,
        max: 7500
      },
      pips: {
        mode: 'steps',
        stepped: true,
        density: 5
      },
      direction: isRtl ? 'rtl' : 'ltr'
    };

    if (sliderDanger) {
      noUiSlider.create(sliderDanger, colorOptions);
    }
  });

  function save() {
    var ariaValuemax = parseFloat($('.noUi-handle-lower').attr('aria-valuemax'));
    var ariaValuenow = parseFloat($('.noUi-handle-lower').attr('aria-valuenow'));

            var formData = {
              'ariaValuemax' : ariaValuemax,
              'ariaValuenow' : ariaValuenow,
            }
        
            swAlertConfirm('{{ route('slider.store') }}', undefined, undefined, formData)

        }



    </script>
@endsection
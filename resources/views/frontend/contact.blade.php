@extends('frontend.layouts.main')
@section('main-container')
      <!-- end banner -->
      <!-- appointment -->
      <div class="appointment">
         <div class="container">
            <div class="row">
               <div class="col-md-12 ">
                  <div class="titlepage text_align_center">
                     <h2>Contact Us Edit</h2>
                     <p>Contact with us for any kind of inquiries and complaints</p>
                  </div>
               </div>
               <div class="col-md-12">
                  {{-- <form id="request" class="main_form"> --}}
                     {!! Form::open([
                        'url' => url('stofile'),
                        'method' => 'post',
                        'id' => 'contact',
                        'role' => 'form',
                        'class' => 'main_form',
                        'enctype' => 'multipart/formdata'
                         
                         ]) !!}
                     <div class="row">
                        <div class="col-md-6 ">
                           {{-- <input class="form_control" placeholder="Your name" type="type" name=" Name">  --}}
                           {!! form::text('name' , '' , [
                                       'class'=> "form_control", 'placeholder'=>"Your Name"
                           ]) !!}
                        </div>
                        <div class="col-md-6">
                           <input class="form_control" placeholder="Email" type="type" name="Email"> 
                        </div>
                        <div class="col-md-6">
                           <input class="form_control" placeholder="Phone Number" type="type" name="Phone Number">                          
                        </div>
                        <div class="col-md-6">
                           {!!  Form::select('size', 
                           ['L' => 'Large', 
                           'M' => 'Medium',
                           'S' => 'Small',
                           ],
                           "M",
                           [
                              'id'=>"size",
                              'class'=>"form_control"
                              
                              
                           ]
                           
                           ) !!}                       
                        </div>
                        <div class="col-md-6 ">
                           <input class="form_control" placeholder="Time" type="type" name=" Time"> 
                        </div>
                        <div class="col-md-6">
                           <input type="text" class="form_control" id="my_date_picker" placeholder="Select Date" >
                        </div>
                        <div class="col-md-12">
                           <textarea style=" color: #d0d0cf;" class="textarea" placeholder="Message" type="type" name="message">message </textarea>
                        </div>
                        <div class="col-md-12">
                           <button class="send_btn">Send Now</button>
                        </div>
                     </div>
                  {{-- </form> --}}
                  {!! form::close()!!}
               </div>
            </div>
         </div>
      </div>
      <!-- end appointment -->
     @endsection
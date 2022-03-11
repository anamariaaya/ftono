<?php
    require 'includes/functions.php';
    includeTemplate('header')
?>

<div class="container">


<ul class="nav nav-justified setup-panel">
    <li class="active">
        <a href="#step-1">
            <span>1</span> Login
        </a>
    </li>
    <li class="disabled">
        <a href="#step-2">
            <span>2</span> Address Details

        </a>
    </li>
    <li class="disabled"><a href="#step-3"><span>3</span>
           Delivery Slot
        </a></li>
    <li class="disabled"><a href="#step-4"><span>4</span>
           Order Summary
        </a></li>

    <li class="disabled"><a href="#step-5"><span>5</span>
             Payment Options
          </a></li>





</ul>

<div class="setup-content" id="step-1">
    <div class="content">
        <h1> STEP 1</h1>

        <button id="activate-step-2" class="btn btn-primary btn-lg">Activate Step 2</button>
    </div>
</div>
<div class="setup-content" id="step-2">
    <div class="content">

        <h1>ADDRESS  DETAILS</h1>
        <input type="button" value="REVIEW AND PLACE ORDER" class="btn btn-primary btn-large pull-right" />
        <div class="row">
            <div class="col-md-6">
                <h2>Select An Existing Address</h2>
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <strong>Home Address</strong>
                        <div class="edit_controls pull-right">
                            <span class="glyphicon glyphicon-pencil"></span>
                            <span class="glyphicon glyphicon-remove-circle"></span>
                        </div>
                        <!-- //.edit_controls-->


                    </div>
                    <div class="panel-body">
                        <div class="" home-number>
                            Home number.
                        </div>
                        <!-- 	//.home-number	 -->
                        <div class="" address1>
                            Rajajinagar Bhashyam.
                        </div>
                        <!-- 	//.address1	 -->
                        <div class="" address2>
                            Bengaluru - 560010
                        </div>
                        <!-- 	//.address2	 -->
                        <div class="phone_number">
                            Ph. No.- +91-9845052600
                        </div>
                        <!-- 	//.address2	 -->

                    </div>
                </div>
            </div>
            <div class="col-md-6">

                <form class="form-horizontal">
                    <fieldset>

                        <!-- Form Name -->
                        <h2>Enter Shipping Address</h2>

                        <!-- Text input-->
                        <div class="form-group">
                            <label class="col-md-4 control-label" for="fName">First Name</label>
                            <div class="col-md-6">
                                <input id="fName" name="fName" type="text" placeholder="First Name" class="form-control input-md" required="">

                            </div>
                        </div>

                        <!-- Text input-->
                        <div class="form-group">
                            <label class="col-md-4 control-label" for="lName">Last Name</label>
                            <div class="col-md-6">
                                <input id="lName" name="lName" type="text" placeholder="Last Name" class="form-control input-md">

                            </div>
                        </div>

                        <!-- Textarea -->
                        <div class="form-group">
                            <label class="col-md-4 control-label" for="address">Address</label>
                            <div class="col-md-6">
                                <textarea class="form-control" id="address" name="address">Address details</textarea>
                            </div>
                        </div>

                        <!-- Text input-->
                        <div class="form-group">
                            <label class="col-md-4 control-label" for="Landmark">Landmark</label>
                            <div class="col-md-6">
                                <input id="Landmark" name="Landmark" type="text" placeholder="Landmark" class="form-control input-md">

                            </div>
                        </div>

                        <!-- Text input-->
                        <div class="form-group">
                            <label class="col-md-4 control-label" for="Pincode">Pincode</label>
                            <div class="col-md-6">
                                <input id="Pincode" name="Pincode" type="text" placeholder="Pincode" class="form-control input-md">

                            </div>
                        </div>

                        <!-- Select Basic -->
                        <div class="form-group">
                            <label class="col-md-4 control-label" for="area">Area</label>
                            <div class="col-md-6">
                                <select id="area" name="area" class="form-control">
                                    <option value="1">Option one</option>
                                    <option value="2">Option two</option>
                                </select>
                            </div>
                        </div>

                        <!-- Text input-->
                        <div class="form-group">
                            <label class="col-md-4 control-label" for="Country">Country</label>
                            <div class="col-md-6">
                                <input id="Country" name="Country" type="text" placeholder="Country" class="form-control input-md">

                            </div>
                        </div>

                        <!-- Text input-->
                        <div class="form-group">
                            <label class="col-md-4 control-label" for="State">State</label>
                            <div class="col-md-6">
                                <input id="State" name="State" type="text" placeholder="State" class="form-control input-md">

                            </div>
                        </div>

                        <!-- Text input-->
                        <div class="form-group">
                            <label class="col-md-4 control-label" for="Mobile No">Mobile No</label>
                            <div class="col-md-6">
                                <input id="Mobile No" name="Mobile No" type="text" placeholder="Mobile No" class="form-control input-md">

                            </div>
                        </div>

                        <!-- Text input-->
                        <div class="form-group">
                            <label class="col-md-4 control-label" for="City">City</label>
                            <div class="col-md-6">
                                <input id="City" name="City" type="text" placeholder="City" class="form-control input-md">

                            </div>
                        </div>

                        <!-- Multiple Checkboxes (inline) -->
                        <div class="form-group">
                            <label class="col-md-4 control-label" for="Billing Address">Billing Address</label>
                            <div class="col-md-6">
                                <label class="checkbox-inline" for="Billing Address-0">
                                    <input type="checkbox" name="Billing Address" id="Billing Address-0" value="Same as Shipping Address"> Same as Shipping Address
                                </label>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-4 control-label" for="singlebutton"></label>
                            <div class="col-md-4">
                                <button id="activate-step-3" name="singlebutton" class="btn btn-primary">Review and place order</button>
                            </div>
                        </div>

                    </fieldset>
                </form>

            </div>
        </div>
    </div>
</div>
<!-- step-2  -->
<div class=" setup-content" id="step-3">
    <div class="content">
        <h1> SELECT DELIVERY SLOT</h1>
        <p>
            <strong>Selected Slot : Tomorrow : 05.00-07.30pm</strong>
        </p>
        <button id="activate-step-4" class="btn btn-primary pull-right">Process to pay</button>

        <table class="table table-striped">
            <thead>
                <tr>
                    <th> Day / Date</th>
                    <th colspan="5" class="text-center"> Time Slots</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <th>Tomorrow </th>
                    <td>
                        <label class="radio-inline">
                            <input type="radio" name="delivery-slot" value="08.00 - 10.00 am ">08.00 - 10.00 am
                        </label>
                    </td>
                    <td>
                        <label class="radio-inline">
                            <input type="radio" name="delivery-slot" value="11.00 am - 01.00 pm">11.00 am - 01.00 pm
                        </label>
                    </td>
                    <td>
                        <label class="radio-inline">
                            <input type="radio" name="delivery-slot" value="02.00 - 04.00 pm ">02.00 - 04.00 pm
                        </label>
                    </td>
                    <td>
                        <label class="radio-inline">
                            <input type="radio" name="delivery-slot" value="05.00 - 07.30 pm">05.00 - 07.30 pm
                        </label>
                    </td>
                    <td>
                        <label class="radio-inline">
                            <input type="radio" name="delivery-slot" value="07.30 - 10.00 pm">07.30 - 10.00 pm
                        </label>
                    </td>
                </tr>
                <tr>
                    <th calss="odd">Wed 22-06-2016 </th>
                    <td>
                        <label class="radio-inline">
                            <input type="radio" name="delivery-slot" value="08.00 - 10.00 am ">08.00 - 10.00 am
                        </label>
                    </td>
                    <td>
                        <label class="radio-inline">
                            <input type="radio" name="delivery-slot" value="11.00 am - 01.00 pm">11.00 am - 01.00 pm
                        </label>
                    </td>
                    <td>
                        <label class="radio-inline">
                            <input type="radio" name="delivery-slot" value="02.00 - 04.00 pm ">02.00 - 04.00 pm
                        </label>
                    </td>
                    <td>
                        <label class="radio-inline">
                            <input type="radio" name="delivery-slot" value="05.00 - 07.30 pm">05.00 - 07.30 pm
                        </label>
                    </td>
                    <td>
                        <label class="radio-inline">
                            <input type="radio" name="delivery-slot" value="07.30 - 10.00 pm">07.30 - 10.00 pm
                        </label>
                    </td>
                </tr>
                <tr>
                    <th calss="odd">Thu 23-06-2016 </th>
                    <td>
                        <label class="radio-inline">
                            <input type="radio" name="delivery-slot" value="08.00 - 10.00 am ">08.00 - 10.00 am
                        </label>
                    </td>
                    <td>
                        <label class="radio-inline">
                            <input type="radio" name="delivery-slot" value="11.00 am - 01.00 pm">11.00 am - 01.00 pm
                        </label>
                    </td>
                    <td>
                        <label class="radio-inline">
                            <input type="radio" name="delivery-slot" value="02.00 - 04.00 pm ">02.00 - 04.00 pm
                        </label>
                    </td>
                    <td>
                        <label class="radio-inline">
                            <input type="radio" name="delivery-slot" value="05.00 - 07.30 pm">05.00 - 07.30 pm
                        </label>
                    </td>
                    <td>
                        <label class="radio-inline">
                            <input type="radio" name="delivery-slot" value="07.30 - 10.00 pm">07.30 - 10.00 pm
                        </label>
                    </td>
                </tr>
                <tr>
                    <th calss="odd">Fri 24-06-2016 </th>
                    <td>
                        <label class="radio-inline">
                            <input type="radio" name="delivery-slot" value="08.00 - 10.00 am ">08.00 - 10.00 am
                        </label>
                    </td>
                    <td>
                        <label class="radio-inline">
                            <input type="radio" name="delivery-slot" value="11.00 am - 01.00 pm">11.00 am - 01.00 pm
                        </label>
                    </td>
                    <td>
                        <label class="radio-inline">
                            <input type="radio" name="delivery-slot" value="02.00 - 04.00 pm ">02.00 - 04.00 pm
                        </label>
                    </td>
                    <td>
                        <label class="radio-inline">
                            <input type="radio" name="delivery-slot" value="05.00 - 07.30 pm">05.00 - 07.30 pm
                        </label>
                    </td>
                    <td>
                        <label class="radio-inline">
                            <input type="radio" name="delivery-slot" value="07.30 - 10.00 pm">07.30 - 10.00 pm
                        </label>
                    </td>
                </tr>
                <tr>
                    <th calss="odd">Fri 25-06-2016 </th>
                    <td>
                        <label class="radio-inline">
                            <input type="radio" name="delivery-slot" value="08.00 - 10.00 am ">08.00 - 10.00 am
                        </label>
                    </td>
                    <td>
                        <label class="radio-inline">
                            <input type="radio" name="delivery-slot" value="11.00 am - 01.00 pm">11.00 am - 01.00 pm
                        </label>
                    </td>
                    <td>
                        <label class="radio-inline">
                            <input type="radio" name="delivery-slot" value="02.00 - 04.00 pm ">02.00 - 04.00 pm
                        </label>
                    </td>
                    <td>
                        <label class="radio-inline">
                            <input type="radio" name="delivery-slot" value="05.00 - 07.30 pm">05.00 - 07.30 pm
                        </label>
                    </td>
                    <td>
                        <label class="radio-inline">
                            <input type="radio" name="delivery-slot" value="07.30 - 10.00 pm">07.30 - 10.00 pm
                        </label>
                    </td>
                </tr>
                <tr>
                    <th calss="odd">Sat 25-06-2016 </th>
                    <td>
                        <label class="radio-inline">
                            <input type="radio" name="delivery-slot" value="08.00 - 10.00 am ">08.00 - 10.00 am
                        </label>
                    </td>
                    <td>
                        <label class="radio-inline">
                            <input type="radio" name="delivery-slot" value="11.00 am - 01.00 pm">11.00 am - 01.00 pm
                        </label>
                    </td>
                    <td>
                        <label class="radio-inline">
                            <input type="radio" name="delivery-slot" value="02.00 - 04.00 pm ">02.00 - 04.00 pm
                        </label>
                    </td>
                    <td>
                        <label class="radio-inline">
                            <input type="radio" name="delivery-slot" value="05.00 - 07.30 pm">05.00 - 07.30 pm
                        </label>
                    </td>
                    <td>
                        <label class="radio-inline">
                            <input type="radio" name="delivery-slot" value="07.30 - 10.00 pm">07.30 - 10.00 pm
                        </label>
                    </td>
                </tr>
                <tr>
                    <th calss="odd">Sun 26-06-2016 </th>
                    <td>
                        <label class="radio-inline">
                            <input type="radio" name="delivery-slot" value="08.00 - 10.00 am ">08.00 - 10.00 am
                        </label>
                    </td>
                    <td>
                        <label class="radio-inline">
                            <input type="radio" name="delivery-slot" value="11.00 am - 01.00 pm">11.00 am - 01.00 pm
                        </label>
                    </td>
                    <td>
                        <label class="radio-inline">
                            <input type="radio" name="delivery-slot" value="02.00 - 04.00 pm ">02.00 - 04.00 pm
                        </label>
                    </td>
                    <td>
                        <label class="radio-inline">
                            <input type="radio" name="delivery-slot" value="05.00 - 07.30 pm">05.00 - 07.30 pm
                        </label>
                    </td>
                    <td>
                        <label class="radio-inline">
                            <input type="radio" name="delivery-slot" value="07.30 - 10.00 pm">07.30 - 10.00 pm
                        </label>
                    </td>
                </tr>
            </tbody>
        </table>
        <ul class="time_slot">
            <li class="color--available">Available</li>
            <li class="color--na">Not Available</li>
            <li class="color--sel">Selected</li>
        </ul>
    </div>
</div>
<!-- step-3  -->
<div class=" setup-content" id="step-4">
    <div class="content">
        <h1> STEP 4</h1>
        <button id="activate-step-5" class="btn btn-primary btn-lg">Activate Step 5</button>
    </div>
</div>
<!-- step-4  -->
<div class="setup-content" id="step-5">
    <div class="content">
        <h1> STEP 5</h1>

    </div>
</div>
<!-- step-5  -->
</div>




<?php
    includeTemplate('footer');
?>
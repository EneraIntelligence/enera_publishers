<!-- second section -->
<h3>Vehicle information</h3>
<section>
    <h2 class="heading_a">
        Vehicle information
        <span class="sub-heading">Lorem ipsum dolor sit amet, consectetur adipisicing elit.</span>
    </h2>
    <hr class="md-hr"/>
    <div class="uk-grid uk-grid-width-large-1-2 uk-grid-width-xlarge-1-4" data-uk-grid-margin>
        <div class="parsley-row">
            <label for="wizard_vehicle_title_number">Title Number<span class="req">*</span></label>
            <input type="text" name="wizard_vehicle_title_number" id="wizard_vehicle_title_number" required class="md-input" />
        </div>
        <div class="parsley-row">
            <label for="wizard_vehicle_vin">VIN<span class="req">*</span></label>
            <input type="text" name="wizard_vehicle_vin" id="wizard_vehicle_vin" required class="md-input" />
        </div>
        <div class="parsley-row">
            <label for="wizard_vehicle_plate_number">Current Plate Number<span class="req">*</span></label>
            <input type="text" name="wizard_vehicle_plate_number" id="wizard_vehicle_plate_number" required class="md-input" />
        </div>
        <div class="parsley-row">
            <label for="wizard_vehicle_expiration">Expiration Date<span class="req">*</span></label>
            <input type="text" name="wizard_vehicle_expiration" id="wizard_vehicle_expiration" required class="md-input" data-parsley-americandate data-parsley-americandate-message="This value should be a valid date (MM.DD.YYYY)" data-uk-datepicker="{format:'MM.DD.YYYY'}" />
        </div>
    </div>
    <div class="uk-grid uk-grid-width-large-1-3 uk-grid-width-xlarge-1-6" data-uk-grid-margin>
        <div class="parsley-row">
            <label for="wizard_vehicle_year">Registration Year</label>
            <input type="text" name="wizard_vehicle_year" id="wizard_vehicle_year" class="md-input" data-uk-datepicker="{format:'MM.YYYY'}" />
        </div>
        <div class="parsley-row">
            <label for="wizard_vehicle_make">Make</label>
            <input type="text" name="wizard_vehicle_make" id="wizard_vehicle_make" class="md-input" />
        </div>
        <div class="parsley-row">
            <label for="wizard_vehicle_model">Model<span class="req">*</span></label>
            <input type="text" name="wizard_vehicle_model" id="wizard_vehicle_model" required class="md-input" />
        </div>
        <div class="parsley-row">
            <label for="wizard_vehicle_body">Body Type<span class="req">*</span></label>
            <input type="text" name="wizard_vehicle_body" id="wizard_vehicle_body" required class="md-input" />
        </div>
        <div class="parsley-row">
            <label for="wizard_vehicle_axles">Axles</label>
            <input type="text" name="wizard_vehicle_axles" id="wizard_vehicle_axles" class="md-input" />
        </div>
        <div class="parsley-row">
            <label for="wizard_vehicle_fuel">Fuel<span class="req">*</span></label>
            <input type="text" name="wizard_vehicle_fuel" id="wizard_vehicle_fuel" required class="md-input" />
        </div>
    </div>
</section>
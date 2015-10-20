<!-- third section -->
<h3>Confirmar y enviar</h3>
<section>
    <h2 class="heading_a">
        Additional information
        <span class="sub-heading">Lorem ipsum dolor sit amet, consectetur adipisicing elit.</span>
    </h2>
    <hr class="md-hr"/>
    <div class="uk-grid uk-margin-large-bottom" data-uk-grid-margin>
        <div class="uk-width-1-1">
            <label class="uk-form-label">Location Where Vehicle is Principally Garaged</label>
            <div class="uk-grid" data-uk-grid-margin="">
                <div class="uk-width-medium-2-10 parsley-row">
                                                    <span class="icheck-inline uk-margin-top uk-margin-left">
                                                        <input type="radio" name="wizard_additional_location" id="wizard_status_location_city" class="wizard-icheck" value="City" />
                                                        <label for="wizard_status_location_city" class="inline-label">City</label>
                                                    </span>
                </div>
                <div class="uk-width-medium-2-10 parsley-row">
                                                    <span class="icheck-inline uk-margin-top uk-margin-left">
                                                        <input type="radio" name="wizard_additional_location" id="wizard_status_location_county" class="wizard-icheck" value="County" />
                                                        <label for="wizard_status_location_county" class="inline-label">County</label>
                                                    </span>
                </div>
                <div class="uk-width-medium-3-10 parsley-row">
                    <div class="uk-input-group">
                                                        <span class="uk-input-group-addon">
                                                           <input type="radio" name="wizard_additional_location" class="wizard-icheck" value="town" />
                                                        </span>
                        <label for="wizard_location_town">Town of</label>
                        <input type="text" class="md-input" name="wizard_location_town" id="wizard_location_town" />
                    </div>
                </div>
            </div>
        </div>
    </div>
    <span class="uk-alert uk-alert-info">If you would like your registration renewals sent to an address other than your residence/business address, enter it below.</span>
    <div class="uk-grid" data-uk-grid-margin>
        <div class="uk-width-medium-2-6 parsley-row">
            <label for="wizard_vehicle_registration_address">Registration Mailing Address</label>
            <input type="text" name="wizard_vehicle_registration_address" id="wizard_vehicle_registration_address" required class="md-input" />
        </div>
        <div class="uk-width-medium-1-6 parsley-row">
            <label for="wizard_vehicle_registration_city">City<span class="req">*</span></label>
            <input type="text" name="wizard_vehicle_registration_city" id="wizard_vehicle_registration_city" required class="md-input" />
        </div>
        <div class="uk-width-medium-1-6 parsley-row">
            <label for="wizard_vehicle_registration_state">State<span class="req">*</span></label>
            <input type="text" name="wizard_vehicle_registration_state" id="wizard_vehicle_registration_state" required class="md-input" />
        </div>
        <div class="uk-width-medium-1-6 parsley-row">
            <label for="wizard_vehicle_registration_zip">ZIP<span class="req">*</span></label>
            <input type="text" name="wizard_vehicle_registration_zip" id="wizard_vehicle_registration_zip" required class="md-input" />
        </div>
        <div class="uk-width-medium-1-6 parsley-row">
            <label for="wizard_vehicle_registration_code">Code<span class="req">*</span></label>
            <input type="text" name="wizard_vehicle_registration_code" id="wizard_vehicle_registration_code" required class="md-input" />
        </div>
    </div>
</section>
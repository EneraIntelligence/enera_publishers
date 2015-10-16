<!-- first section -->
<h3>Owner information</h3>
<section>
    <h2 class="heading_a">
        Owner Information
        <span class="sub-heading">Lorem ipsum dolor sit amet, consectetur adipisicing elit.</span>
    </h2>
    <hr class="md-hr"/>
    <div class="uk-grid">
        <div class="uk-width-medium-1-1 parsley-row">
            <label for="wizard_fullname">Full Name<span class="req">*</span></label>
            <input type="text" name="wizard_fullname" id="wizard_fullname" required class="md-input" />
        </div>
    </div>
    <div class="uk-grid">
        <div class="uk-width-medium-1-1 parsley-row">
            <label for="wizard_address">Address<span class="req">*</span></label>
            <input type="text" name="wizard_address" id="wizard_address" required class="md-input" />
        </div>
    </div>

    <div class="uk-grid" data-uk-grid-margin>
        <div class="uk-width-medium-1-3 parsley-row">
            <label for="wizard_birth">Birth Date<span class="req">*</span></label>
            <input type="text" name="wizard_birth" id="wizard_birth" required class="md-input" data-parsley-americandate data-parsley-americandate-message="This value should be a valid date (MM.DD.YYYY)" data-uk-datepicker="{format:'MM.DD.YYYY'}" />
        </div>
        <div class="uk-width-medium-1-3 parsley-row">
            <label for="wizard_birth_place">Place of Birth<span class="req">*</span></label>
            <input type="text" name="wizard_birth_place" id="wizard_birth_place" required class="md-input" />
        </div>
        <div class="uk-width-medium-1-3 parsley-row">
            <label class="uk-form-label">Martial Status<span class="req">*</span></label>
                                            <span class="icheck-inline">
                                                <input type="radio" name="wizard_status" id="wizard_status_married" required class="wizard-icheck" value="married" />
                                                <label for="wizard_status_married" class="inline-label">Married</label>
                                            </span>
                                            <span class="icheck-inline">
                                                <input type="radio" name="wizard_status" id="wizard_status_single" class="wizard-icheck" value="single" />
                                                <label for="wizard_status_single" class="inline-label">Single</label>
                                            </span>
        </div>
    </div>
    <div class="uk-grid uk-grid-width-medium-1-2 uk-grid-width-large-1-4" data-uk-grid-margin>
        <div class="parsley-row">
            <div class="uk-input-group">
                                                <span class="uk-input-group-addon">
                                                    <a href="#"><i class="material-icons">&#xE0CD;</i></a>
                                                </span>
                <label for="wizard_phone">Phone Number</label>
                <input type="text" class="md-input" name="wizard_phone" id="wizard_phone" />
            </div>
        </div>
        <div class=" parsley-row">
            <div class="uk-input-group">
                                                <span class="uk-input-group-addon">
                                                    <a href="#"><i class="material-icons">&#xE0BE;</i></a>
                                                </span>
                <label for="wizard_email">Email</label>
                <input type="text" class="md-input" name="wizard_email" id="wizard_email" />
            </div>
        </div>
        <div class="parsley-row">
            <div class="uk-input-group">
                                                <span class="uk-input-group-addon">
                                                    <a href="#"><i class="uk-icon-skype"></i></a>
                                                </span>
                <label for="wizard_skype">Skype</label>
                <input type="text" class="md-input" name="wizard_skype" id="wizard_skype" />
            </div>
        </div>
        <div class="parsley-row">
            <div class="uk-input-group">
                                                <span class="uk-input-group-addon">
                                                    <a href="#"><i class="uk-icon-twitter"></i></a>
                                                </span>
                <label for="wizard_twitter">Twitter</label>
                <input type="text" class="md-input" name="wizard_twitter" id="wizard_twitter" />
            </div>
        </div>
    </div>
</section>
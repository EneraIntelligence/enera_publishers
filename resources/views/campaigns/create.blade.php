@extends('layouts.main')

@section('content')
    <div id="page_content">
        <div id="page_content_inner">

            <h2 class="heading_b uk-margin-bottom">Nueva campaña</h2>

            <div class="uk-grid" data-uk-grid-margin data-uk-grid-match id="user_profile">
                <div class="uk-width-large-7-10">
                    <div class="md-card uk-margin-large-bottom">
                        <div class="md-card-content">
                            <form class="uk-form-stacked" id="wizard_advanced_form">
                                <div id="wizard_advanced">

                                    @include('campaigns.create_wizard.step_1')

                                    @include('campaigns.create_wizard.step_2')

                                    @include('campaigns.create_wizard.step_3')

                                    @include('campaigns.create_wizard.step_4')

                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="uk-width-large-3-10">
                    <div class="md-card">
                        <div class="md-card-content">
                            <div class="uk-margin-medium-bottom">
                                <h3 class="heading_c uk-margin-bottom">Alerts</h3>
                                <ul class="md-list md-list-addon">
                                    <li>
                                        <div class="md-list-addon-element">
                                            <i class="md-list-addon-icon material-icons uk-text-warning">&#xE8B2;</i>
                                        </div>
                                        <div class="md-list-content">
                                            <span class="md-list-heading">Ab ut aut.</span>
                                            <span class="uk-text-small uk-text-muted uk-text-truncate">Sequi omnis voluptatem quibusdam vel repellat dolor corporis.</span>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="md-list-addon-element">
                                            <i class="md-list-addon-icon material-icons uk-text-success">&#xE88F;</i>
                                        </div>
                                        <div class="md-list-content">
                                            <span class="md-list-heading">Ipsa nulla.</span>
                                            <span class="uk-text-small uk-text-muted uk-text-truncate">Sequi exercitationem debitis delectus.</span>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="md-list-addon-element">
                                            <i class="md-list-addon-icon material-icons uk-text-danger">&#xE001;</i>
                                        </div>
                                        <div class="md-list-content">
                                            <span class="md-list-heading">Aut natus.</span>
                                            <span class="uk-text-small uk-text-muted uk-text-truncate">Sed sunt occaecati et velit quas.</span>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                            <h3 class="heading_c uk-margin-bottom">Friends</h3>
                            <ul class="md-list md-list-addon uk-margin-bottom">
                                <li>
                                    <div class="md-list-addon-element">
                                        <img class="md-user-image md-list-addon-avatar" src="assets/img/avatars/avatar_02_tn.png" alt=""/>
                                    </div>
                                    <div class="md-list-content">
                                        <span class="md-list-heading">Geovanni Deckow</span>
                                        <span class="uk-text-small uk-text-muted">Optio rerum fugiat voluptates animi.</span>
                                    </div>
                                </li>
                                <li>
                                    <div class="md-list-addon-element">
                                        <img class="md-user-image md-list-addon-avatar" src="assets/img/avatars/avatar_07_tn.png" alt=""/>
                                    </div>
                                    <div class="md-list-content">
                                        <span class="md-list-heading">Rebeka Olson</span>
                                        <span class="uk-text-small uk-text-muted">Voluptas iusto atque tenetur earum.</span>
                                    </div>
                                </li>
                                <li>
                                    <div class="md-list-addon-element">
                                        <img class="md-user-image md-list-addon-avatar" src="assets/img/avatars/avatar_06_tn.png" alt=""/>
                                    </div>
                                    <div class="md-list-content">
                                        <span class="md-list-heading">Letha Witting MD</span>
                                        <span class="uk-text-small uk-text-muted">Nihil rem molestiae minus cum.</span>
                                    </div>
                                </li>
                            </ul>
                            <a class="md-btn md-btn-flat md-btn-flat-primary" href="#">Show all</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop

@section('scripts')

    <script>
        // load parsley config (altair_admin_common.js)
        altair_forms.parsley_validation_config();
        // load extra validators
        altair_forms.parsley_extra_validators();
    </script>

    {!! HTML::script('bower_components/parsleyjs/dist/parsley.min.js') !!}
            <!-- jquery steps -->
    {!! HTML::script('assets/js/custom/wizard_steps.js') !!}
    <!--  forms wizard functions -->
    {!! HTML::script('assets/js/pages/forms_wizard.js') !!}

@stop
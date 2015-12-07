@extends('layouts.main')
@section('title', ' - Budget')
@section('head_scripts')
    <style>

    </style>
@stop
@section('content')
    <div id="page_content">
        <div id="page_content_inner">
            <div class="uk-width-large-7-10 uk-container-center" data-uk-scrollspy="{cls:'uk-animation-scale-up', repeat: false}">
                <div class="md-card md-card-single main-print" id="invoice" style="opacity: 1; transform: scale(1);">
                    <div id="invoice_preview">
                        <div class="md-card-toolbar">
                            <div class="md-card-toolbar-actions hidden-print">
                                <i class="md-icon material-icons" id="invoice_print"></i>
                                <div class="md-card-dropdown" data-uk-dropdown="" aria-haspopup="true" aria-expanded="false">
                                    <i class="md-icon material-icons"></i>
                                    <div class="uk-dropdown uk-dropdown-flip uk-dropdown-small">
                                        <ul class="uk-nav">
                                            <li><a href="#">Archive</a></li>
                                            <li><a href="#" class="uk-text-danger">Remove</a></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <h3 class="md-card-toolbar-heading-text large" id="invoice_name">
                                Invoice 77/2015
                            </h3>
                        </div>
                        <div class="md-card-content" style="height: 605px;">
                            <div class="uk-margin-medium-bottom">
                                <span class="uk-text-muted uk-text-small uk-text-italic">Date:</span> 07.12.2015
                                <br>
                                <span class="uk-text-muted uk-text-small uk-text-italic">Due Date:</span> 21.12.2015
                            </div>
                            <div class="uk-grid" data-uk-grid-margin="">
                                <div class="uk-width-small-3-5">
                                    <div class="uk-margin-bottom">
                                        <span class="uk-text-muted uk-text-small uk-text-italic">From:</span>
                                        <address>
                                            <p><strong>Bailey-Lynch</strong></p>
                                            <p>2808 Robson St</p>
                                            <p>Vancouver, BC V6B 3K9</p>
                                        </address>
                                    </div>
                                    <div class="uk-margin-medium-bottom">
                                        <span class="uk-text-muted uk-text-small uk-text-italic">To:</span>
                                        <address>
                                            <p><strong>Price Ltd</strong></p>
                                            <p>2894 Bond Street</p>
                                            <p>Providence, RI 02908</p>
                                        </address>
                                    </div>
                                </div>
                                <div class="uk-width-small-2-5 uk-grid-margin">
                                    <span class="uk-text-muted uk-text-small uk-text-italic">Total:</span>
                                    <p class="heading_b uk-text-success">$3,751.50</p>
                                    <p class="uk-text-small uk-text-muted uk-margin-top-remove">Incl. VAT - $862.85</p>
                                </div>
                            </div>
                            <div class="uk-grid uk-margin-large-bottom">
                                <div class="uk-width-1-1">
                                    <table class="uk-table">
                                        <thead>
                                        <tr class="uk-text-upper">
                                            <th>Description</th>
                                            <th>Rate</th>
                                            <th class="uk-text-center">Hours</th>
                                            <th class="uk-text-center">Vat</th>
                                            <th class="uk-text-center">Total</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <tr class="uk-table-middle">
                                            <td>
                                                <span class="uk-text-large">Website design &amp; development</span><br>
                                                <span class="uk-text-muted uk-text-small">Lorem ipsum dolor sit amet, consectetur adipisicing elit.</span>
                                            </td>
                                            <td>
                                                $25.00
                                            </td>
                                            <td class="uk-text-center">
                                                32
                                            </td>
                                            <td class="uk-text-center">
                                                23%
                                            </td>
                                            <td class="uk-text-center">
                                                $984.00
                                            </td>
                                        </tr>
                                        <tr class="uk-table-middle">
                                            <td>
                                                <span class="uk-text-large">Search engine optimization</span><br>
                                                <span class="uk-text-muted uk-text-small">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ab blanditiis cupiditate delectus deserunt.</span>
                                            </td>
                                            <td>
                                                $50.00
                                            </td>
                                            <td class="uk-text-center">
                                                20
                                            </td>
                                            <td class="uk-text-center">
                                                23%
                                            </td>
                                            <td class="uk-text-center">
                                                $1,230.00
                                            </td>
                                        </tr>
                                        <tr class="uk-table-middle">
                                            <td>
                                                <span class="uk-text-large">Consulting service</span><br>
                                                <span class="uk-text-muted uk-text-small">Lorem ipsum dolor sit amet, consectetur.</span>
                                            </td>
                                            <td>
                                                $100.00
                                            </td>
                                            <td class="uk-text-center">
                                                12.5
                                            </td>
                                            <td class="uk-text-center">
                                                23%
                                            </td>
                                            <td class="uk-text-center">
                                                $1,537.50
                                            </td>
                                        </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>

@stop
@section('scripts')
    <script>

    </script>
@stop

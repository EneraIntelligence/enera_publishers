<!-- fourth section -->
<h3>Presupuesto</h3>
<section>
    <h2 class="heading_a">
        Asigna presupuesto a tu campaña
    </h2>
    <hr class="md-hr"/>

    <div class="uk-grid" id="budget-block">

        <div class="uk-width-medium-1-1 parsley-row">
            <h3>Balance Actual:</h3>
            <p>  ${{ number_format( (float) auth()->user()->wallet->current, 2, '.', '') }}   </p>
            <br>
        </div>

        <div class="uk-width-medium-1-2 parsley-row">
            <label for="budget">Presupuesto</label>
            <input class="md-input masked_input" required name="budget" id="budget_input" type="text" data-inputmask="'alias': 'numeric', 'groupSeparator': ',', 'autoGroup': true, 'digits': 2, 'digitsOptional': false, 'prefix': '$ ', 'placeholder': '0'" data-inputmask-showmaskonhover="false" />
        </div>

        <div class="uk-width-medium-1-1 parsley-row">
            <p>El costo por interacción es de:
                <span class="step2-field banner-link captcha like ">$1.00</span>
                <span class="step2-field video ">$1.20</span>
                <span class="step2-field mailing-list ">$1.50</span>
                <span class="step2-field survey ">$2.00</span>
            </p>
            <br>
        </div>


        <div class="uk-width-medium-1-1 parsley-row">
            <h3>Saldo</h3>
            <p id="balance">  ${{ number_format( (float) auth()->user()["balance"]["current"], 2, '.', '') }}   </p>
            <br>
        </div>

    </div>

</section>
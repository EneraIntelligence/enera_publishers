$(function() {
    "use strict";

    // page onload functions


});

new_campaign =
{
    base_url:"",
    url:"",
    token:"",
    modal:null,
    prompt:function()
    {
        var myLabels = {
            'Ok': 'Aceptar',
            'Cancel': 'Cancelar'
        };

        new_campaign.modal = UIkit.modal.prompt('Nombre de la campaña:', '', new_campaign.create, {'labels':myLabels});
    },
    create:function(name)
    {
        if (!name.trim()) {
            // is empty or whitespace

            $(".uk-modal-content").find("input").addClass("md-input-danger");
            new_campaign.modal.show();
        }
        else
        {
            UIkit.modal.blockUI('<div class=\'uk-text-center\'> Creando campaña... <br>' +
                '<img class=\'uk-margin-top\' src=\''+new_campaign.base_url+'/assets/img/spinners/spinner.gif\' alt=\'\'>');
            window.location=new_campaign.url+"?name="+name;
        }
    }
}
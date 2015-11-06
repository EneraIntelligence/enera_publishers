$(function() {
    "use strict";

    // page onload functions


});

new_campaign =
{
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
            window.location=new_campaign.url+"?name="+name;
        }
    }
}
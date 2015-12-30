$(function() {
    "use strict";

    // page onload functions

    $("#fab-open").click(function( event ) {
        if(typeof tour !== "undefined")
        {
            setTimeout(function()
            {
                $('#joyRideTipContent').joyride('nextTip');
            },500);
        }
    });

    $("#funds-btn").click(function( event ) {
        if(typeof tour !== "undefined")
        {
            $('#joyRideTipContent').joyride('nextTip');
        }
    });

    $("#note_add").click(function( event ) {
        event.stopPropagation();
        new_campaign.prompt();



        $("#fab-create").removeClass("md-fab-active");
        $("#fab-open").css("display","block");
        $(".md-fab-action-close").css("display","none");
    });

    //$("#fab-create").open();


});

new_campaign =
{
    base_url:"",
    url:"",
    token:"",
    user_budget:0.0,
    mailingId:null,
    mailingModal:null,
    modal:null,
    prompt:function()
    {

        var myLabels = {
            'Ok': 'Aceptar',
            'Cancel': 'Cancelar'
        };

        if(new_campaign.user_budget<100)
        {
            myLabels = {
                'Ok': 'Agregar fondos',
                'Cancel': 'Cancelar'
            };
            new_campaign.modal = UIkit.modal.confirm('<p style="text-align:center;"> <strong>¡Ups!</strong><br><br> No tienes fondos suficientes.</p>', new_campaign.goBudget,{'labels':myLabels});
        }
        else
        {
            new_campaign.modal = UIkit.modal.prompt('Nombre de la campaña:', '', new_campaign.create, {'labels':myLabels});
        }

    },
    goBudget:function()
    {
        window.location=new_campaign.base_url+"/budget";

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
    },
    promptMailingCampaign:function(mailingId)
    {
        new_campaign.mailingId=mailingId;
        var myLabels = {
            'Ok': 'Aceptar',
            'Cancel': 'Cancelar'
        };

        new_campaign.mailingModal = UIkit.modal.prompt('Nombre de la campaña:', '', new_campaign.createMailingCampaign, {'labels':myLabels});
    },
    createMailingCampaign:function(name)
    {
        if (!name.trim()) {
            // is empty or whitespace

            $(".uk-modal-content").find("input").addClass("md-input-danger");
            new_campaign.mailingModal.show();
        }
        else
        {
            UIkit.modal.blockUI('<div class=\'uk-text-center\'> Creando campaña... <br>' +
                '<img class=\'uk-margin-top\' src=\''+new_campaign.base_url+'/assets/img/spinners/spinner.gif\' alt=\'\'>');
            window.location=new_campaign.base_url+"/campaigns/mailing/"+new_campaign.mailingId+"?name="+name;
        }
    }
}
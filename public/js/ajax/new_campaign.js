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
        new_campaign.modal = UIkit.modal.prompt('Nombre de la campaña:', '', new_campaign.create);

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
            /*
            $.ajax({
                url: '/campaigns',
                type: 'POST',
                dataType: 'JSON',
                data: {name:name, _token:new_campaign.token},
            }).done(function (data) {
                console.log("success");
                console.log(data);
            }).fail(function (jqXHR, textStatus, errorThrown) {
                console.log(jqXHR);
                console.log(textStatus);
                console.log(errorThrown);
            });*/
        }
    }
}
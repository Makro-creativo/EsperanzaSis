$(function() {
    $("#printable").find('.print').on('click', function() {
        $("#printable").print({
              globalStyles : false,
              mediaPrint : false,
    
              iframe : false,
              noPrintSelector : ".avoid-this",
              append : "Tortillería<br/>",
              prepend : "<br/> EsperanzaSis",
              manuallyCopyFormValues: true,
              deferred: $.Deferred(),
              timeout: 250,
              title: null,
              doctype: '<!doctype html>'
            });
            
    });
});
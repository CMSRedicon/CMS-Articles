/**
 * Główny wątek, ekwiwalent document.ready
 */
; (function () {

    var helper = new Helpers.Main();
    helper.dump("CMS Redicon Articles 2018");

    //Custom trigger dla cmsr
    if ($('[data-cmsr-trigger]').length > 0) {

        $('[data-cmsr-trigger]').each(function ($key, $item) {

            if (typeof $(this).data(helper.CMSR_TRIGGER) != typeof undefined) {
                let action = $(this).data(helper.CMSR_TRIGGER);
                switch (action) {
                    case 'sendArticleVisibility':
                        $(this).click(function () {
                            helper.sendArticleVisibility($(this));
                        });
                        break;

                }

            }


        });

    }

})();

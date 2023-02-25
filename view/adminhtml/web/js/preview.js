define([
    'jquery',
    'Magento_Ui/js/modal/alert'
], function ($, alert) {

    var saveConfig = function (urlTemplate, processCallback) {
        if (configForm.validation('isValid')) {
            $.ajax({
                method: 'POST',
                url: configForm.attr('action'),
                data: configForm.serialize(),
                context: this
            }).done(function (response) {
                if (typeof response === 'object') {
                    if (response.error) {
                        alert({ title: 'Error', content: response.message });
                    } else if (response.ajaxExpired) {
                        window.location.href = response.ajaxRedirect;
                    }
                } else {
                    var url = null;
                    var $result = $(response);
                    var $accessCode = $result.find('#magepal_checkout_preview_success_page_access_code');
                    var $orderIncrement = $result.find('#magepal_checkout_preview_success_page_order_increment');

                    if ($accessCode.length && $accessCode.val()
                        && $orderIncrement.length && $orderIncrement.val()
                    ) {
                        url = urlTemplate.replace("--previewAccessCode--", $accessCode.val());
                    }

                    processCallback(url);
                }
            });

            return true;
        } else {
            return false;
        }
    };

    return function (config) {
        var $iframe = $('[data-role="iframe-preview-panel"] iframe');
        var $iframePreviewPanel = $('[data-role="iframe-preview-panel"]');
        var urlTemplate = config.urlTemplate;

        $('#inline-preview').on('click', function () {
            $iframe.hide();
            $iframePreviewPanel.css({"min-height": "500px"}).trigger('processStart');

            $iframe.on('load', function () {
                $iframePreviewPanel.trigger('processStop');
                $(this).show()
            });

            saveConfig(urlTemplate, function (url) {
                if (url) {
                    $iframe.attr('src', url);
                }

            });
        });

        $('#view-source').on('click', function () {
            $('body').trigger('processStart');
            $iframePreviewPanel.css({"min-height": "0px"});
            $iframe.hide();

            saveConfig(urlTemplate, function (url) {
                if (url) {
                    $.ajax({
                        method: 'GET',
                        url: url,
                        context: this
                    }).done(function (response) {

                        alert({
                            title: 'HTML Source',
                            content: '<textarea style="width: 100%; height: 500px; resize: none;">' + response + '</textarea>'
                        });

                        $('body').trigger('processStop');
                    });
                }
            });
        });

        $('#new-window').on('click', function () {
            $('body').trigger('processStart');
            $iframePreviewPanel.css({"min-height": "0px"});
            $iframe.hide();

            saveConfig(urlTemplate, function (url) {
                if (url) {
                    window.open(url);
                }

                $('body').trigger('processStop');
            });
        });
    };
});

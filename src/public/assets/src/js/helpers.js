/**
 * Główny helper dla wszystkich skryptów pomocniczych
 */
var Helpers;
(function (Helpers) {
    var Main = /** @class */ (function () {
        function Main() {
            this.CMSR_TRIGGER = "cmsr-trigger";
            /**
             * Wywołanie ajaxa
             * @param  {Function} callback
             * @returns void
             */
            this.ajaxStart = function (callback) {
                $.ajaxSetup({
                    'headers': {
                        'X-CSRF-TOKEN': window['_token']
                    }
                });
                callback();
            };
        }
        /**
         * Wysłanie ajaxem ustawienia artykułu
         * @param  {JQuery<HTMLElement>} $radio
         * @returns void
         */
        Main.prototype.sendArticleVisibility = function ($radio) {
            var self = this;
            this.ajaxStart(function () {
                $.ajax({
                    method: 'POST',
                    data: { 'article_id': $radio.data('article-id'), 'value': $radio.val() },
                    url: '/ajax/saveArticlesVisibility',
                    success: function (data) {
                        self.dump(data);
                        if (data.message != 'success') {
                            alert('Wystąpił błąd!');
                        }
                    }
                });
            });
        };
        /**
         * Funkcja testowa
         * @returns string
         */
        Main.prototype.printTest = function () {
            return "działa";
        };
        /**
         * Dump danych
         * @param data
         */
        Main.prototype.dump = function (data) {
            console.log(data);
        };
        /**
         * Dump i przerwanie wątku
         * @param data
         */
        Main.prototype.dd = function (data) {
            console.log(data);
            throw new Error('Aborting all scripts');
        };
        return Main;
    }());
    Helpers.Main = Main;
})(Helpers || (Helpers = {}));

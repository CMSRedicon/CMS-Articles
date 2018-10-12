/**
 * Główny helper dla wszystkich skryptów pomocniczych
 */

namespace Helpers {
    export class Main {

        public readonly CMSR_TRIGGER: string = "cmsr-trigger";

        /**
         * Wysłanie ajaxem ustawienia artykułu
         * @param  {JQuery<HTMLElement>} $radio
         * @returns void
         */
        public sendArticleVisibility($radio: JQuery<HTMLElement>): void {
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

        }

        /**
         * Wywołanie ajaxa
         * @param  {Function} callback
         * @returns void
         */
        public ajaxStart = (callback: Function): void => {
            $.ajaxSetup({
                'headers': {
                    'X-CSRF-TOKEN': window['_token']
                }
            });
            callback();
        }
        /**
         * Funkcja testowa
         * @returns string
         */
        public printTest(): string {
            return "działa";
        }

        /**
         * Dump danych 
         * @param data 
         */
        public dump(data: any): void {
            console.log(data);
        }

        /**
         * Dump i przerwanie wątku
         * @param data 
         */
        public dd(data: any): void {
            console.log(data);
            throw new Error('Aborting all scripts');
        }
    }
}

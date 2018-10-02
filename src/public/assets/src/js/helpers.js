/**
 * Główny helper dla wszystkich skryptów pomocniczych
 */
var Helpers;
(function (Helpers) {
    var Main = /** @class */ (function () {
        function Main() {
        }
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

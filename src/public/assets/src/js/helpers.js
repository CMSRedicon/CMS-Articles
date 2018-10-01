var Helpers;
(function (Helpers) {
    var Test = /** @class */ (function () {
        function Test() {
        }
        /**
         * @returns string
         */
        Test.prototype.printTest = function () {
            return "działa";
        };
        return Test;
    }());
    Helpers.Test = Test;
})(Helpers || (Helpers = {}));

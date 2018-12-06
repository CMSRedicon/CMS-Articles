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

var Slug;
(function (Slug) {
    var Main = /** @class */ (function () {
        function Main() {
        }
        Main.prototype.slug = function (value, sep) {
            var separator = sep || '-';
            value = this.ascii(value);
            var flip = separator == '-' ? '_' : '-';
            value = value.replace(new RegExp(this.pregQuote(flip), 'g'), separator);
            value = value.toLowerCase().replace(new RegExp('[^' + this.pregQuote(separator) + '\\d\\w\\s]', 'ug'), '');
            value = value.replace(new RegExp('[' + this.pregQuote(separator) + '\\s]+', 'ug'), separator);
            return value.trim();
        };
        Main.prototype.ascii = function (value) {
            var _this = this;
            _.forEach(this.charsArray(), function (val, key) {
                value = _this.replaceArray(value, val, key);
            });
            return value.replace(/[^\x20-\x7E]/u, '');
        };
        Main.prototype.pregQuote = function (str, delimiter) {
            return (str + '').replace(new RegExp('[.\\\\+*?\\[\\^\\]$(){}=!<>|:\\' + (delimiter || '') + '-]', 'g'), '\\$&');
        };
        Main.prototype.replaceArray = function (string, find, replace) {
            var replaceString = string;
            for (var i = 0; i < find.length; i++) {
                replaceString = replaceString.replace(new RegExp(find[i], 'g'), replace);
            }
            return replaceString;
        };
        ;
        Main.prototype.charsArray = function () {
            return {
                '0': ['°', '₀', '۰'],
                '1': ['¹', '₁', '۱'],
                '2': ['²', '₂', '۲'],
                '3': ['³', '₃', '۳'],
                '4': ['⁴', '₄', '۴', '٤'],
                '5': ['⁵', '₅', '۵', '٥'],
                '6': ['⁶', '₆', '۶', '٦'],
                '7': ['⁷', '₇', '۷'],
                '8': ['⁸', '₈', '۸'],
                '9': ['⁹', '₉', '۹'],
                'a': ['à', 'á', 'ả', 'ã', 'ạ', 'ă', 'ắ', 'ằ', 'ẳ', 'ẵ', 'ặ', 'â', 'ấ', 'ầ', 'ẩ', 'ẫ', 'ậ', 'ā', 'ą', 'å', 'α', 'ά', 'ἀ', 'ἁ', 'ἂ', 'ἃ', 'ἄ', 'ἅ', 'ἆ', 'ἇ', 'ᾀ', 'ᾁ', 'ᾂ', 'ᾃ', 'ᾄ', 'ᾅ', 'ᾆ', 'ᾇ', 'ὰ', 'ά', 'ᾰ', 'ᾱ', 'ᾲ', 'ᾳ', 'ᾴ', 'ᾶ', 'ᾷ', 'а', 'أ', 'အ', 'ာ', 'ါ', 'ǻ', 'ǎ', 'ª', 'ა', 'अ', 'ا'],
                'b': ['б', 'β', 'Ъ', 'Ь', 'ب', 'ဗ', 'ბ'],
                'c': ['ç', 'ć', 'č', 'ĉ', 'ċ'],
                'd': ['ď', 'ð', 'đ', 'ƌ', 'ȡ', 'ɖ', 'ɗ', 'ᵭ', 'ᶁ', 'ᶑ', 'д', 'δ', 'د', 'ض', 'ဍ', 'ဒ', 'დ'],
                'e': ['é', 'è', 'ẻ', 'ẽ', 'ẹ', 'ê', 'ế', 'ề', 'ể', 'ễ', 'ệ', 'ë', 'ē', 'ę', 'ě', 'ĕ', 'ė', 'ε', 'έ', 'ἐ', 'ἑ', 'ἒ', 'ἓ', 'ἔ', 'ἕ', 'ὲ', 'έ', 'е', 'ё', 'э', 'є', 'ə', 'ဧ', 'ေ', 'ဲ', 'ე', 'ए', 'إ', 'ئ'],
                'f': ['ф', 'φ', 'ف', 'ƒ', 'ფ'],
                'g': ['ĝ', 'ğ', 'ġ', 'ģ', 'г', 'ґ', 'γ', 'ဂ', 'გ', 'گ'],
                'h': ['ĥ', 'ħ', 'η', 'ή', 'ح', 'ه', 'ဟ', 'ှ', 'ჰ'],
                'i': ['í', 'ì', 'ỉ', 'ĩ', 'ị', 'î', 'ï', 'ī', 'ĭ', 'į', 'ı', 'ι', 'ί', 'ϊ', 'ΐ', 'ἰ', 'ἱ', 'ἲ', 'ἳ', 'ἴ', 'ἵ', 'ἶ', 'ἷ', 'ὶ', 'ί', 'ῐ', 'ῑ', 'ῒ', 'ΐ', 'ῖ', 'ῗ', 'і', 'ї', 'и', 'ဣ', 'ိ', 'ီ', 'ည်', 'ǐ', 'ი', 'इ'],
                'j': ['ĵ', 'ј', 'Ј', 'ჯ', 'ج'],
                'k': ['ķ', 'ĸ', 'к', 'κ', 'Ķ', 'ق', 'ك', 'က', 'კ', 'ქ', 'ک'],
                'l': ['ł', 'ľ', 'ĺ', 'ļ', 'ŀ', 'л', 'λ', 'ل', 'လ', 'ლ'],
                'm': ['м', 'μ', 'م', 'မ', 'მ'],
                'n': ['ñ', 'ń', 'ň', 'ņ', 'ŉ', 'ŋ', 'ν', 'н', 'ن', 'န', 'ნ'],
                'o': ['ó', 'ò', 'ỏ', 'õ', 'ọ', 'ô', 'ố', 'ồ', 'ổ', 'ỗ', 'ộ', 'ơ', 'ớ', 'ờ', 'ở', 'ỡ', 'ợ', 'ø', 'ō', 'ő', 'ŏ', 'ο', 'ὀ', 'ὁ', 'ὂ', 'ὃ', 'ὄ', 'ὅ', 'ὸ', 'ό', 'о', 'و', 'θ', 'ို', 'ǒ', 'ǿ', 'º', 'ო', 'ओ'],
                'p': ['п', 'π', 'ပ', 'პ', 'پ'],
                'q': ['ყ'],
                'r': ['ŕ', 'ř', 'ŗ', 'р', 'ρ', 'ر', 'რ'],
                's': ['ś', 'š', 'ş', 'с', 'σ', 'ș', 'ς', 'س', 'ص', 'စ', 'ſ', 'ს'],
                't': ['ť', 'ţ', 'т', 'τ', 'ț', 'ت', 'ط', 'ဋ', 'တ', 'ŧ', 'თ', 'ტ'],
                'u': ['ú', 'ù', 'ủ', 'ũ', 'ụ', 'ư', 'ứ', 'ừ', 'ử', 'ữ', 'ự', 'û', 'ū', 'ů', 'ű', 'ŭ', 'ų', 'µ', 'у', 'ဉ', 'ု', 'ူ', 'ǔ', 'ǖ', 'ǘ', 'ǚ', 'ǜ', 'უ', 'उ'],
                'v': ['в', 'ვ', 'ϐ'],
                'w': ['ŵ', 'ω', 'ώ', 'ဝ', 'ွ'],
                'x': ['χ', 'ξ'],
                'y': ['ý', 'ỳ', 'ỷ', 'ỹ', 'ỵ', 'ÿ', 'ŷ', 'й', 'ы', 'υ', 'ϋ', 'ύ', 'ΰ', 'ي', 'ယ'],
                'z': ['ź', 'ž', 'ż', 'з', 'ζ', 'ز', 'ဇ', 'ზ'],
                'aa': ['ع', 'आ', 'آ'],
                'ae': ['ä', 'æ', 'ǽ'],
                'ai': ['ऐ'],
                'at': ['@'],
                'ch': ['ч', 'ჩ', 'ჭ', 'چ'],
                'dj': ['ђ', 'đ'],
                'dz': ['џ', 'ძ'],
                'ei': ['ऍ'],
                'gh': ['غ', 'ღ'],
                'ii': ['ई'],
                'ij': ['ĳ'],
                'kh': ['х', 'خ', 'ხ'],
                'lj': ['љ'],
                'nj': ['њ'],
                'oe': ['ö', 'œ', 'ؤ'],
                'oi': ['ऑ'],
                'oii': ['ऒ'],
                'ps': ['ψ'],
                'sh': ['ш', 'შ', 'ش'],
                'shch': ['щ'],
                'ss': ['ß'],
                'sx': ['ŝ'],
                'th': ['þ', 'ϑ', 'ث', 'ذ', 'ظ'],
                'ts': ['ц', 'ც', 'წ'],
                'ue': ['ü'],
                'uu': ['ऊ'],
                'ya': ['я'],
                'yu': ['ю'],
                'zh': ['ж', 'ჟ', 'ژ'],
                '(c)': ['©'],
                'A': ['Á', 'À', 'Ả', 'Ã', 'Ạ', 'Ă', 'Ắ', 'Ằ', 'Ẳ', 'Ẵ', 'Ặ', 'Â', 'Ấ', 'Ầ', 'Ẩ', 'Ẫ', 'Ậ', 'Å', 'Ā', 'Ą', 'Α', 'Ά', 'Ἀ', 'Ἁ', 'Ἂ', 'Ἃ', 'Ἄ', 'Ἅ', 'Ἆ', 'Ἇ', 'ᾈ', 'ᾉ', 'ᾊ', 'ᾋ', 'ᾌ', 'ᾍ', 'ᾎ', 'ᾏ', 'Ᾰ', 'Ᾱ', 'Ὰ', 'Ά', 'ᾼ', 'А', 'Ǻ', 'Ǎ'],
                'B': ['Б', 'Β', 'ब'],
                'C': ['Ç', 'Ć', 'Č', 'Ĉ', 'Ċ'],
                'D': ['Ď', 'Ð', 'Đ', 'Ɖ', 'Ɗ', 'Ƌ', 'ᴅ', 'ᴆ', 'Д', 'Δ'],
                'E': ['É', 'È', 'Ẻ', 'Ẽ', 'Ẹ', 'Ê', 'Ế', 'Ề', 'Ể', 'Ễ', 'Ệ', 'Ë', 'Ē', 'Ę', 'Ě', 'Ĕ', 'Ė', 'Ε', 'Έ', 'Ἐ', 'Ἑ', 'Ἒ', 'Ἓ', 'Ἔ', 'Ἕ', 'Έ', 'Ὲ', 'Е', 'Ё', 'Э', 'Є', 'Ə'],
                'F': ['Ф', 'Φ'],
                'G': ['Ğ', 'Ġ', 'Ģ', 'Г', 'Ґ', 'Γ'],
                'H': ['Η', 'Ή', 'Ħ'],
                'I': ['Í', 'Ì', 'Ỉ', 'Ĩ', 'Ị', 'Î', 'Ï', 'Ī', 'Ĭ', 'Į', 'İ', 'Ι', 'Ί', 'Ϊ', 'Ἰ', 'Ἱ', 'Ἳ', 'Ἴ', 'Ἵ', 'Ἶ', 'Ἷ', 'Ῐ', 'Ῑ', 'Ὶ', 'Ί', 'И', 'І', 'Ї', 'Ǐ', 'ϒ'],
                'K': ['К', 'Κ'],
                'L': ['Ĺ', 'Ł', 'Л', 'Λ', 'Ļ', 'Ľ', 'Ŀ', 'ल'],
                'M': ['М', 'Μ'],
                'N': ['Ń', 'Ñ', 'Ň', 'Ņ', 'Ŋ', 'Н', 'Ν'],
                'O': ['Ó', 'Ò', 'Ỏ', 'Õ', 'Ọ', 'Ô', 'Ố', 'Ồ', 'Ổ', 'Ỗ', 'Ộ', 'Ơ', 'Ớ', 'Ờ', 'Ở', 'Ỡ', 'Ợ', 'Ø', 'Ō', 'Ő', 'Ŏ', 'Ο', 'Ό', 'Ὀ', 'Ὁ', 'Ὂ', 'Ὃ', 'Ὄ', 'Ὅ', 'Ὸ', 'Ό', 'О', 'Θ', 'Ө', 'Ǒ', 'Ǿ'],
                'P': ['П', 'Π'],
                'R': ['Ř', 'Ŕ', 'Р', 'Ρ', 'Ŗ'],
                'S': ['Ş', 'Ŝ', 'Ș', 'Š', 'Ś', 'С', 'Σ'],
                'T': ['Ť', 'Ţ', 'Ŧ', 'Ț', 'Т', 'Τ'],
                'U': ['Ú', 'Ù', 'Ủ', 'Ũ', 'Ụ', 'Ư', 'Ứ', 'Ừ', 'Ử', 'Ữ', 'Ự', 'Û', 'Ū', 'Ů', 'Ű', 'Ŭ', 'Ų', 'У', 'Ǔ', 'Ǖ', 'Ǘ', 'Ǚ', 'Ǜ'],
                'V': ['В'],
                'W': ['Ω', 'Ώ', 'Ŵ'],
                'X': ['Χ', 'Ξ'],
                'Y': ['Ý', 'Ỳ', 'Ỷ', 'Ỹ', 'Ỵ', 'Ÿ', 'Ῠ', 'Ῡ', 'Ὺ', 'Ύ', 'Ы', 'Й', 'Υ', 'Ϋ', 'Ŷ'],
                'Z': ['Ź', 'Ž', 'Ż', 'З', 'Ζ'],
                'AE': ['Ä', 'Æ', 'Ǽ'],
                'CH': ['Ч'],
                'DJ': ['Ђ'],
                'DZ': ['Џ'],
                'GX': ['Ĝ'],
                'HX': ['Ĥ'],
                'IJ': ['Ĳ'],
                'JX': ['Ĵ'],
                'KH': ['Х'],
                'LJ': ['Љ'],
                'NJ': ['Њ'],
                'OE': ['Ö', 'Œ'],
                'PS': ['Ψ'],
                'SH': ['Ш'],
                'SHCH': ['Щ'],
                'SS': ['ẞ'],
                'TH': ['Þ'],
                'TS': ['Ц'],
                'UE': ['Ü'],
                'YA': ['Я'],
                'YU': ['Ю'],
                'ZH': ['Ж'],
                ' ': ["\xC2\xA0", "\xE2\x80\x80", "\xE2\x80\x81", "\xE2\x80\x82", "\xE2\x80\x83", "\xE2\x80\x84", "\xE2\x80\x85", "\xE2\x80\x86", "\xE2\x80\x87", "\xE2\x80\x88", "\xE2\x80\x89", "\xE2\x80\x8A", "\xE2\x80\xAF", "\xE2\x81\x9F", "\xE3\x80\x80"],
            };
        };
        return Main;
    }());
    Slug.Main = Main;
})(Slug || (Slug = {}));

/**
 * Główny wątek, ekwiwalent document.ready
 */
;
(function () {
    var helper = new Helpers.Main();
    var slug = new Slug.Main();
    helper.dump("CMS Redicon Articles 2018");
    //Custom trigger dla cmsr
    if ($('[data-cmsr-trigger]').length > 0) {
        $('[data-cmsr-trigger]').each(function ($key, $item) {
            if (typeof $(this).data(helper.CMSR_TRIGGER) != typeof undefined) {
                var action = $(this).data(helper.CMSR_TRIGGER);
                //główny switch dla wszystkich trigerów
                switch (action) {
                    case 'sendArticleVisibility':
                        $(this).click(function () {
                            helper.sendArticleVisibility($(this));
                        });
                        break;
                    case 'clickArticleLangCreate':
                        $(this).click(function (e) {
                            e.preventDefault();
                            if (confirm("Czy napewno chcesz opuścić stronę ? Nie zapisane dane zostaną utracone")) {
                                window.location.href = $(this).attr('href');
                            }
                        });
                        break;
                    case 'addBeforUnload':
                        window.onbeforeunload = function () {
                            return "Nie zapisane dane zostaną utracone. Napewno chcesz opuścić stronę ?";
                        };
                        break;
                    case 'updateSlugArticle':
                        $(this).keyup(function () {
                            if ($('#articles_description_slug').length > 0) {
                                var articleSeoSlug = $('#articles_description_slug');
                                if (typeof $(this).val() != undefined && $(this).val() != null && $(this).val() != "") {
                                    var choosedLang = articleSeoSlug.data('choosed-lang');
                                    var slugText = slug.slug($(this).val(), '-');
                                    articleSeoSlug.val('/' + choosedLang + '/' + slugText);
                                }
                                else {
                                    articleSeoSlug.val('');
                                }
                            }
                        });
                        break;
                }
            }
        });
    }
})();

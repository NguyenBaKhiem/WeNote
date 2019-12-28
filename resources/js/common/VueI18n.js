import BaseVueI18n from 'vue-i18n';
import Const from 'common/Const';

export default class VueI18n extends BaseVueI18n {

    constructor(config) {
        super(config);

        // Override method
        this._exist = function (message, key) {
            if (!message || !key) { return false; }
            return !isNull(message[key]);
        };
    }

    /*
    * Override method
    */
    _t(key, _locale, messages, host) {
        var ref, text;

        var values = [], len = arguments.length - 4;
        while ( len-- > 0 ) values[ len ] = arguments[ len + 4 ];
        if (!key) { return '' }

        var parsedArgs = parseArgs.apply(void 0, values);

        // Custom translate vee-validate message
        if (parsedArgs.params) {
            var data = convertFormatVeeValidateI18n.apply(void 0, [key, parsedArgs.params]);
            if (data) {
                key = data.key;
                parsedArgs.params = data.params;
            }
        }

        var locale = parsedArgs.locale || _locale;

        var ret = i18n._translate(
            messages, locale, i18n.fallbackLocale, key,
            host, 'string', parsedArgs.params
        );
        if (i18n._isFallbackRoot(ret)) {
            if (!i18n._silentTranslationWarn) {
                warn(("Fall back to translate the keypath '" + key + "' with root locale."));
            }
            /* istanbul ignore if */
            if (!i18n._root) { throw Error('unexpected error') }
            text = (ref = i18n._root).t.apply(ref, [ key ].concat( values ))
        } else {
            text = i18n._warnDefault(locale, key, ret, host, values)
        }
        return this.makeReplacement(text);
    }

    makeReplacement(text) {
        const KEYS_GLOBAL = Const.KEYS_GLOBAL
        for (const key in KEYS_GLOBAL) {
            const arg = this.getArgument(key);
            if (text.includes(arg)) {
                text = text.replace(arg, KEYS_GLOBAL[key]);
            }
        }
        return text;
    }

    getArgument(key) {
        return `{${key}}`;
    }
}

function parseArgs () {
    var args = [], len = arguments.length;
    while ( len-- ) args[ len ] = arguments[ len ];

    var locale = null;
    var params = null;
    if (args.length === 1) {
        if (isObject(args[0]) || Array.isArray(args[0])) {
          params = args[0];
        } else if (typeof args[0] === 'string') {
          locale = args[0];
        }
    } else if (args.length === 2) {
        if (typeof args[0] === 'string') {
          locale = args[0];
        }
        /* istanbul ignore if */
        if (isObject(args[1]) || Array.isArray(args[1])) {
          params = JSON.parse(JSON.stringify(args[1]));
        }
    }
    return { locale: locale, params: params }
}

function isObject (obj) {
    return obj !== null && typeof obj === 'object'
}

function isNull (val) {
    return val === null || val === undefined
}

/* Format paramters:
    + I18n          : ["one", "two", "three"]
    + VeeValidate   : ["attribute", ["one", "two", "three"], {}]
*/
function convertFormatVeeValidateI18n(key, rawParams) {
    if (!isParamsVeeValidate(rawParams)) {
        return null;
    }
    const attribute = rawParams[0];
    const params = rawParams[1];

    // Rules are has multiple message;
    const rulesMultipleMessage = ['after', 'before', 'decimal', 'length', 'size'];
    const isChangedKey = rulesMultipleMessage.filter(item => key.includes(`.${item}`)).length;

    const ruleSize = 'size'; // Calculate size of file.
    if (key.includes(`.${ruleSize}`)) {
        var size = calculateSizeFile(params[0]);
        params[0] = size;
    }

    return {
        key     : params[1] && isChangedKey ? `${key}2` : key,
        params  : [attribute].concat(params)
    };
}

function isParamsVeeValidate(params) {
    if (!params || !Array.isArray(params)) {
        return false;
    }
    const result = params.filter(item => {
        return isObject(item);
    })
    return params.length > 2 && result.length;
}

function calculateSizeFile(size) {
    if (!size) {
        size == 2048;
    }
    var n = Math.floor(Math.log(size) / Math.log(1024));
    return 1 * (size / Math.pow(1024, n)).toFixed(2) + " " + ["Byte", "KB", "MB", "GB", "TB", "PB", "EB", "ZB", "YB"][n];
}

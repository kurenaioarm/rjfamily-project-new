window.longdo = window.longdo || {};

/**
 * An address form
 * @constructor
 * @param {string} div_id ID of form container
 * @param {JSON} options Options for form customization -- Optional --
 * <p>List of JSON attributes</p>
 * <ul>
 *   <li>language: {string} Display language (default: 'th')
 *     <ul>
 *       <li>'th': Thai</li>
 *       <li>'en': English</li>
 *     </ul>
 *   </li>
 *   <li>layout: {int} Layout format (default: AddressForm.SIMPLE_SELECT)
 *     <ul>
 *       <li>AddressForm.SIMPLE_SELECT = 1</li>
 *       <li>AddressForm.SIMPLE_SELECT_FULLFORM = 2</li>
 *       <li>AddressForm.SIMPLE_SUGGEST = 3</li>
 *       <li>AddressForm.SIMPLE_SUGGEST_FULLFORM = 4</li>
 *       <li>AddressForm.STANDARD = 5</li>
 *     </ul>
 *   </li>
 *   <li>style: {string} Name of css file including .css extension</li>
 *   <li>showLabels: {bool} Show form labels (default: true)</li>
 *   <li>required: {JSON}
 *     <ul>
 *       <li>key: {string} ID of an input field</li>
 *       <li>value: {bool} required if true, not required if false</li>
 *     </ul>
 *   </li>
 *   <li>label: {JSON}
 *     <ul>
 *       <li>key: {string} ID of an input field</li>
 *       <li>value: {string} Label display text</li>
 *     </ul>
 *   </li>
 *   <li>placeholder: {JSON}
 *     <ul>
 *       <li>key: {string} ID of an input field</li>
 *       <li>value: {string} Placeholder display text</li>
 *     </ul>
 *   </li>
 *   <li>bigLabelFont: {string} Font family for big labels</li>
 *   <li>smallLabelFont: {string} Font family for small labels</li>
 *   <li>errorLabelFont: {string} Font family for error labels</li>
 *   <li>map: {string} ID of map container</li>
 *   <li>debugDiv: {string} ID of a div to show form data</li>
 * </ul>
 */
longdo.AddressForm = function (div_id, options) {

    var self = this;
    var options = options || {};
    var mode = options['layout'] || longdo.AddressForm.SIMPLE_SELECT;
    var map_id = options['map'] || null;
    var directory = getScriptPath() + "/../";
    var marker = {};
    var map = {};
    var lang = {};
    var provinces = [];
    var language, keys, required, debugDiv, valid, formData;
    var changeTimer = false;
    var init = true;
    var dropdownTrigger;

    //temporary variable for searching
    var suggest_geocode, temp_searchtext, temp_searchtype, temp_postal_code;
    suggest_geocode = {};
    temp_searchtext = {};
    temp_searchtype = {};
    temp_postal_code = [];
    temp_poi_result = [];
    temp_geocode = null;

    switch (mode) {
        case longdo.AddressForm.SIMPLE_SELECT:
            template = "form_simple_select.php";
            break;
        case longdo.AddressForm.SIMPLE_SELECT_FULLFORM:
            template = "form_simple_select_fullform.php";
            break;
        case longdo.AddressForm.SIMPLE_SUGGEST:
            template = "form_simple_suggest.php";
            break;
        case longdo.AddressForm.SIMPLE_SUGGEST_FULLFORM:
            template = "form_simple_suggest_fullform.php";
            break;
        case longdo.AddressForm.STANDARD:
            template = "form.php";
            break;
        default:
            mode = longdo.AddressForm.SIMPLE_SELECT;
            template = "form_simple_select.php";
    }

    //initialze custom dropdown and events
    document.head.innerHTML += ('<link rel="stylesheet" href="' + directory + 'css/default.css" type="text/css" />');
    if (options['style']) document.head.innerHTML += ('<link rel="stylesheet" href="' + options['style'] + '" type="text/css" />');

    prepareDropDown();

    var request = new XMLHttpRequest();
    request.open('POST', directory + template, true);
    request.onload = function () {
        if (this.status >= 200 && this.status < 400) {
            // Success!
            var result = this.response;
            document.getElementById(div_id).innerHTML = result;
            hideBySelector('#' + div_id);

            // add keyboard support
            document.querySelectorAll("#addressform input").forEach(item => {
                item.addEventListener("keydown", (event) => {
                    switch (event.which) {
                        case 13:   //enter
                            document.querySelector('.jq-dropdown a.hovered').click();
                            break;
                        case 38:   //up
                            if (document.querySelectorAll('.jq-dropdown a.hovered').length > 0) {
                                var index = -1;
                                document.querySelectorAll('.jq-dropdown a').forEach((a, i) => {
                                    if (a.classList.contains('hovered')) index = i;
                                });
                                if (index > 0) {
                                    document.querySelectorAll('.jq-dropdown a')[index].classList.remove('hovered');
                                    document.querySelectorAll('.jq-dropdown a')[index - 1].classList.add('hovered');
                                }
                            }
                            else {
                                document.querySelectorAll('.jq-dropdown a')[0].classList.add('hovered');
                            }
                            break;
                        case 40:   //down
                            if (document.querySelectorAll('.jq-dropdown a.hovered').length > 0) {
                                var index = -1;
                                document.querySelectorAll('.jq-dropdown a').forEach((a, i) => {
                                    if (a.classList.contains('hovered')) index = i;
                                });
                                if (index < document.querySelectorAll('.jq-dropdown a').length - 1 && index > -1) {
                                    document.querySelectorAll('.jq-dropdown a')[index].classList.remove('hovered');
                                    document.querySelectorAll('.jq-dropdown a')[index + 1].classList.add('hovered');
                                }
                            }
                            else {
                                document.querySelectorAll('.jq-dropdown a')[0].classList.add('hovered');
                            }
                            break;
                    }
                });
            });

            //add mouse support
            document.addEventListener('mouseover', function (e) {
                for (var target = e.target; target && target != this; target = target.parentNode) {
                    if (target.matches('.jq-dropdown .jq-dropdown-menu li > a')) {
                        removeClassBySelector('.jq-dropdown a.hovered', 'hovered');
                        target.classList.add('hovered');
                        break;
                    }
                }
            });
            document.addEventListener('mouseleave', function (e) {
                for (var target = e.target; target && target != this; target = target.parentNode) {
                    if (target.matches('.jq-dropdown .jq-dropdown-menu li > a')) {
                        target.classList.remove('hovered');
                        break;
                    }
                }
            });

            // input events
            document.addEventListener('click', function (e) {
                for (var target = e.target; target && target != this; target = target.parentNode) {
                    if (target.matches('#addressform input, #addressform textarea')) {
                        initsuggest(target.getAttribute('id'));
                        break;
                    } else if (target.matches('#addressform a.choice')) {
                        onSuggestClick(target);
                        break;
                    } else if (target.matches('#addressform a.choice-auto')) {
                        autofill(target.getAttribute('type'), target.getAttribute('data'));
                        break;
                    }
                }
            });
            document.addEventListener('input', function (e) {
                for (var target = e.target; target && target != this; target = target.parentNode) {
                    if (target.matches('#addressform input, #addressform textarea')) {
                        if (changeTimer !== false) clearTimeout(changeTimer);
                        changeTimer = setTimeout(function () {
                            suggest(target.getAttribute('id'));
                            changeTimer = false;
                        }, 200);
                        break;
                    }
                }
            });

            document.querySelectorAll("#addressform input, #addressform textarea").forEach(item => {
                item.addEventListener("blur", (e) => {
                    validate(e.target.getAttribute('name'));
                });
            });
            document.querySelectorAll("#addressform select").forEach(item => {
                item.addEventListener("change", (e) => {
                    validate(e.target.getAttribute('name'));
                    onSelectChange(e.target.getAttribute('name'));
                });
            });

            initCountry();

            if (options['language'] && options['language'].toLowerCase() == 'en') language = 'en';
            else language = 'th';

            self.setLanguage(language);
        }
    };
    request.send();

    keys = {
        "address1": ["address1", "house_number", "building", "floor", "parent", "soi", "moo", "street", "route"],
        "address2": ["address2", "subdistrict", "district", "province", "postal_code", "etc", "geocode"]
    };

    required = {
        "postal_code": true,
        "poi": false,
        "address1": false,
        "address2": false,
        "house_number": false,
        "building": false,
        "floor": false,
        "parent": false,
        "soi": false,
        "moo": false,
        "street": false,
        "route": false,
        "subdistrict": true,
        "district": true,
        "province": true,
        "country": true,
        "etc": true,
        "geocode": false
    };

    // init map
    if (map_id) {
        map = new longdo.Map({
            placeholder: document.getElementById(map_id),
            ui: longdo.UiComponent.Mobile
        });
        map.zoom(15);
        // map.Ui.Zoombar.visible(false);
        map.Ui.Geolocation.visible(false);
        map.Ui.Fullscreen.visible(false);

        initMarker(13.722642, 100.529316);
    }
    else map = new longdo.Map();

    debugDiv = '';
    valid = false;
    formData = {};

    map.Search.language('th');

    //bind suggest
    map.Event.bind('suggest', handlesuggest);

    //bind address
    // map.Event.bind('address', getAddressFromPostalCode);

    map.Event.bind('overlayDrop', function (overlay) {
        if (overlay == marker) {
            map.Event.bind('address', getAddressFromLatLon);
            map.Search.address(marker.location());
        }
    });

    /**
      * Set language of the form using javascript
      * @param {string} lang Language code ('th','en')
      */
    this.setLanguage = function (lan) {
        var self = this;
        language = lan = lan.toLowerCase();
        map.Search.language(lan);

        var request = new XMLHttpRequest();
        request.open('GET', directory + 'languages.php', true);
        request.onload = function () {
            if (this.status >= 200 && this.status < 400) {
                var xmlf = this.response;
                if (window.DOMParser) {
                    parser = new DOMParser();
                    xml = parser.parseFromString(xmlf, "text/xml");
                } else {
                    xml = new ActiveXObject("Microsoft.XMLDOM");
                    xml.async = false;
                    xml.loadXML(xmlf);
                }

                xmlJs = xml.getElementsByTagName('js');
                for (var i = 0; i < xmlJs.length; i++) {
                    var item = xmlJs[i];
                    var id = item.getAttribute('id');
                    var text = item.getElementsByTagName(lan)[0].textContent
                    if (id == 'provinces') {
                        text = text.replace(/"/g, '');
                        lang[id] = text.split(',');
                    }
                    else lang[id] = text;
                }

                xmlTranslation = xml.getElementsByTagName('translation');
                for (var i = 0; i < xmlTranslation.length; i++) {
                    var item = xmlTranslation[i];
                    var id = item.getAttribute('id');
                    var text = item.getElementsByTagName(lan)[0].textContent;
                    if (id !== "country" && document.getElementById(id) && document.getElementById(id).tagName === "SELECT") {
                        document.getElementById(id).innerHTML = '<option selected disabled>' + text + '</option>';
                    }
                    if (document.getElementById(id + '_label') && getComputedStyle(document.getElementById(id + '_label'))['display'] === "none") self.setPlaceholder(id, text);
                    self.setLabelText(id, text);
                }

                xmlPlaceholder = xml.getElementsByTagName('placeholder');
                for (var i = 0; i < xmlPlaceholder.length; i++) {
                    var item = xmlPlaceholder[i];
                    var id = item.getAttribute('id');
                    var text = item.getElementsByTagName(lan)[0].textContent;
                    if (document.getElementById(id + '_label') && getComputedStyle(document.getElementById(id + '_label'))['display'] !== "none") self.setPlaceholder(id, text);
                }

                // change "optional" text language
                if (lan == "en") addClassBySelector('#addressform .small-label', 'en');
                else removeClassBySelector('#addressform .small-label', 'en');

                initProvince();

                if (init) {
                    init = false;
                    // customizeForm from options
                    if (options['debugDiv']) self.setDebugDiv(options['debugDiv']);
                    if (options['bigLabelFont']) self.setBigLabelFontFamily(options['bigLabelFont']);
                    if (options['smallLabelFont']) self.setSmallLabelFontFamily(options['smallLabelFont']);
                    if (options['errorLabelFont']) self.setErrorLabelFontFamily(options['errorLabelFont']);

                    if (options['showLabels'] == false) self.hideLabels();
                    if (options['label']) {
                        for (var key in options['label']) {
                            var val = options['label'][key];
                            self.setLabelText(key, val);
                        }
                    }
                    if (options['placeholder']) {
                        for (var key in options['placeholder']) {
                            var val = options['placeholder'][key];
                            self.setPlaceholder(key, val);
                        }
                    }
                    if (options['required']) {
                        for (var key in options['required']) {
                            var val = options['required'][key];
                            self.setRequired(key, val);
                        }
                    }
                    // show form
                    showBySelector('#' + div_id);
                }
            }
        };
        request.send();
    }

    /**
      * Set style of the form using CSS
      * @param {string} filename CSS file name (including .css)
      */
    this.setStyle = function (filename) {
        document.head.innerHTML += ('<link rel="stylesheet" href="' + filename + '" type="text/css" />');
    }

    /**
      * Get form data in JSON format and show it in debug div if the div is set
      * @returns {JSON} Form's JSON data
      */
    this.getFormJSON = function () {
        return getFormData();
    }

    /**
      * Set label text for an input field
      * @param {string} type ID of the input field
      * @param {string} text Label display text
      */
    this.setLabelText = function (type, text) {
        if (document.getElementById(type + '_label')) document.getElementById(type + '_label').innerHTML = text;
    }

    /**
      * Set placeholder text for an input field
      * @param {string} type ID of the input field
      * @param {string} text Placeholder display text
      */
    this.setPlaceholder = function (type, text) {
        if (text != "" && !document.getElementById(type + '_label').classList.contains('required') && getComputedStyle(document.getElementById(type + '_label'))['display'] === "none") text += lang.not_required;
        if (!document.getElementById(type)) return;
        if (type !== "country" && document.getElementById(type).tagName === "SELECT") {
            document.querySelectorAll('#' + type + ' option')[0].innerHTML = text;
        }
        else document.getElementById(type).setAttribute("placeholder", text);
    }

    /**
      * Hide form labels and move those labels to placeholders instead
      */
    this.hideLabels = function () {
        var self = this;
        var labels = document.querySelectorAll('.small-label, .big-label');
        for (var i = 0; i < labels.length; i++) {
            var element = labels[i];
            element.style.display = 'none';
            var label_id = element.getAttribute('id');
            var id = label_id.substring(0, label_id.length - 6);
            self.setPlaceholder(id, element.innerHTML);
        }
    }

    /**
      * Show form labels
      */
    this.showLabels = function () {
        var self = this;
        var labels = document.querySelectorAll('.small-label, .big-label');
        for (var i = 0; i < labels.length; i++) {
            var element = labels[i];
            element.style.display = 'block';
            var label_id = element.getAttribute('id');
            var id = label_id.substring(0, label_id.length - 6);
            self.setPlaceholder(id, '');
        }
    }

    /**
      * Set an input field as required
      * @param {string} type Name of the input field
      * @param {bool} bool "required" value
      */
    this.setRequired = function (type, bool) {
        var self = this;
        var label = document.getElementById(type + '_label');
        if (!label) return;
        required[type] = bool;
        if (bool) label.classList.add('required');
        else {
            label.classList.remove('required');
            hideerror(type);
        }
        if (getComputedStyle(label)['display'] === "none") self.setPlaceholder(type, label.innerHTML);
    }

    /**
      * Set div for showing form data
      * @param {string} div_id ID of a div to show form data
      */
    this.setDebugDiv = function (div_id) {
        debugDiv = div_id;
    }

    /**
      * Unbind and stop debug div from showing form data
      */
    this.unbindDebugDiv = function () {
        if (debugDiv === '') return;
        else {
            document.getElementById(debugDiv).innerHTML = '';
            debugDiv = '';
        }
    }

    /**
      * Set font family for big labels
      * @param {string} family Selected font family (Ex. "Times New Roman")
      */
    this.setBigLabelFontFamily = function (family) {
        document.querySelectorAll('.big-label').forEach(item => { item.style.fontFamily = family })
    }

    /**
      * Set font family for small labels
      * @param {string} family Selected font family (Ex. "Times New Roman")
      */
    this.setSmallLabelFontFamily = function (family) {
        document.querySelectorAll('.small-label').forEach(item => { item.style.fontFamily = family })
    }

    /**
      * Set font family for error labels
      * @param {string} family Selected font family (Ex. "Times New Roman")
      */
    this.setErrorLabelFontFamily = function (family) {
        document.querySelectorAll('.error').forEach(item => { item.style.fontFamily = family })
    }

    /**
      * Reset form values
      */
    this.resetForm = function () {
        var resetType = ['province', 'district', 'subdistrict'];
        for (var i = 0; i < resetType.length; i++) {
            if (document.getElementById(resetType[i]).tagName === "SELECT") {
                if (resetType[i] !== 'province') document.querySelectorAll('#' + resetType[i] + ' option:enabled').forEach(item => item.parentNode.removeChild(item))
                document.getElementById(resetType[i]).classList.add('notselected');
            }
        }
        document.getElementById("addressform").reset();
    }

    function getScriptPath() {
        var scripts = document.getElementsByTagName('SCRIPT');
        var path = '';
        if (scripts && scripts.length > 0) {
            for (var i in scripts) {
                if (scripts[i].src && scripts[i].src.match(/\/addressform\.js$/)) {
                    path = scripts[i].src.replace(/(.*)\/addressform\.js$/, '$1');
                    break;
                }
            }
        }
        return path;
    }

    function initCountry() {
        jsonp(directory + "js/country_dial_codes.json", function (data) {
            var countryOptions = "";
            for (var i in data) {
                var val = data[i];
                countryOptions += '<option value="' + val.code + '">' + val.name + '</option>';
            }
            document.getElementById('country').innerHTML = countryOptions;
        });
    }

    function jsonp(url, callback) {
        var callbackName = 'jsonCallback';
        window[callbackName] = function (data) {
            delete window[callbackName];
            document.body.removeChild(script);
            callback(data);
        };

        var script = document.createElement('script');
        script.src = url + (url.indexOf('?') >= 0 ? '&' : '?') + 'callback=' + callbackName;
        document.body.appendChild(script);
    }

    function initProvince() {
        map.Event.bind('search', initProvinceCallback);
        map.Search.search(null, {
            tag: 'province',
            // dataset: 'data2a',
            limit: 100
        });
    }

    function initProvinceCallback(result) {
        map.Event.unbind('search', initProvinceCallback);
        provinces = result.data.map((province) => {
            // if(province.name.charAt(1) === '.') province.name = province.name.substring(2);
            return { name: province.name, geocode: province.id.substring(3, 5) }
        });
        initProvinceOptions();
    }

    function initProvinceOptions() {
        if (isModeSelect()) {
            document.getElementById('province').innerHTML = '<option selected disabled>' + document.getElementById('province_label').innerHTML + (document.getElementById('province_label').classList.contains('required') ? '' : lang.not_required) + '</option>';
            for (var i in provinces) {
                var val = provinces[i];
                document.getElementById('province').innerHTML += ('<option geocode="' + val.geocode + '" val="' + val.name + '">' + val.name + '</option>');
            }
        }
    }

    function getAddressFromPostalCode(result) {
        map.Event.unbind('address', getAddressFromPostalCode);
        if (result === null) {
            showerror('postal_code', lang.postal_code_invalid);
        }
        else {
            hideerror('postal_code');
            if (isModeSelect()) {
                initSelectFromAddress(result.address);
                if (temp_geocode) { // temp_geocode exists when map pin is moved
                    document.querySelectorAll('#province option[geocode="' + temp_geocode.substr(0, 2) + '"]')[0].selected = true;
                    document.querySelectorAll('#district option[geocode="' + temp_geocode.substr(0, 4) + '"]')[0].selected = true;
                    document.querySelectorAll('#subdistrict option[geocode="' + temp_geocode + '"]')[0].selected = true;
                    temp_geocode = null;
                } else {
                    initPostalDropdown(result.address);
                }
            } else {
                initPostalDropdown(result.address);
            }
        }
    }

    function getAddressFromLatLon(result) {
        map.Event.unbind('address', getAddressFromLatLon);
        if (result === null) return;
        else {
            var str;
            if (language == 'th') str = result.subdistrict + " " + result.district + " " + result.province;
            else str = result.subdistrict + ", " + result.district + ", " + result.province;
            autofill('postal_code', result.postcode);
            if (isModeSelect()) {
                temp_geocode = result.geocode;
                map.Event.bind('address', getAddressFromPostalCode);
                map.Search.address(result.postcode + '');
            } else {
                autofill('subdistrict', str);
            }
        }
    }

    function getGeocodeFromLatLon(result) {
        if (result === null) {
            geocode = '';
        }
        else {
            geocode = result.geocode;

            // also fill subdistrict, district, province
            if (isModeSelect()) {
                initSelectFromAddress([result]);
                document.querySelectorAll('#province option[geocode="' + geocode.substr(0, 2) + '"]')[0].selected = true;
                document.querySelectorAll('#district option[geocode="' + geocode.substr(0, 4) + '"]')[0].selected = true;
                document.querySelectorAll('#subdistrict option[geocode="' + geocode + '"]')[0].selected = true;
            } else {
                var part = ["subdistrict", "district", "province"];

                for (var i = part.length - 1; i >= 0; i--) {
                    var e = document.getElementById(part[i]);
                    if (result[part[i]] && e && e.value === '') {
                        var tempStr = result[part[i]];
                        switch (part[i]) {
                            case 'province':
                                if (tempStr.charAt(1) === '.') tempStr = tempStr.substring(2);
                                break;
                            case 'district':
                                if (tempStr.substring(0, 3) === 'à¹€à¸‚à¸•') tempStr = tempStr.substring(3);
                                else if (tempStr.charAt(1) === '.') tempStr = tempStr.substring(2);
                                break;
                            case 'subdistrict':
                                if (tempStr.substring(0, 3) === 'à¹à¸‚à¸§à¸‡') tempStr = tempStr.substring(3);
                                else if (tempStr.charAt(1) === '.') tempStr = tempStr.substring(2);
                                break;
                        }
                        e.value = tempStr;
                        hideerror(part[i]);
                    }
                }
            }

            // fill postcode
            if (result.postcode && document.getElementById('postal_code')) {
                document.getElementById('postal_code').value = result.postcode;
            }

            // fill etc.
            // if(document.getElementById('etc')){
            //   var etc_ar = [];
            //   if(result.aoi) etc_ar.push(result.aoi);
            //   if(result.road) etc_ar.push(result.road);
            //   if(etc_ar.length){
            //     document.getElementById('etc').value = etc_ar.join(' ');
            //     hideerror('etc');
            //   } else {
            //     document.getElementById('etc').value = '';
            //   }
            // }

        }
        if (document.getElementById('geocode')) document.getElementById('geocode').value = geocode;
        map.Event.unbind('address', getGeocodeFromLatLon);
    }

    function initSelectFromAddress(items) {
        var province_ar = {};
        var district_ar = {};
        var subdistrict_ar = {};

        for (var i in items) {
            var val = items[i];
            province_ar[val.geocode.substr(0, 2)] = val;
            district_ar[val.geocode.substr(0, 4)] = val;
            subdistrict_ar[val.geocode] = val;
        }

        // "SELECT"
        document.getElementById('district').innerHTML = '<option selected disabled>' + document.getElementById('district_label').innerHTML + (document.getElementById('district_label').classList.contains('required') ? '' : lang.not_required) + '</option>';
        document.getElementById('subdistrict').innerHTML = '<option selected disabled>' + document.getElementById('subdistrict_label').innerHTML + (document.getElementById('subdistrict_label').classList.contains('required') ? '' : lang.not_required) + '</option>';
        addClassBySelector('#province, #district, #subdistrict', 'notselected');

        var selected_str;

        // insert select options
        // province options
        selected_str = (numKeys(province_ar) > 0) ? "selected" : "";
        if (selected_str) document.getElementById('province').classList.remove('notselected');
        for (var geocode in province_ar) {
            var val = province_ar[geocode];
            if (selected_str) {
                document.getElementById('province').value = val.province;
            }
            selected_str = "";
        }

        // district options
        selected_str = (numKeys(district_ar) > 0) ? "selected" : "";
        if (selected_str) document.getElementById('district').classList.remove('notselected');
        for (var geocode in district_ar) {
            var val = district_ar[geocode];
            document.getElementById('district').innerHTML += ('<option geocode="' + geocode + '" ' + selected_str + '>' + val.district + '</option>');
            selected_str = "";
        }
        for (var geocode in province_ar) {
            var val = province_ar[geocode];
            map.Event.bind('search', appendSelectOption);
            map.Search.search("", {
                tag: "district",
                dataset: 'data2a',
                area: geocode,
                limit: 100
            });
        }

        // subdistrict options
        selected_str = (numKeys(subdistrict_ar) > 0) ? "selected" : "";
        if (selected_str) document.getElementById('subdistrict').classList.remove('notselected');
        for (var geocode in subdistrict_ar) {
            var val = subdistrict_ar[geocode];
            document.getElementById('subdistrict').innerHTML += ('<option geocode="' + geocode + '" ' + selected_str + ' val="' + val.subdistrict + '" lat="' + val.lat + '" lon="' + val.lon + '">' + val.subdistrict + '</option>');
            selected_str = "";
        }
    }

    function initPostalDropdown(items) {
        var list = '<ul class="jq-dropdown-menu">';
        for (var i = 0, item; item = items[i]; ++i) {
            var str;
            var displayString = item.subdistrict + ' â†’ ' + item.district + ' â†’ ' + item.province;
            if (language == 'th') str = item.subdistrict + ' ' + item.district + ' ' + item.province;
            else str = item.subdistrict + ", " + item.district + ", " + item.province;
            list += '<li><a class="choice" type="postal_code" data="' + str + '" lat="' + item.lat + '" lon="' + item.lon + '" geocode="' + item.geocode + '">' + displayString + "</a></li>";
        }
        list += "</ul>";
        initDropDown(list);
    }

    function initPoiResultDropdown(items) {
        temp_poi_result = items;
        var list = '<ul class="jq-dropdown-menu">';
        for (var i = 0, item; item = items[i]; ++i) {
            list += '<li>'
                + '<a class="choice" type="poi-result" data="' + i + '" style="padding-left:25px;">'
                + item.name
                + '<div class="sublabel">' + item.address + '</div>'
                + (item.icon ? '<img src="https://mmmap15.longdo.com/mmmap/images/icons/' + item.icon + '" style="position:absolute;top:8px;left:6px;width:13px;">' : '')
                + '</a>'
                + '</li>';
        }
        list += "</ul>";
        initDropDown(list);
    }

    function initMarker(latitude, longitude) {
        marker = new longdo.Marker({ lon: longitude, lat: latitude },
            {
                draggable: true,
                weight: longdo.OverlayWeight.Top
            });
        map.Overlays.clear();
        map.Overlays.add(marker);
        map.location(marker.location());

        map.resize();
    }

    function handlePOIsearch(result) {
        map.Event.unbind('search', handlePOIsearch);

        phoneRegEx = /^(\+66|\+668)\d{8}$/;
        promptPaiRegEx = /^\d{8}$/;
        if (result.meta.keyword.match(phoneRegEx) || result.meta.keyword.match(promptPaiRegEx) || result.data.length > 1) {
            initPoiResultDropdown(result.data);
        } else {
            fillFromPOI(result.data[0]);
        }

    }

    function fillFromPOI(item) {

        var part = ["subdistrict", "district", "province", "postal_code"];

        // Do not fill if values are not empty
        for (var i in part) {
            var e = document.getElementById(part[i]);
            if (e && (e.value !== '' && e.tagName === "INPUT")) return;
        }

        var lat = item.lat;
        var lon = item.lon;

        if (document.getElementById('etc') && document.getElementById('etc').value == '' && item.address != '') {
            document.getElementById('etc').value = item.address;
            hideerror('etc');
        }

        // var address = splitlocationstring(item.address.trim());
        // if(address.length){
        //   var ar_index = address.length-1;
        //   for(var i=part.length-1; i>=0;i--){
        //     switch(part[i]){
        //       case 'province':
        //         if(address[ar_index].substring(0,7) === 'à¸à¸£à¸¸à¸‡à¹€à¸—à¸ž') address[ar_index] = 'à¸à¸£à¸¸à¸‡à¹€à¸—à¸žà¸¡à¸«à¸²à¸™à¸„à¸£';
        //         else if(address[ar_index].charAt(1) === '.') address[ar_index] = address[ar_index].substring(2);
        //       break;
        //       case 'district':
        //         if(address[ar_index].substring(0,3) === 'à¹€à¸‚à¸•') address[ar_index] = address[ar_index].substring(3);
        //         else if(address[ar_index].charAt(1) === '.') address[ar_index] = address[ar_index].substring(2);
        //       break;
        //       case 'subdistrict':
        //         if(address[ar_index].substring(0,3) === 'à¹à¸‚à¸§à¸‡') address[ar_index] = address[ar_index].substring(3);
        //         else if(address[ar_index].charAt(1) === '.') address[ar_index] = address[ar_index].substring(2);
        //       break;
        //     }
        //     var e = document.getElementById(part[i]);
        //     if(e && e.tagName === "INPUT") e.value = address[ar_index--];
        //     hideerror(part[i]);
        //   }
        //   if(document.getElementById('etc') && document.getElementById('etc').value == "") {
        //     var etc_ar = [];
        //     for(var i=0; i<=ar_index;i++){
        //       etc_ar.push(address[i]);
        //     }
        //     if(etc_ar.length){
        //       document.getElementById('etc').value = etc_ar.join(' ');
        //       hideerror('etc');
        //     } else {
        //       document.getElementById('etc').value = '';
        //     }
        //   }
        // }

        if (map_id && (lat != 0 || lon != 0)) {
            initMarker(lat, lon);
        }

        //search geocode from lat/lon
        if (lat != 0 || lon != 0) {
            map.Event.bind('address', getGeocodeFromLatLon);
            map.Search.address({ lat: lat, lon: lon });
        }
    }



    function searchpostalcode(result) {
        temp_postal_code = [];
        var item = result.data[0];
        var lat = result.data[0].lat;
        var lon = result.data[0].lon;

        for (var j = 0; j < item.tag.length; j++) {
            if (item.tag[j].indexOf("__POST") === 0)
                temp_postal_code.push(item.tag[j].substring(6));
        }
        temp_postal_code = eliminateDuplicates(temp_postal_code);

        if (temp_postal_code[0]) {
            document.getElementById('postal_code').value = temp_postal_code[0];
            hideerror('postal_code');
        }

        if (map_id) {
            initMarker(lat, lon);
        }

        map.Event.unbind('search', searchpostalcode);

    }

    function geocodesearch(result) {

        var item = result.data[0];
        if (typeof item === "undefined") return;

        var code = item.id;

        //derive geocode from code "K00xxxxxx"
        if (code.substring(5) === "0000") suggest_geocode = code.substring(3, 5);
        else if (code.substring(7) === "00") suggest_geocode = code.substring(3, 7);
        else suggest_geocode = code.substring(3);

        map.Event.unbind('search', geocodesearch);

        map.Event.bind('search', handlesearch);
        map.Search.search(temp_searchtext, {
            tag: temp_searchtype,
            dataset: 'data2a',
            area: suggest_geocode,
            limit: (temp_searchtext && temp_searchtext.length) ? 7 : 1000
        });
    }

    function handlesearch(result) {
        if (!document.getElementById(temp_searchtype) || document.getElementById(temp_searchtype).value !== result.meta.keyword) return;

        var list = '<ul class="jq-dropdown-menu">';
        var keyword = result.meta.keyword;

        for (var i = 0, item; item = result.data[i]; ++i) {
            var name = item.name;
            var displayname = name.replace(new RegExp(keyword, 'g'), '<font color="blue">' + keyword + '</font>');
            var geocode = item.id.substring(3);
            list += '<li><a class="choice" type="' + temp_searchtype + '"  data="' + name + '") geocode="' + geocode + '">' + ((language == 'th') ? displayname.replace(/ /g, ' â†’ ') : displayname) + '</a></li>';
        }

        list += '</ul>';
        initDropDown(list);
        map.Event.unbind('search', handlesearch);
    }

    function appendSelectOption(result) {
        for (var i in result.data) {
            var val = result.data[i];
            //derive geocode from code "K00xxxxxx"
            var geocode;
            var code = val.id;
            if (code.substring(5) === "0000") geocode = code.substring(3, 5);
            else if (code.substring(7) === "00") geocode = code.substring(3, 7);
            else geocode = code.substring(3);
            var name;
            if (language === 'th') name = val.name.split(' ')[0];
            else if (language === 'en') name = val.name.split(', ')[0];

            if (!document.querySelectorAll('#' + val.tag[0] + ' option[geocode="' + geocode + '"]').length) {
                // document.getElementById(val.tag[0]).innerHTML += ('<option geocode="'+geocode+'">'+name+'</option>');
                var e = document.createElement('div');
                e.innerHTML = ('<option geocode="' + geocode + '">' + name + '</option>');
                while (e.firstChild) {
                    document.getElementById(val.tag[0]).appendChild(e.firstChild);
                }
            }
        }
        map.Event.unbind('search', appendSelectOption);
    }

    function handlesuggest(result) {

        if (!document.getElementById(temp_searchtype) || document.getElementById(temp_searchtype).value !== result.meta.keyword) return;

        var list = '<ul class="jq-dropdown-menu">';
        for (var i = 0, item; item = result.data[i]; ++i) {
            if (temp_searchtype == "subdistrict" || temp_searchtype == "district" || temp_searchtype == "province") {
                var st = splitlocationstring(item.w);
                if (st.length > 2)
                    list += '<li><a class="choice" type="' + temp_searchtype + '" data="' + item.w + '")>' + item.d + '</a></li>';
            }
            else list += '<li><a class="choice" type="' + temp_searchtype + '" data="' + item.w + '")>' + item.d + '</a></li>';
        }

        list += "</ul>";
        initDropDown(list);
    }

    function initsuggest(searchtype) { //trigger by onfocus
        temp_searchtype = searchtype;
        dropdownShow(document.getElementById(searchtype));
        document.getElementById('jq-dropdown').innerHTML = '';
        document.getElementById('jq-dropdown').classList.remove('jq-dropdown-tip');
        var list = '<ul class="jq-dropdown-menu">';

        if (document.getElementById('country').value == "TH") {
            switch (searchtype) {
                case 'address1':
                    break;
                case 'route':
                    list += "<span>" + lang.route_info + "</span>";
                    break;
                case 'province':
                    if (document.getElementById('province').value === '') { //list province if empty
                        for (var i = 0; i < provinces.length; i++) {
                            var provinceName = provinces[i].name;
                            if (provinceName.charAt(1) === '.') provinceName = provinceName.substring(2)
                            list += '<li><a class="choice-auto" data="' + provinceName + '" type="province2">' + provinceName + '</a></li>';
                        }
                    }
                    else suggest('province');
                    break;
                case 'address2':
                case 'poi':
                case 'etc':
                case 'district':
                case 'subdistrict':
                case 'postal_code':
                    suggest(searchtype);
                    break;
            }
        }

        list += '</ul>';
        initDropDown(list);
    }

    function suggest(searchtype) { //trigger by oninput
        temp_searchtype = searchtype;
        var str = document.getElementById(searchtype).value;

        if (document.getElementById('country').value == "TH" && (str.length > 0 || ['district', 'subdistrict'].indexOf(searchtype) !== -1)) {

            switch (searchtype) {
                case 'poi':
                    phoneRegEx = /^(0|08)\d{8}$/;
                    promptPaiRegEx = /^\d{8}$/;
                    if (str.match(phoneRegEx) || str.match(promptPaiRegEx)) {
                        // process number before send to search
                        if (str.match(phoneRegEx)) {
                            str = '+66' + str.substr(1);
                        } else if (str.match(promptPaiRegEx) && str.charAt(0) == '9') {
                            str = '0' + str.substr(1);
                        }
                        map.Event.bind('search', handlePOIsearch);
                        map.Search.search(str, {
                            limit: 10
                        });
                    } else {
                        // cut "à¸•à¸³à¸šà¸¥","à¹à¸‚à¸§à¸‡"
                        if (str.length > 4 && (str.substring(0, 4) === "à¸•à¸³à¸šà¸¥" || str.substring(0, 4) === "à¹à¸‚à¸§à¸‡")) {
                            str = str.substring(4);
                        }
                        map.Search.suggest(str, {
                            // dataset: 'poi_a',
                            dataset: 'm2h_s,poi,poi2',
                            limit: 7
                        });
                    }
                    break;
                case 'etc':
                    map.Search.suggest(str, {
                        dataset: 'm2h_s,poi,poi2',
                        limit: 7
                    });
                    break;
                case 'house_number':
                    map.Search.suggest(str, {
                        dataset: 'm2h_s',
                        limit: 5
                    });
                    break;
                // FIXME: Dataset poi_r also contains soi
                case 'street':
                    map.Search.suggest(str, {
                        dataset: 'poi_r',
                        limit: 5
                    });
                    break;
                case 'building':
                    map.Search.suggest(str, {
                        dataset: 'poi,poi2',
                        limit: 5
                    });
                    break;
                case 'parent':
                    map.Search.suggest(str, {
                        dataset: 'poi,poi2',
                        limit: 5
                    });
                    break;
                case 'address2':
                case 'subdistrict':
                case 'district':
                case 'province':
                    var searchtext, hasparent;
                    searchtext = str;
                    hasparent = false;
                    switch (searchtype) {
                        case 'address2':
                        case 'subdistrict':
                            if (document.getElementById('district').value !== '') hasparent = true;
                            if (document.getElementById('province').value !== '') hasparent = true;
                            break;
                        case 'district':
                            if (document.getElementById('province').value !== '') hasparent = true;
                            break;
                    }

                    if (hasparent && searchtype !== 'address2') {  //If the parent is inserted, reverse search
                        var parenttype = '';
                        var parentsearchtext = '';
                        switch (searchtype) {
                            case 'subdistrict':
                                if (document.getElementById('district').value !== '' && document.getElementById('province').value !== '') {
                                    parenttype = 'district';
                                    if (language === 'th') {
                                        if (document.getElementById('province').value.substring(0, 7) !== "à¸à¸£à¸¸à¸‡à¹€à¸—à¸ž") {
                                            parentsearchtext = document.getElementById('district').value + " à¸ˆ." + document.getElementById('province').value;
                                        }
                                        else parentsearchtext = document.getElementById('district').value + " " + document.getElementById('province').value;
                                    }
                                    else if (language === 'en') {
                                        parentsearchtext = document.getElementById('district').value + ", " + document.getElementById('province').value;
                                    }

                                }
                                else if (document.getElementById('district').value !== '') {
                                    parenttype = 'district';
                                    parentsearchtext = document.getElementById('district').value;
                                }
                                else if (document.getElementById('province').value !== '') {
                                    parenttype = 'province';
                                    parentsearchtext = document.getElementById('province').value;
                                }
                                break;
                            case 'district':
                                if (document.getElementById('province').value !== '') {
                                    parenttype = 'province';
                                    parentsearchtext = document.getElementById('province').value;
                                }
                                break;
                        }

                        temp_searchtext = searchtext;
                        temp_searchtype = searchtype;
                        map.Event.bind('search', geocodesearch);
                        map.Search.search(parentsearchtext, {
                            tag: parenttype,
                            dataset: 'data2a',
                            limit: 5
                        });
                    }
                    else {  //direct search
                        if (searchtext.length > 0) {
                            map.Event.bind('search', handlesearch);
                            map.Search.search(searchtext, {
                                tag: searchtype === 'address2' ? 'subdistrict' : searchtype,
                                dataset: 'data2a',
                                limit: 5
                            });
                        }
                    }
                    break;
                case 'postal_code':
                    if (document.getElementById('postal_code').value.length === 5) {
                        map.Event.bind('address', getAddressFromPostalCode);
                        map.Search.address(document.getElementById('postal_code').value);
                    } else {
                        hideBySelector('#jq-dropdown');
                    }
                    break;
            }

        }
        else {
            hideBySelector('#jq-dropdown');
        }
    }

    function onSelectChange(searchtype) {  // when <option> is clicked
        document.getElementById(searchtype).classList.remove('notselected');
        switch (searchtype) {
            case 'country':
                document.querySelectorAll('#addressform .Thailand-exclusive input').forEach(item => { item.value = '' })
                if (document.getElementById('country').value == "TH") {
                    setPropBySelector('#addressform .Thailand-exclusive input, #addressform .Thailand-exclusive select', 'disabled', false);
                    setPropBySelector('#addressform input.Thailand-exclusive', 'disabled', false);
                    showBySelector('#addressform .Thailand-exclusive');
                } else {
                    setPropBySelector('#addressform .Thailand-exclusive input, #addressform .Thailand-exclusive select', 'disabled', true);
                    setPropBySelector('#addressform input.Thailand-exclusive', 'disabled', true);
                    hideBySelector('#addressform .Thailand-exclusive');
                }
                break;
            case 'province':
                // à¸«à¸¢à¸­à¸” district à¸à¸±à¸š sub
                var geo = document.querySelectorAll('#province option:checked')[0].getAttribute('geocode');
                hideBySelector('#district option');
                showBySelector('#district option[geocode^="' + geo + '"], #district option[disabled]');
                hideBySelector('#subdistrict option');
                showBySelector('#subdistrict option[geocode^="' + geo + '"], #subdistrict option[disabled]');
                document.querySelectorAll('#district option[disabled]')[0].selected = true
                document.querySelectorAll('#subdistrict option[disabled]')[0].selected = true
                document.getElementById('district').classList.add('notselected');
                document.getElementById('subdistrict').classList.add('notselected');

                map.Event.bind('search', appendSelectOption);
                // append option to select
                map.Search.search("", {
                    tag: "district",
                    dataset: 'data2a',
                    area: geo,
                    limit: 100
                });
                break;
            case 'district':
                // à¸«à¸¢à¸­à¸” sub
                var geo = document.querySelectorAll('#district option:checked')[0].getAttribute('geocode');
                hideBySelector('#subdistrict option');
                showBySelector('#subdistrict option[geocode^="' + geo + '"], #subdistrict option[disabled]');
                document.querySelectorAll('#subdistrict option[disabled]')[0].selected = true
                document.getElementById('subdistrict').classList.add('notselected');

                map.Event.bind('search', appendSelectOption);
                // append option to select
                map.Search.search("", {
                    tag: "subdistrict",
                    dataset: 'data2a',
                    area: geo,
                    limit: 100
                });
                break;
            case 'subdistrict':
                var geo = document.querySelectorAll('#subdistrict option:checked')[0].getAttribute('geocode');
                document.querySelectorAll('#district option[geocode="' + geo.substr(0, 4) + '"]')[0].selected = true
                document.getElementById('district').classList.remove('notselected');
                map.Event.bind('search', searchpostalcode);
                map.Search.search("", {
                    tag: 'subdistrict',
                    dataset: 'data2a',
                    area: geo,
                    limit: 5
                });

                if (map_id) {
                    var lat = document.querySelectorAll('#subdistrict option:checked')[0].getAttribute('lat');
                    var lon = document.querySelectorAll('#subdistrict option:checked')[0].getAttribute('lon');
                    initMarker(lat, lon);
                }
                break;
        }
    }

    function onSuggestClick(element) {  //when suggestion from dropdown is clicked
        var searchtype = element.getAttribute('type');
        var value = element.getAttribute('data');
        switch (searchtype) {
            case 'address1':
                autofill('address1', value);
                break;
            case 'poi':
            case 'etc':
            case 'house_number':
            case 'building':
            case 'parent':
                autofill(searchtype, value);
                map.Event.bind('search', handlePOIsearch);
                map.Search.search(value, {
                    limit: 10
                });
                break;
            case 'poi-result':
                autofill('poi', temp_poi_result[value].name);
                fillFromPOI(temp_poi_result[value]);
                break;
            case 'address2':
            case 'subdistrict':
                if (element.getAttribute('geocode') && document.getElementById('geocode')) document.getElementById('geocode').value = element.getAttribute('geocode');
                autofill('subdistrict', value);
                map.Event.bind('search', searchpostalcode);
                map.Search.search(value, {
                    tag: 'subdistrict',
                    dataset: 'data2a',
                    limit: 5
                });
                if (searchtype == 'address2') autofill(searchtype, value);
                break;
            case 'district':
                if (element.getAttribute('geocode') && document.getElementById('geocode')) document.getElementById('geocode').value = element.getAttribute('geocode').substring(0, 4);
                autofill('district', value);
                break;
            case 'province':
                if (element.getAttribute('geocode') && document.getElementById('geocode')) document.getElementById('geocode').value = element.getAttribute('geocode').substring(0, 2);
                autofill('province', value);
                break;
            case 'postal_code':
                if (element.getAttribute('geocode') && document.getElementById('geocode')) document.getElementById('geocode').value = element.getAttribute('geocode');
                if (isModeSelect()) {
                    var geo = element.getAttribute('geocode');
                    document.querySelectorAll('#province option[geocode="' + geo.substr(0, 2) + '"]')[0].selected = true;
                    document.querySelectorAll('#district option[geocode="' + geo.substr(0, 4) + '"]')[0].selected = true;
                    document.querySelectorAll('#subdistrict option[geocode="' + geo + '"]')[0].selected = true;
                } else {
                    autofill('subdistrict', value);
                }
                var lat = element.getAttribute('lat');
                var lon = element.getAttribute('lon');
                if (map_id) {
                    initMarker(lat, lon);
                }
                break;
            default:
                autofill(searchtype, value);
        }

    }

    function autofill(searchtype, value) {

        switch (searchtype) {
            case 'address1':
                // updateform('address1');
                break;
            case 'subdistrict':
            case 'district':
            case 'province': //suggestion from typing
                var str = splitlocationstring(value);
                switch (str.length) {
                    case 3:
                        document.getElementById('subdistrict').value = str[0];
                        document.getElementById('district').value = str[1];
                        document.getElementById('province').value = str[2];
                        hideerror('subdistrict');
                        hideerror('district');
                        hideerror('province');
                        break;
                    case 2:
                        document.getElementById('district').value = str[0];
                        document.getElementById('province').value = str[1];
                        hideerror('district');
                        hideerror('province');
                        break;
                    case 1:
                        document.getElementById('province').value = str[0];
                        hideerror('province');
                        break;
                }
                //updateform('address2');
                hideerror('province');
                break;
            case 'province2': //suggestion from clicking
                document.getElementById('province').value = value;
                //updateform('address2');
                hideerror('province');
                break;
            default:
                if (document.getElementById(searchtype)) {
                    document.getElementById(searchtype).value = value;
                    hideerror(searchtype);
                }
        }
    }

    function splitlocationstring(value) {
        if (!value.length) return [];
        var c = value.charCodeAt(0);
        if ((c >= 65 && c <= 90) || (c >= 97 && c <= 122)) {  // English
            var str = value.split(', ');
            return str;
        }
        else {  // Assumed Thai
            var str = value.split(' ');
            if (str[str.length - 1].substring(0, 7) !== "à¸à¸£à¸¸à¸‡à¹€à¸—à¸ž" && str[str.length - 2].substring(0, 7) !== "à¸à¸£à¸¸à¸‡à¹€à¸—à¸ž") {
                var j = 0;
                var str2 = [];
                for (var i = 0; i < str.length; i++) {  //check for à¸•. à¸­. à¸ˆ. and cut it
                    if (str[i].charAt(1) === '.') {
                        str2[i] = str[i].substring(2);
                    }
                    else str2[i] = str[i];
                }
                return str2;
            }
            else {
                var j = 0;
                var str2 = [];
                for (var i = 0; i < str.length; i++) {  //check for à¹€à¸‚à¸• à¹à¸‚à¸§à¸‡ and cut it
                    if (str[i].substring(0, 3) === 'à¹€à¸‚à¸•') {
                        str2[i] = str[i].substring(3);
                    }
                    else if (str[i].substring(0, 4) === 'à¹à¸‚à¸§à¸‡') {
                        str2[i] = str[i].substring(4);
                    }
                    else str2[i] = str[i];
                }
                return str2;
            }
        }
    }

    function getFormData() {
        var str;

        valid = true; //will be false when enter showerror() in validate()
        str = "Invalid form data";

        for (var key in required) {
            if (required[key]) {  //needs validation
                validate(key);
            }
        }

        if (valid && !document.getElementById('postal_code').classList.contains('error-input')) {
            var unindexed_array = serializeArray(document.getElementById('addressform'));
            formData = {};
            for (var i in unindexed_array) {
                formData[unindexed_array[i]['name']] = unindexed_array[i]['value'];
            }

            // get geocode
            if (isModeSelect()) {
                if (!document.querySelectorAll('#subdistrict option:checked')[0].disabled && !document.getElementById('subdistrict').disabled)
                    formData['geocode'] = document.querySelectorAll('#subdistrict option:checked')[0].getAttribute('geocode');
                else if (!document.querySelectorAll('#district option:checked')[0].disabled && !document.getElementById('district').disabled)
                    formData['geocode'] = document.querySelectorAll('#district option:checked')[0].getAttribute('geocode');
                else if (!document.querySelectorAll('#province option:checked')[0].disabled && !document.getElementById('province').disabled)
                    formData['geocode'] = document.querySelectorAll('#province option:checked')[0].getAttribute('geocode');
            }

            str = JSON.stringify(formData);

            if (debugDiv !== '') {
                var str2 = JSON.stringify(formData, null, "<br>");
                document.getElementById(debugDiv).innerHTML = 'JSON Output:<br>' + str2;
            }
        }
        else {
            if (debugDiv !== '') {
                document.getElementById(debugDiv).innerHTML = str;
            }
        }
        return (str == "Invalid form data" ? str : JSON.parse(str));
    }

    function validateAddress1() {  //special condition
        var house_number = document.getElementById('house_number').value;
        var street = document.getElementById('street').value
        var moo = document.getElementById('moo').value
        var parent = document.getElementById('parent').value;

        var pass = false;

        if (house_number !== "" && street !== "") pass = true;
        else if (house_number !== "" && moo !== "") pass = true;
        else if (parent !== "") pass = true;

        return pass;
    }

    function validate(addresstype) {
        if (!required[addresstype]) return;
        switch (addresstype) {
            case 'postal_code':
                if (document.getElementById('country').value == "TH" && document.getElementById('postal_code').value.length !== 5) {
                    showerror("postal_code", lang.postal_code_not_5);
                }
                else if (document.getElementById('postal_code').value === "") {
                    showerror("postal_code", lang.postal_code_empty);
                }
                else hideerror("postal_code");
                break;
            case 'address1':
                if (!validateAddress1())
                    showerror("address1", lang.address1_info);
                else hideerror("address1");
                break;
            case 'house_number':
                if (document.getElementById('house_number').value === "")
                    showerror("house_number", lang.house_number_empty);
                else hideerror("house_number");
                break;
            case 'building':
                if (document.getElementById('building').value === "")
                    showerror("building", lang.building_empty);
                else hideerror("building");
                break;
            case 'floor':
                if (document.getElementById('floor').value === "")
                    showerror("floor", lang.floor_empty);
                else hideerror("floor");
                break;
            case 'parent':
                if (document.getElementById('parent').value === "")
                    showerror("parent", lang.parent_empty);
                else hideerror("parent");
                break;
            case 'soi':
                if (document.getElementById('soi').value === "")
                    showerror("soi", lang.soi_empty);
                else hideerror("soi");
                break;
            case 'moo':
                if (document.getElementById('moo').value === "")
                    showerror("moo", lang.moo_empty);
                else hideerror("moo");
                break;
            case 'street':
                if (document.getElementById('street').value === "")
                    showerror("street", lang.street_empty);
                else hideerror("street");
                break;
            case 'route':
                if (document.getElementById('route').value === "")
                    showerror("route", lang.route_empty);
                else hideerror("route");
                break;
            case 'subdistrict':
                var subdistrict = document.getElementById('subdistrict');
                if (!subdistrict.disabled && (subdistrict.value === "" || subdistrict.value === null))
                    showerror("subdistrict", lang.subdistrict_empty);
                else hideerror("subdistrict");
                break;
            case 'district':
                var district = document.getElementById('district');
                if (!district.disabled && (district.value === "" || district.value === null))
                    showerror("district", lang.district_empty);
                else hideerror("district");
                break;
            case 'province':
                var province = document.getElementById('province');
                if (!province.disabled && (province.value === "" || province.value === null))
                    showerror("province", lang.province_empty);
                else hideerror("province");
                break;
            case 'country':
                if (document.getElementById('country').value === '')
                    showerror("country", lang.country_empty);
                else hideerror("country");
                break;
            case 'etc':
                if (document.getElementById('etc').value === '')
                    showerror("etc", lang.etc_empty);
                else hideerror("etc");
                break;
            case 'poi':
                if (document.getElementById('poi').value === '')
                    showerror("poi", lang.etc_empty);
                else hideerror("poi");
                break;
        }
    }

    function showerror(type, message) {
        valid = false;
        document.getElementById(type).classList.add('error-input');
        if (keys["address1"].indexOf(type) !== -1) showBySelector('#address1_expansion');
        if (keys["address2"].indexOf(type) !== -1) showBySelector('#address2_expansion');
        document.getElementById(type + '_error').innerHTML = message;
        showBySelector('#' + type + '_error')
    }

    function hideerror(type) {
        hideBySelector('#' + type + "_error");
        document.getElementById(type).classList.remove('error-input');
    }

    function eliminateDuplicates(arr) {
        var i,
            len = arr.length,
            out = [],
            obj = {};

        for (i = 0; i < len; i++) {
            obj[arr[i]] = 0;
        }
        for (i in obj) {
            out.push(i);
        }
        return out;
    }

    function initDropDown(list) {
        if (list !== '<ul class="jq-dropdown-menu"></ul>') {
            document.getElementById('jq-dropdown').innerHTML = list;
            dropdownShow(document.getElementById(temp_searchtype));
            document.getElementById('jq-dropdown').classList.add('jq-dropdown-tip');
        }
        else {
            hideBySelector('#jq-dropdown');
        }
    }

    function isModeSelect() {
        return (mode == longdo.AddressForm.SIMPLE_SELECT || mode == longdo.AddressForm.SIMPLE_SELECT_FULLFORM);
    }

    function numKeys(o) {
        var i = 0;
        for (p in o) if (Object.prototype.hasOwnProperty.call(o, p)) { i++ };
        return i;
    }

    function hideBySelector(selector) {
        document.querySelectorAll(selector).forEach(item => { item.style.display = 'none' })
    }

    function showBySelector(selector) {
        document.querySelectorAll(selector).forEach(item => { item.style.display = 'block' })
    }

    function addClassBySelector(selector, className) {
        document.querySelectorAll(selector).forEach(item => { item.classList.add(className) })
    }

    function removeClassBySelector(selector, className) {
        document.querySelectorAll(selector).forEach(item => { item.classList.remove(className) })
    }

    function setPropBySelector(selector, propName, propValue) {
        document.querySelectorAll(selector).forEach(item => { item[propName] = propValue })
    }

    // Dropdown functions (prepare, show, hide, position)
    function prepareDropDown() {
        document.head.innerHTML += ('<link rel="stylesheet" href="' + directory + 'css/addressform.dropdown.css" type="text/css" />');
        document.addEventListener('click', function (e) {
            var show = false;
            for (var target = e.target; target && target != this; target = target.parentNode) {
                if (target.matches('[data-jq-dropdown]')) {
                    show = true;
                    dropdownShow(target);
                    break;
                }
            }
            if (!show) dropdownHide();
        });
        window.addEventListener('resize', dropdownPosition);
    }

    function dropdownShow(element) {
        var jqDropdown = document.getElementById('jq-dropdown');

        dropdownTrigger = element;
        jqDropdown.style.display = 'block';

        // Position it
        dropdownPosition();
    }

    function dropdownHide() {
        var jqDropdown = document.getElementById('jq-dropdown');
        jqDropdown.style.display = 'none';
        dropdownTrigger = null;
    }

    function dropdownPosition() {
        var jqDropdown = document.getElementById('jq-dropdown'),
            hOffset = 0,
            vOffset = 0;
        var scrollLeft = window.pageXOffset || document.documentElement.scrollLeft || document.body.scrollLeft || 0;
        var scrollTop = window.pageYOffset || document.documentElement.scrollTop || document.body.scrollTop || 0;

        var rect = dropdownTrigger.getBoundingClientRect();
        jqDropdown.style.left = ((rect.left + scrollLeft) + hOffset) + 'px';
        jqDropdown.style.top = ((rect.top + scrollTop) + dropdownTrigger.offsetHeight + vOffset) + 'px';
    }

}

var serializeArray = function (form) {
    var serialized = [];
    for (var i = 0; i < form.elements.length; i++) {
        var field = form.elements[i];
        if (!field.name || field.disabled || field.type === 'file' || field.type === 'reset' || field.type === 'submit' || field.type === 'button') continue;
        if (field.type === 'select-multiple') {
            for (var n = 0; n < field.options.length; n++) {
                if (!field.options[n].selected) continue;
                // serialized.push(encodeURIComponent(field.name) + "=" + encodeURIComponent(field.options[n].value));
                serialized.push({ name: field.name, value: field.options[n].value });
            }
        }
        else if ((field.type !== 'checkbox' && field.type !== 'radio') || field.checked) {
            // serialized.push(encodeURIComponent(field.name) + "=" + encodeURIComponent(field.value));
            serialized.push({ name: field.name, value: field.value });
        }
    }
    return serialized;
};

longdo.AddressForm.SIMPLE_SELECT = 1;
longdo.AddressForm.SIMPLE_SELECT_FULLFORM = 2;
longdo.AddressForm.SIMPLE_SUGGEST = 3;
longdo.AddressForm.SIMPLE_SUGGEST_FULLFORM = 4;
longdo.AddressForm.STANDARD = 5;
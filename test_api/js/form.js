// tab-control:
// Initialize by scanning the page for all tab controls (=nodes with class tab-control)
// Then scan each node for tab-header and tab-page nodes, and assign an onclick
// to each one in sequence

// globals: must be set by enclosing page
// imagesBaseDir: Url of the base images folder

var idCounter = 1;		// Brukes til noe message-greier
var debug = 1;
var threadIdCounter = 0;
var threads = {};
function Thread(owner) {
    var threadId = threadIdCounter++;
    threads[threadId] = owner;
    var timer;

    // Calls the given function on the owner object
    // after a specficed amount of time
    this.setTimeout = function (func, ms) {
        timer = setTimeout("threads[" + threadId + "]." + func, ms);
    };
    this.cancel = function () {
        if (timer) {
            clearTimeout(timer);
        }
        delete threads[threadId];
    };
}
function Color(hexOrArray) {
    var isString = (hexOrArray.length == 6);
    var hex = "";
    var values = [];
    if (isString) {
        hex = hexOrArray;
        for (var j = 0; j < 3; j++) {
            var s = hex.substr(j * 2, 2);
            values[j] = parseInt(s, 16);
        }
    } else {
        for (var j = 0; j < 3; j++) {
            values[j] = hexOrArray[j];
            hex += ((values[j] < 16) ? "0" : "") + Math.floor(values[j]).toString(16);
        }
    }

    // Returns one of the r,g,b values as an int
    this.getValue = function (j) {
        return values[j];
    };

    // Returns the hex value
    this.hexValue = function () {
        return hex;
    };
}
function startFading(elem, endColor) {
    if (!elem.getAttribute("currentEffect")) {
        elem.setAttribute("currentEffect", new Effect.Highlight(elem, { endcolor:endColor || "#ffdd44", afterFinish:function () {
            elem.removeAttribute("currentEffect");
        }}));
    }
}
function sjekkStartFading(formElem) {

    // Finn fade-element
    var elems = document.getElementsByClassName("heltny", formElem);
    for (var i = 0; i < elems.length; i++) {
        startFading(elems[i]);
    }
}
function doubleDigit(d) {
    d = "" + d;
    while (d.length < 2) {
        d = "0" + d;
    }
    return d;
}
function dateString(date) {
    return doubleDigit(date.getDate()) + "." + doubleDigit(date.getMonth() + 1) + "." + date.getFullYear();
}
function getTodaysDate() {
    return dateString(new Date());
}
function AjaxProgress(parentElem) {
    var thread = new Thread(this);
    function getProgressElem() {
        var elems = document.getElementsByClassName("progress", parentElem);
        return (elems.length ? elems[0] : null);
    }
    var progressElem = getProgressElem();
    this.show = function () {
        if (progressElem) {
            progressElem.innerHTML = "<img src='" + imagesBaseDir + "spinner.gif' />";
        }
    };
    this.start = function () {
        thread.setTimeout("show()", 500);
    };
    this.stop = function () {
        thread.cancel();
        if (progressElem) {
            progressElem.innerHTML = "";
        }
    };
}

function getErrorWidget(formElem, errorElem) {
    var elems = document.getElementsByClassName("ErrorWidget", (formElem ? formElem : document.body));
    return (elems.length) ? elems[0] : null;
}

function showError(errorText, formElem) {
    var errorElem = getErrorWidget(formElem);
    if (errorElem) {
        //var p = new PositionManager(formElem);
        errorElem.innerHTML = errorText;
        Element.removeClassName(errorElem, "hidden");
        makeVisible(errorElem);
        //p.restore();
    } else {
        alert(errorText);
    }
}

// Get the parent tab control of an element
function getParentTabControl(e) {
    return getClassUp(e, "tabControl");
}

// Get the parent form of an element
function getParentForm(e) {
    return getTagUp(e, "FORM");
}

// Add extra parameters for tab controls
function addExtraParameters(formElem, parameters) {
    var tabControl = getParentTabControl(formElem);
    if (tabControl != null) {
        var extraForms = document.getElementsByClassName("extraForm", tabControl);
        if (extraForms && extraForms.length) {
            for (var i = 0; i < extraForms.length; i++) {
                var extraForm = extraForms[i];
                for (var j = 0; j < extraForm.elements.length; j++) {
                    var e = extraForm.elements[j];
                    if((!e.type) || (e.type.toLowerCase() != "radio") || e.checked) {
                        parameters += "&" + e.name + "=" + e.value;
                    }
                }

            }
        }
    }
    return parameters;
}

function ajaxSubmit(actionUrl, parameters, formElem, handling, runOnceWhenOpened) {

    // Husk form id
    var formId = formElem.id;

    // when download, no ajax
    if (handling == 'download'){
        var tmpUrl = actionUrl +"&handling=download"
        var oldActionUrl = formElem.action;
        formElem.action = tmpUrl;
        formElem.submit();
        // Restore normal form operation
        setTimeout(function() {
            formElem.action = oldActionUrl;
            
        }, 1);
        return;
    }

    // Start an image spinning animation
    var progress = new AjaxProgress(formElem);
    progress.start();
    if (handling) {
        parameters += "&handling=" + handling;
    }
    parameters = addExtraParameters(formElem, parameters);
    var errorText = i18n["error.update.prefix"] + " ";
    if ((handling == "slett") || (!handling)) {
        errorText += i18n["error.update.notsaved"] + " ";
    }
    errorText += "\n\n" + i18n["error.update.suffix"] + " ";

    new Ajax.Request(actionUrl, {method:"post", parameters:parameters, onSuccess:(function (req) {
        progress.stop();
        ajaxSuccess(req.responseText, formId);
        if(runOnceWhenOpened) {
            runOnceWhenOpened();
        }
    }).bind(this), onFailure:function (req) {
        progress.stop();
        showError(errorText, formElem);
    }, onException:function (t, e) {
        progress.stop();
        showError(errorText, formElem);
    }});
}

// When an ajax call completes
function ajaxSuccess(text, formId) {
    parsed = parseResponse(text);
    var id = parsed.id;
    //var p = new PositionManager($(id));
    $(id).innerHTML = parsed.html;
    $(id).setAttribute("controller", null);
    //p.restore();
    sjekkStartFading($(id));
    if(formId && $(formId)) {
        makeVisible($(formId));
        focusElemInForm($(formId));
    } else {
        makeVisible($(id));
        //focusFirstInput();
    }
    if(parsed.modalDialogUrl) {
        openModalDialog(parsed.modalDialogUrl, parsed.modalDialogClass);
    }
}

function makeVisible(e) {
    var et = findTop(e);
    var eh = e.offsetHeight;
    var eb = et + eh
    var st = getBodyScroll();
    var sh = getBodyHeight();
    var sb = st + sh;
    if(eh <= 0) {
        // Cannot be visible
    } else if((et < st) && (eb > sb)) {
        // Too big to show
    } else if(eb > sb) {
        window.scrollBy(0, eb - sb);
    } else if((et < st) && (eh < sh)) {
        window.scrollBy(0, eh - sh);
    }
}

// strip away the container div
function parseResponse(responseText) {
    var inner = "";
    var id = "";
    var modalDialogUrl = "";
    var modalDialogClass;
    var r = /<([^>]*)>((\s|\S)*)<\/[^>]+>/i;
    if (responseText.match(r)) {
        inner = RegExp.$2;
        var s = / id=[ \'\"]*([^ \"\']*)/i;
        var atts = RegExp.$1;
        if (atts.match(s)) {
            id = RegExp.$1;
        }
        s = / modalDialogUrl=[ \'\"]*([^\"\']*)/i;
        if (atts.match(s)) {
            modalDialogUrl = RegExp.$1;
        }
        s = / modalDialogClass=[ \'\"]*([^\"\']*)/i;
        if (atts.match(s)) {
            modalDialogClass = RegExp.$1;
        }
    }
    return {id:id, html:inner, modalDialogUrl:modalDialogUrl, modalDialogClass:modalDialogClass};
}


function dumpObject(e) {
    var s = "";
    s += e;
    s += ": ";
    for (var i in e) {
        s += " " + i + "=" + e[i];
    }
    return s;
}
function getId() {
    return "id-" + (idCounter++);
}

// Set focus to the first visible textbox on the page
function getParentPage(elem) {
    return getClassUp(elem, tabPageClass);
}
function focusFirstInput() {

    // for each form
    for (f = 0; f < document.forms.length; f++) {
        var formElem = document.forms[f];

        // Check that this form isn't hidden
        var tabElem = getParentPage(formElem);
        if ((formElem.id == "SporreWidget") || ((tabElem != null) && (Element.hasClassName(tabElem, "hidden")))) {
            continue;
        }
        focusElemInForm(formElem);
    }
}

// Sets the focus to the right element in the form
function focusElemInForm(formElem) {
    var focusElem = null;

    // for each element in each form
    for (i = 0; i < formElem.length; i++) {
        var inputElem = formElem[i];

        // if it's a text box
        var t = inputElem.type;
        if (((t == "text") || (t == "password") || (t == "button") || (t == "submit")) && (inputElem.disabled != true) && (!inputElem.getAttribute("readonly"))) {

            // select if not focused anything, or if selected something without error
            var hasError = (Element.hasClassName(inputElem, "errorField") || Element.hasClassName(inputElem.parentNode, "errorField"));
            if ((!focusElem) || hasError) {
                focusElem = inputElem;
                if (hasError) {
                    // If found an input with an error, don't look any more
                    break;
                }
            }
        }
    }
    if (focusElem) {
        focusInput(focusElem);
    }
}
function focusInput(elem) {
    setTimeout(function() {
        try {
            var st = getBodyScroll();
            elem.focus();
            window.scrollBy(0, getBodyScroll() - st);
        } catch(err) { }
    }, 1);
}

// Get the INPUT field belonging to a date elem
function getDateField(dateElem) {
    return dateElem.getElementsByTagName("INPUT")[0];
}

// Called when the user clicks the calendar image
function calendarClick(imgElem, closeCallback) {
    var dateElem = getClassUp(imgElem, "date");
    var formElem = getTagUp(dateElem, "FORM");
    var defaultValue = "";
    var elems = document.getElementsByClassName("date", formElem);
    for (var i = 0; i < elems.length; i++) {
        var elem = elems[i];
        if ((elem == dateElem) && (i >= 1)) {
            // Treat earlier
            defaultValue = getDateField(elems[i - 1]).value;
            break;
        }
    }
    var dateField = getDateField(dateElem);
    dateField.closeCallback = closeCallback;
    popUpCalendar(imgElem, dateField, dateFormat, defaultValue);
}

// e is the button clicked
function buttonClick(button, handling) {
    var formElem = getTagUp(button, "FORM");
    submitForm(formElem, handling);
    return false;
}

// formElem: an actual elem
function submitForm(formElem, handling, runOnceWhenOpened) {
    if(!specialFormAction(formElem, handling)) {
        var actionUrl = formElem.action;
        var parameters = Form.serialize(formElem);
        ajaxSubmit(actionUrl, parameters, formElem, handling, runOnceWhenOpened);
    }
}

function specialFormAction(formElem, handling) {
    if((handling != "avbryt") && (Element.hasClassName(formElem, subscriptionPaymentClass))) {
        var checkedInput = getCheckedInput(formElem, subscriptionPaymentName);
        if(checkedInput != null) {
            var urlBearers = checkedInput.parentElement.getElementsByClassName("urlBearer");
            if(urlBearers.length > 0) {
                var urlBearer = urlBearers[0];
                var url = urlBearer.getAttribute("data-url");
                if(url) {
                    if(urlBearer.getAttribute("data-modal-use") == "true") {
                        openModalDialog(url, urlBearer.getAttribute("data-modal-class"));
                    } else {
                        window.open(url);
                    }
                    return true;
                }
            }
        }
    }
    return false;
}

function getInputWithValue(formElem, name, value) {
    return getInput(formElem, name, function(input) { return input.value == value });
}

function getCheckedInput(formElem, name) {
    return getInput(formElem, name, function(input) { return input.checked });
}

function getInput(formElem, name, predicate) {
    var inputs = Form.getInputs(formElem, null, name);
    for(var i = 0; i < inputs.length; i++) {
        if(predicate(inputs[i])) {
            return inputs[i];
        }
    }
    return null;
}

// formElem: an actual elem
function erFormSkjult(formElem, varSkjult) {
    if(formElem.getAttribute("skjult") == "true") {
        return true;
    }
    var parameters = Form.serialize(formElem);
    return (parameters.search("skjult=true") != -1);
}

function setFormHidden(formElem, hidden) {
    formElem.setAttribute("skjult", hidden ? "true" : "false");
}

/**
 * Set class name
 *
 * @param elemn
 * @param className
 * @param set
 */
function setClassName(elem, className, set) {
    if(set && !Element.hasClassName(elem, className)) {
        Element.addClassName(elem, className);
    } else if((!set) && Element.hasClassName(elem, className)) {
        Element.removeClassName(elem, className);
    }
}

function getClassUp(e, name) {
    if (!(e && e.tagName)) {
        return null;
    }
    //alert(e.tagName+":"+e.className);
    if (Element.hasClassName(e, name)) {
        return e;
    }
    return getClassUp(e.parentNode, name);
}
function getTagUp(e, name) {
    if (!(e && e.tagName)) {
        return null;
    }
    if (e.tagName == name) {
        return e;
    }
    return getTagUp(e.parentNode, name);
}

// Gets one element by tag name which is
// a descendant of the name given
function getOneElementByTagName(e, name) {
    var someNodeList = e.getElementsByTagName(name);
    var nodes = $A(someNodeList);
    var result = null;
    nodes.each(function (node) {
        result = node;
    });
    return result;
}

/* Click link child element */
function clickInnerLink(header) {
    var url = header.getElementsByTagName("A")[0].href;
    window.open(url);
    return false;
}

function findPos(obj) {
    var curleft = 0;
    var curtop = 0;
    if (obj.offsetParent) {
        do {
            curleft += obj.offsetLeft;
            curtop += obj.offsetTop;
        } while (obj = obj.offsetParent);
    }
    return [curleft,curtop];
}

function findTop(obj) {
    return findPos(obj)[1];
}

function findApparentTop(obj) {
    return findTop(obj) - getBodyScroll();
}

function restoreHeight(header, oldTop) {
    var newTop = findApparentTop(header);
    //alert("oldTop: " + oldTop + ", newTop: " + newTop + ", scrolling by: " + (newTop - oldTop));
    window.scrollBy(0, newTop - oldTop);
    // Batte redraw problem in chrome
}

var currentHeader;
var currentPage;
var currentTabControl;
function getFormInPage(page) {
    return getOneElementByTagName(page, "form");
}
function clickHeader(header, pageId, dontClose, runOnceWhenOpened) {
    /* Bytter om p� rekkef�lgen av 'tab'-rader */
    var cElmt = header;
    var table = cElmt.parentNode.parentNode;
    var intro = document.getElementById("titlerIntro");
    var iStat = 0;
    if (intro) {
        var removed = table.removeChild(cElmt.parentNode);
        table.appendChild(removed);
        if (intro.parentNode == removed) {
            intro.parentNode.removeChild(intro);
            iStat = 1;
        }
        if (iStat == 1) {
            var n = table.childNodes;
            var l = n.length;
            for (var m = 0; m < l; m++) {
                if (iStat == 1) {
                    if (n[m].nodeType == 1) {
                        n[m].appendChild(intro);
                        iStat = 0;
                    }
                }
            }
        }
    }
    /* Original kode */
    var page = $(pageId);
    var oldTop = findApparentTop(header);
    heightGuardOn();
    if (page == currentPage) {
        if(!dontClose) {
            closePage(currentPage, currentHeader, true);
            restoreHeight(header, oldTop);
        }
        if(runOnceWhenOpened) {
            runOnceWhenOpened();
        }
    } else {
        //var p = new PositionManager(header);
        var formElem = getFormInPage(page);
        var skjult = erFormSkjult(formElem);
        var oldTop = findApparentTop(header);
        var doEffect = !currentPage;
        closePage(currentPage, currentHeader, false);
        restoreHeight(header, oldTop);
        openPage(page, header, doEffect);
        restoreHeight(header, oldTop);
        //p.restore(page);
        if (skjult) {
            setFormHidden(formElem, false)
            submitForm(formElem, "vis", runOnceWhenOpened);
        } else {
            // Combat chrome display bug by doing this in a 100 ms timeout
            setTimeout(function() {
                makeVisible(formElem);
                focusElemInForm(formElem);
                if(runOnceWhenOpened) {
                    runOnceWhenOpened();
                }
            }, 100);
        }
    }
    heightGuardOff();
    return false;
}

function heightGuardOn() {
    var g = $("heightGuard");
    if(g) { g.style.top = (document.body.offsetHeight-1) + "px"; g.style.display = "block"; }
}
function heightGuardOff() {
    var g = $("heightGuard");
    if(g) { g.style.display = "none"; }
}

var hasClicked = {};
var tabPageClass = "tabPage";
var hiddenClass = "hidden";
var selectedClass = "selected";
var disabledClass = "disabled";
var pageOpenClass = "open";
var effectDuration = 0.5;
function closePage(page, header, doEffect) {
    doEffect = false;
    Element.removeClassName(header, selectedClass);
    if (doEffect) {
        page.style.display = "block";
    }
    Element.addClassName(page, hiddenClass);
    if (doEffect) {
        Effect.Fade(page, {duration:effectDuration});
    }
    currentPage = null;
    currentHeader = null;
    if(currentTabControl) {
        Element.removeClassName(currentTabControl, pageOpenClass);
    }
    currentTabControl = null;
}
function openPage(page, header, doEffect) {
    doEffect = false;
    // Make the transion longer by adding options.
    Element.addClassName(header, selectedClass);
    if (doEffect) {
        page.style.display = "none";
    }
    Element.removeClassName(page, hiddenClass);
    if (doEffect) {
        Effect.Appear(page, {duration:effectDuration});
    }
    currentPage = page;
    currentHeader = header;
    currentTabControl = getParentTabControl(page);
    Element.addClassName(currentTabControl, pageOpenClass);
    //ensureVisible(page);
}

function getBodyHeight() {
    if (self.innerHeight) { return self.innerHeight; } // all except Explorer
    else if (document.documentElement && document.documentElement.clientHeight) { return document.documentElement.clientHeight; } // Explorer 6 Strict Mode
    else if (document.body) { return document.body.clientHeight; } // other Explorers
}

function getBodyScroll() {
    if (self.pageYOffset) { return self.pageYOffset; } // all except Explorer
    else if (document.documentElement && document.documentElement.scrollTop) { return document.documentElement.scrollTop; } // Explorer 6 Strict
    else if (document.body) { return document.body.scrollTop; } // all other Explorers
}


function RelativePosition(e) {

    this.body = [getBodyScroll(), getBodyHeight()];
    this.elem = [Position.cumulativeOffset(e)[1], e.offsetHeight];

    this.apparentTop = function() {
        return this.elem[0] - this.body[0];
    };

    // Ensures object is visible
    this.needsDelta = function() {
        var now = this.body[0] + this.body[1];
        var needs = this.elem[0] + this.elem[1];
        return needs-now;
    };

    /*
     this.toString = function() {
     return "body=["+this.body[0]+","+this.body[1]+"], elem=["+this.elem[0]+","+this.elem[1]+"], apparentTop="+this.apparentTop()+", needsDelta="+this.needsDelta();
     }
     */

}

// Takes care of objects not jumping around
// when opening or closing tabs
function PositionManager(e) {

    var p = new RelativePosition(e);
    var g = $("heightGuard");
    if(g) { g.style.top = (document.body.offsetHeight-1) + "px"; g.style.display = "block"; }

    // Ensures object is visible
    this.show = function() {
        if(p.needsDelta()) { e.scrollIntoView(false); }
        if(g) { g.style.display = "none"; }
    };

    // Restores original position
    // But also ensures that v is visible
    this.restore = function(v) {
        if(!v) { v = e; }
        var q = new RelativePosition(e);
        // delta for restoring
        var restoreDelta = q.apparentTop() - p.apparentTop();
        // Ensure v is visible
        var visibleDelta = new RelativePosition(v).needsDelta();
        var delta = Math.max(restoreDelta, visibleDelta);
        /*
         var x = "";
         x += p.toString()+"\n";
         x += q.toString()+"\n";
         x += "restoreDelta="+restoreDelta+"\n";
         x += "visibleDelta="+visibleDelta+"\n";
         x += "delta="+delta+"\n";
         alert(x);
         */
        // Scroll
        if(delta) { window.scrollBy(0, delta); }
        if(g) { g.style.display = "none"; }
    };
}


// Ensures that element e is visible,
// if necessary by scrolling
function ensureVisible(e) {
    new PositionManager(e).show();
}

// Funksjon for aa gjemme eller vise et felt i en form
function showInput(formElem, field, show, endcolor, suppressEffect) {
    var fieldElem = findField(formElem, field);
    if(!fieldElem) { return; }
    var elem = getTagUp(fieldElem, "TR");
    if (show) {
        Element.removeClassName(elem, "hidden");
        if (!(suppressEffect || elem.getAttribute("currentEffect"))) {
            elem.setAttribute("currentEffect", new Effect.Highlight(elem, {endcolor:endcolor, afterFinish:function () {
                elem.removeAttribute("currentEffect");
            }}));
        }
    } else {
        Element.addClassName(elem, "hidden");
    }
}

function getShortName(name) {
    var i = name.lastIndexOf(".");
    return name.substr(i + 1);
}

var endringPrefix = "endring.";

function getNameWithoutEndringPrefix(name) {
    return (name && (name.indexOf(endringPrefix) == 0)) ? name.substr(endringPrefix.length) : "";
}

// Oppdater visning av privatperson/firma rader
function visPrivatperson(radioElem, show, endcolor, suppressEffect, nocopy) {
    var formElem = getTagUp(radioElem, "FORM");
    var showPrefix =  show ? "privat" : "firma";
    var hidePrefix = !show ? "privat" : "firma";
    var showElems = getFormElems(formElem, showPrefix);
    var hideElems = getFormElems(formElem, hidePrefix);
    var hidden = {};
    for(var i = 0; i< hideElems.length; i++) {
        var elem = hideElems[i];
        var name = getNameWithoutEndringPrefix(elem.name);
        if(name) {
            var shortName = getShortName(name);
            showInput(formElem, name, false, endcolor, suppressEffect);
            hidden[shortName] = elem.value;
        }
    }
    for(var i = 0; i < showElems.length; i++) {
        var elem = showElems[i];
        var name = getNameWithoutEndringPrefix(elem.name);
        if(name) {
            var shortName = getShortName(name);
            var already = (shortName in hidden);
            if(already && (!nocopy)) {
                elem.value = hidden[shortName];
            }
            showInput(formElem, name, true, endcolor, already ? true : suppressEffect);
        }
    }
}

function visUtfyllFakturaadresse(sender, suppressEffect) {

    var show = sender.checked;
    var formElem = getTagUp(sender, "FORM");
    var elem = document.getElementsByClassName("gjemmer", formElem)[0];
    if(!elem.getAttribute("currentEffect")) {
        if(suppressEffect) {
            showElem(elem, sender.checked);
        } else if(show) {
            elem.setAttribute("currentEffect", new Effect.BlindDown(elem, {duration:0.5, afterFinish:function () {
                elem.removeAttribute("currentEffect"); showElem(elem, sender.checked);
            }}));
        } else {
            elem.setAttribute("currentEffect", new Effect.BlindUp(elem, {duration:0.5, afterFinish:function () {
                elem.removeAttribute("currentEffect"); showElem(elem, sender.checked);
            }}));
        }
    }
}

/**
 * Called when the user selects something in the address category list box
 **/
function onAddressCategoryChanged(addressCategoryElem) {
    var formElem = getTagUp(addressCategoryElem, "FORM");
    var name = addressCategoryElem.name.substr(endringPrefix.length);
    var freeField = findField(formElem, name + "Free");   // TODO: Kind of hack
    var freeValueField = findField(formElem, name + "FreeValue");   // TODO: Kind of hack
    var enableFree = (freeValueField.value  == addressCategoryElem.value);
    freeField.readOnly = !enableFree;
    if (!enableFree) {
        freeField.value = '';
    }
    setClassName(freeField, "disabled", !enableFree);
}

function showElem(elem, show) {
    elem.style.display = (show ? "block" : "none");
}

function findField(formElem, field) {
    return getFormElems(formElem, field, true)[0];
}

function concat(a, b) {
    for(var i = 0; i < b.length; i++) {
        a.push(b[i]);
    }
    return a;
}

function getInputOrSelects(formElem) {
    var result= [];
    result = concat(result, formElem.getElementsByTagName('input'));
    result = concat(result, formElem.getElementsByTagName('select'));
    return result;
}

function getFormElems(formElem, prefix, exact) {
    var result= [];
    var inputs = getInputOrSelects(formElem);
    for(var i = 0; i < inputs.length; i++) {
        var input = inputs[i];
        var name = input.name;
        if((exact && (name == endringPrefix + prefix)) || ((!exact) && input.name.startsWith(endringPrefix + prefix + "."))) {
            result.push(input);
        }
    }
    return result;
}

var modalDialog;
var modalShield;
var resizeHandler;

function centerElement(elt) {
    elt = $(elt);
    // retrieve required dimensions
    var eltDims     = elt.getDimensions();
    var browserDims = {
        width: window.innerWidth || (window.document.documentElement.clientWidth || window.document.body.clientWidth),
        height: window.innerHeight || (window.document.documentElement.clientHeight || window.document.body.clientHeight)
    };

// calculate the center of the page using the browser and element dimensions
    var y  = Math.max(0, (browserDims.height - eltDims.height) / 2);
    var x = Math.max(0, (browserDims.width - eltDims.width) / 2);

// set the style of the element so it is centered
    var styles = { position : 'fixed',
        top      : y + 'px',
        left     : x + 'px' };

    elt.setStyle(styles);
    if(!resizeHandler) {
        resizeHandler = function() {
            if(modalDialog) {
                centerElement(modalDialog);
            }
        }
        Event.observe(window, "resize", resizeHandler);
    }
}

function openModalDialog(url, modalClass) {
    try {
        closeModalDialog();
        modalShield = document.createElement("DIV");
        modalShield.className = "modalShield";
        modalDialog = document.createElement("IFRAME");
        modalDialog.frameborder="0";
        modalDialog.className = modalClass || "modal";
        modalDialog.src = url;
        document.body.appendChild(modalShield);
        document.body.appendChild(modalDialog);
        centerElement(modalDialog);
    } catch(err) { }
    return false;
}



function closeModalDialog(responseText) {
    if(modalDialog) {
        document.body.removeChild(modalDialog);
        document.body.removeChild(modalShield);
        modalDialog = null;
        if(responseText) {
            ajaxSuccess(responseText);
        }
    }
}

function selectReceiverTableRow(e) {
    var table = e.parentElement;
    var oldEs = document.getElementsByClassName(selectedClass, table);
    if(oldEs && oldEs[0] && Element.hasClassName(oldEs[0], selectedClass)) { Element.removeClassName(oldEs[0], selectedClass); }
    var input = e.getElementsByTagName("INPUT")[0];
    input.checked = true;
    Element.addClassName(e, selectedClass);
    // Close all child pages
    var tabControl = getParentTabControl(table);
    if (tabControl != null) {
        var pages = document.getElementsByClassName(tabPageClass, tabControl);
        if(pages != null) {
            for(var i = 0; i < pages.length; i++) {
                var page = pages[i];
                var formElem = getFormInPage(page);
                if(formElem) {
                    setFormHidden(formElem, true);
                    setClassName(formElem, disabledClass, true);
                    var errorElem = getErrorWidget(formElem);
                    if(errorElem) {
                        Element.addClassName(errorElem, "hidden");
                    }
                }
                if(page == currentPage) {
                    closePage(currentPage, currentHeader, true);
                }
            }
        }
    }
}

function getFirstDescendantForm(e) {
    return getParentTabControl(e).getElementsByTagName("FORM")[0];
}

var pendingFilter;
function setSubscriptionStatusTypeFilter(e) {
    var formElem = getFirstDescendantForm(e);
    if(!pendingFilter) { submitForm(formElem, "filter"); }
    pendingFilter = setTimeout(function() { pendingFilter = null; }, 1);
}

var subscriptionPaymentClass = "SubscriptionPaymentWidget";
var subscriptionPaymentName = endringPrefix + "optionId";
var selectProductName = endringPrefix + "selectProduct";

// This method will be called when the user clicks the link to pay an invoice immediately
function payInvoiceByCreditCard(product, cid) {
    var pageId = subscriptionPaymentClass + "-" + product;
    var page = document.getElementById(pageId);
    if(page != null) {
        var header = document.getElementById("header-" + pageId);
        clickHeader(header, pageId, true, function() {
            // Select the option to pay immediately
            var urlBearer = document.getElementById("urlbearer-" + cid);
            if(urlBearer != null) {
                var fieldParent = getClassUp(urlBearer, "fieldParent");
                if(fieldParent != null) {
                    var input = fieldParent.getElementsByTagName("INPUT")[0];
                    if(input) {
                        input.click();
                        startFading(fieldParent, "#C8D0D8");
                    }
                }
            }
        });
    }
    return false;
}

function getIeVersion() {
    try {
        var re = new RegExp("MSIE ([0-9]{1,}[\\.0-9]{0,})");
        if (re.exec(navigator.userAgent) != null) {
            return parseFloat(RegExp.$1);
        }
    } catch (err) { }
    return undefined;
}

function isModernBrowser() {
    var ie = getIeVersion();
    return (!ie) || (ie >= 9);
}

function setTextOnButtonInSameForm(e, type, text) {
    var button = getButtonInForm(getParentForm(e), type);
    if(button) {
        if(!button.hasAttribute("data-old-text")) {
            button.setAttribute("data-old-text", button.innerHTML);
        }
        // Make sure the button does not become less wide
        var oldWidth = button.offsetWidth;
        button.innerHTML = text || button.getAttribute("data-old-text");
        if (isModernBrowser()) {
            button.style.minWidth = oldWidth + "px";
        }
    }
}

function getButtonInForm(formElem, type) {
    var buttons = formElem.getElementsByTagName("BUTTON");
    for(var i = 0; i < buttons.length; i++) {
        var button = buttons[i];
        if(button.type == type) {
            return button;
        }
    }
    return null;
}

function selectTemporaryAddressTableRow(e) {
    var table = e.parentElement;
    var oldEs = document.getElementsByClassName(selectedClass, table);
    if(oldEs && oldEs[0] && Element.hasClassName(oldEs[0], selectedClass)) { Element.removeClassName(oldEs[0], selectedClass); }
    var input = e.getElementsByTagName("INPUT")[0];
    input.checked = true;
    Element.addClassName(e, selectedClass);

    // Close all child pages
    var tabControl = getParentTabControl(table);
    if (tabControl != null) {
        var pages = document.getElementsByClassName(tabPageClass, tabControl);
        if(pages != null) {
            for(var i = 0; i < pages.length; i++) {
                var page = pages[i];
                var formElem = getFormInPage(page);

                if(page == currentPage) {
                    ajaxSubmit(input.getValue(), null, formElem, 'listChoose');
                }
            }
        }
    }

}

// Change logged in product
function changeProduct(e) {
    if(e.value) {
        window.location = window.location.href.replace(/([?&]tittel=)\w*/, "$1" + e.value);
    }
    return false;
}

function onBeforeUnload() {
    return undefined;
}


function onPageLoad() {
    var produktVelger = document.getElementById("produktVelger");
    if(produktVelger) {
        var produkt = produktVelger.getAttribute("data-produkt");
        if(produkt) {
            produktVelger.value = produkt;
        } else {
            produktVelger.selectedIndex = 0;
        }
    }
}

function rangeslider(data) {
    'use strict';

    var input, inputDisplay, slider, sliderWidth, sliderLeft, pointerWidth, pointerR, pointerL, activePointer, selected, scale, step, tipL, tipR, timeout, valRange;
    var values = { start: null, end: null };
    var conf = {
        target: null,
        values: null,
        set: null,
        range: false,
        width: null,
        scale: true,
        labels: true,
        tooltip: true,
        step: null,
        disabled: false,
        onChange: null
    };
    var cls = {
        container: 'rs-container',
        background: 'rs-bg',
        selected: 'rs-selected',
        pointer: 'rs-pointer',
        scale: 'rs-scale',
        noscale: 'rs-noscale',
        tip: 'rs-tooltip'
    };

    for (var key in data) {
        if (conf.hasOwnProperty(key)) {
            conf[key] = data[key];
        }
    }

    function init() {
        if (typeof conf.target === 'object') input = conf.target;
        else input = document.getElementById(conf.target.replace('#', ''));

        if (!input) return console.log('Cannot find target element...');

        inputDisplay = getComputedStyle(input, null).display;
        input.style.display = 'none';
        valRange = !(conf.values instanceof Array);

        if (valRange) {
            if (!conf.values.hasOwnProperty('min') || !conf.values.hasOwnProperty('max'))
                return console.log('Missing min or max value...');
        }

        createSlider();
    }

    function createSlider() {
        slider = createElement('div', cls.container);
        slider.innerHTML = '<div class="rs-bg"></div>';
        selected = createElement('div', cls.selected);
        pointerL = createElement('div', cls.pointer, ['dir', 'left']);
        scale = createElement('div', cls.scale);

        if (conf.tooltip) {
            tipL = createElement('div', cls.tip);
            tipR = createElement('div', cls.tip);
            pointerL.appendChild(tipL);
        }
        slider.appendChild(selected);
        slider.appendChild(scale);
        slider.appendChild(pointerL);

        if (conf.range) {
            pointerR = createElement('div', cls.pointer, ['dir', 'right']);
            if (conf.tooltip) pointerR.appendChild(tipR);
            slider.appendChild(pointerR);
        }

        input.parentNode.insertBefore(slider, input.nextSibling);

        if (conf.width) slider.style.width = parseInt(conf.width) + 'px';
        sliderLeft = slider.getBoundingClientRect().left;
        sliderWidth = slider.clientWidth;
        pointerWidth = pointerL.clientWidth;

        if (!conf.scale) slider.classList.add(cls.noscale);

        setInitialValues();
    }

    function setInitialValues() {
        if (valRange) conf.values = prepareArrayValues(conf);

        values.start = 0;
        values.end = conf.range ? conf.values.length - 1 : 0;

        if (conf.set && conf.set.length && checkInitial(conf)) {
            var vals = conf.set;

            if (conf.range) {
                values.start = conf.values.indexOf(vals[0]);
                values.end = conf.set[1] ? conf.values.indexOf(vals[1]) : null;
            } else values.end = conf.values.indexOf(vals[0]);
        }
        createScale();
    }

    function createScale(resize) {
        step = sliderWidth / (conf.values.length - 1);

        for (var i = 0, iLen = conf.values.length; i < iLen; i++) {
            var span = createElement('span'),
                ins = createElement('ins');

            span.appendChild(ins);
            scale.appendChild(span);

            span.style.width = i === iLen - 1 ? 0 : step + 'px';

            if (!conf.labels) {
                if (i === 0 || i === iLen - 1) ins.innerHTML = conf.values[i]
            } else ins.innerHTML = conf.values[i];

            ins.style.marginLeft = (ins.clientWidth / 2) * -1 + 'px';
        }
        addEvents();
    }

    function updateScale() {
        step = sliderWidth / (conf.values.length - 1);

        var pieces = slider.querySelectorAll('span');

        for (var i = 0, iLen = pieces.length; i < iLen; i++)
            pieces[i].style.width = step + 'px';

        setValues();
    }

    function addEvents() {
        var pointers = slider.querySelectorAll('.' + cls.pointer),
            pieces = slider.querySelectorAll('span');

        createEvents(document, 'mousemove touchmove', move);
        createEvents(document, 'mouseup touchend touchcancel', drop);

        for (var i = 0, iLen = pointers.length; i < iLen; i++)
            createEvents(pointers[i], 'mousedown touchstart', drag);

        for (var i = 0, iLen = pieces.length; i < iLen; i++)
            createEvents(pieces[i], 'click', onClickPiece);

        window.addEventListener('resize', onResize);

        setValues();
    }

    function drag(e) {
        e.preventDefault();

        if (conf.disabled) return;

        var dir = e.target.getAttribute('data-dir');
        if (dir === 'left') activePointer = pointerL;
        if (dir === 'right') activePointer = pointerR;

        slider.classList.add('sliding');
    }

    function move(e) {
        if (activePointer && !conf.disabled) {
            var coordX = e.type === 'touchmove' ? e.touches[0].clientX : e.pageX,
                index = coordX - sliderLeft - (pointerWidth / 2);

            index = Math.round(index / step);

            if (index <= 0) index = 0;
            if (index > conf.values.length - 1) index = conf.values.length - 1;

            if (conf.range) {
                if (activePointer === pointerL) values.start = index;
                if (activePointer === pointerR) values.end = index;
            } else values.end = index;

            setValues();
        }
    }

    function drop() {
        activePointer = null;
    }

    function setValues(start, end) {
        var activePointer = conf.range ? 'start' : 'end';

        if (start && conf.values.indexOf(start) > -1)
            values[activePointer] = conf.values.indexOf(start);

        if (end && conf.values.indexOf(end) > -1)
            values.end = conf.values.indexOf(end);

        if (conf.range && values.start > values.end)
            values.start = values.end;

        pointerL.style.left = (values[activePointer] * step - (pointerWidth / 2)) + 'px';

        if (conf.range) {
            if (conf.tooltip) {
                tipL.innerHTML = conf.values[values.start];
                tipR.innerHTML = conf.values[values.end];
            }
            input.value = conf.values[values.start] + ',' + conf.values[values.end];
            pointerR.style.left = (values.end * step - (pointerWidth / 2)) + 'px';
        } else {
            if (conf.tooltip)
                tipL.innerHTML = conf.values[values.end];
            input.value = conf.values[values.end];
        }

        if (values.end > conf.values.length - 1) values.end = conf.values.length - 1;
        if (values.start < 0) values.start = 0;

        selected.style.width = (values.end - values.start) * step + 'px';
        selected.style.left = values.start * step + 'px';

        onChange();
    }

    function onClickPiece(e) {
        if (conf.disabled) return;

        var idx = Math.round((e.clientX - sliderLeft) / step);

        if (idx > conf.values.length - 1) idx = conf.values.length - 1;
        if (idx < 0) idx = 0;

        if (conf.range) {
            if (idx - values.start <= values.end - idx) {
                values.start = idx;
            } else values.end = idx;
        } else values.end = idx;

        slider.classList.remove('sliding');

        setValues();
    }

    function onChange() {
        if (timeout) clearTimeout(timeout);

        timeout = setTimeout(function () {
            if (conf.onChange && typeof conf.onChange === 'function') {
                return conf.onChange(input.value);
            }
        }, 500);
    }

    function onResize() {
        sliderLeft = slider.getBoundingClientRect().left;
        sliderWidth = slider.clientWidth;
        updateScale();
    }

    function disabled(disabled) {
        conf.disabled = disabled;
        slider.classList[disabled ? 'add' : 'remove']('disabled');
    }

    function getValue() {
        return input.value;
    }

    function destroy() {
        input.style.display = inputDisplay;
        slider.remove();
    }

    function createElement(el, cls, dataAttr) {
        var element = document.createElement(el);
        if (cls) element.className = cls;
        if (dataAttr && dataAttr.length === 2)
            element.setAttribute('data-' + dataAttr[0], dataAttr[1]);

        return element;
    }

    function createEvents(el, ev, callback) {
        var events = ev.split(' ');

        for (var i = 0, iLen = events.length; i < iLen; i++)
            el.addEventListener(events[i], callback);
    }

    function prepareArrayValues(conf) {
        var values = [],
            range = conf.values.max - conf.values.min;

        if (!conf.step) {
            console.log('No step defined...');
            return [conf.values.min, conf.values.max];
        }

        for (var i = 0, iLen = (range / conf.step); i < iLen; i++)
            values.push(conf.values.min + i * conf.step);

        if (values.indexOf(conf.values.max) < 0) values.push(conf.values.max);

        return values;
    }

    function checkInitial(conf) {
        if (!conf.set || conf.set.length < 1) return null;
        if (conf.values.indexOf(conf.set[0]) < 0) return null;

        if (conf.range) {
            if (conf.set.length < 2 || conf.values.indexOf(conf.set[1]) < 0) return null;
        }
        return true;
    }

    init();

	console.log("in")

    return {
        getValue: getValue,
        destroy: destroy,
        disabled: disabled
    };
}

rangeslider({
	target: '#sampleSlider',
	values: [2008, 2009, 2010, 2011, 2012, 2013, 2014, 2015],
	range: true,
	tooltip: true,
	scale: true,
	labels: true,
	set: [2010, 2013]
});